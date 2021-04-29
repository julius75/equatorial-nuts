<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendSMS;
use App\Models\MpesaDisbursementRequest;
use App\Models\MpesaDisbursementResponse;
use App\Models\MpesaDisbursementSetting;
use App\Models\MpesaDisbursementTransaction;
use App\Models\MpesaTimeoutResponse;
use App\Models\Order;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group B2C Disbursement
 *
 * API for Disbursing funds to a registered farmer
 *
 */
class DisbursementController extends Controller
{
    protected function get_sandbox_access_token()
    {
        $disbursement_settings = MpesaDisbursementSetting::query()
            ->where('environment', '=', 'sandbox')
            ->first();
        if (!$disbursement_settings){
            return response()->json(['message' => 'Sandbox Disbursement settings not found'], Response::HTTP_NOT_FOUND);
        }
        $consumer_key = decrypt($disbursement_settings->consumer_key);
        $consumer_secret = decrypt($disbursement_settings->consumer_secret);
        if (!isset($consumer_key) or !isset($consumer_secret)){
            return response()->json(['message' => 'Invalid Consumer Key / Consumer secret'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $client = new Client();
        $credentials = base64_encode($consumer_key.':'.$consumer_secret);
        $send_request = $client->request('get', 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',[
            'verify'=>false,
            'http_errors' => false,
            'headers'=>[
                'Authorization'=>'Basic '.$credentials
            ]
        ]);
        $obj = json_decode($send_request->getBody());
        return $obj->access_token;
    }
    /**
     * Initiate a Disbursement Request
     *
     * @authenticated
     *
     * @bodyParam order_id string required Order id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function post_disbursement(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'order_id'=>'required|exists:orders,id',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $order = Order::query()->find($request->get('order_id'));
        if ($order->disbursed == true){
            return response()->json(['message' => 'The selected Order has already been disbursed'], Response::HTTP_BAD_REQUEST);
        }
        if ($order->mpesa_disbursement_request()->exists()) {
            return response()->json(['message' => 'The selected Order already has an Mpesa Disbursement Request'], Response::HTTP_BAD_REQUEST);
        }
        $environment = config('app.mpesa_environment');
        if ($environment == 'sandbox'){
            $disbursement_settings = MpesaDisbursementSetting::query()
                ->where('environment', '=', 'sandbox')
                ->first();
            if (!$disbursement_settings){
                return response()->json(['message' => 'Sandbox Disbursement settings not found'], Response::HTTP_NOT_FOUND);
            }
            $url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
            $token = self::get_sandbox_access_token();
            $recipient_phone =  config('app.mpesa_sandbox_msisdn');
            $initiator_name = decrypt($disbursement_settings->initiator_name);
            $security_credentials = decrypt($disbursement_settings->security_credential);
            $command_id = config('app.mpesa_disbursement_command_id');
            $amount = $order->amount;
            $partyA = decrypt($disbursement_settings->paybill);
            $partyB = $recipient_phone;
        }
        elseif ($environment == 'production') {
            return response()->json(['message' => 'Production Disbursement settings not found'], Response::HTTP_NOT_FOUND);
        }else {
            return response()->json(['message' => 'Invalid Application Status'], Response::HTTP_UNAUTHORIZED);
        }
        $remarks = "ORDER REF: $order->ref_number";
        $queue_timeout_url = route('mpesa_disbursement.timeout');
        $result_url = route('mpesa_disbursement.result');
        $occasion = $remarks;
        try {
            $client = new Client();
            $send_request = $client->request('post', $url, [
                'verify'=>false,
                'http_errors' => false,
                'headers'=>[
                    'Authorization'=> 'Bearer '.$token,
                    'Content-Type'=> 'application/json'
                ],
                'body' => json_encode([
                    'InitiatorName'=>$initiator_name,
                    'SecurityCredential'=>$security_credentials,
                    'CommandID'=>$command_id,
                    'Amount'=>$amount,
                    'PartyA'=>$partyA,
                    'PartyB'=>$partyB,
                    'Remarks'=>$remarks,
                    'QueueTimeOutURL'=>$queue_timeout_url,
                    'ResultURL'=>$result_url,
                    'Occasion'=>$occasion
                ])
            ]);
            $obj = json_decode((string)$send_request->getBody());
            if ($obj->ResponseCode == 0) {
                $disbursement_request = new MpesaDisbursementRequest();
                $disbursement_request->order_id = $order->id;
                $disbursement_request->user_id = Auth::id();
                $disbursement_request->ResponseDescription = $obj->ResponseDescription;
                $disbursement_request->ResponseCode = $obj->ResponseCode;
                $disbursement_request->OriginatorConversationID = $obj->OriginatorConversationID;
                $disbursement_request->ConversationID = $obj->ConversationID;
                $disbursement_request->issued = false;
                $disbursement_request->response = $send_request->getBody();
                $disbursement_request->save();
                Log::info("response received from disbursement post =>".(string)$send_request->getBody());
                return response()->json(['message'=>'Successfully initiated payment request. Notification SMS will be sent once complete'],Response::HTTP_OK );
            }
            else {
                Log::info("failed response received from disbursement post =>".(string)$send_request->getBody());
                return response()->json(['message'=>'Could not complete request at this time. Please again later', 'response'=>$obj],Response::HTTP_OK );
            }
        } catch (BadResponseException $exception) {
            Log::error("guzzle exception => ". (string)$exception->getResponse()->getBody()->getContents());
            return response()->json(['message' => 'There seems to be an error connecting to the MPESA API, Try again later', 'exception'=>$exception->getResponse()->getBody()->getContents()],Response::HTTP_INTERNAL_SERVER_ERROR );
        }
    }

    /**
     *
     * Callback url that receives responses from Safaricom
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function result(Request $request)
    {
        $callbackJsonData = file_get_contents('php://input');
        $callbackData = json_decode($callbackJsonData);
        $resultCode = $callbackData->Result->ResultCode;
        $resultDesc = $callbackData->Result->ResultDesc;
        $originatorConversationID = $callbackData->Result->OriginatorConversationID;
        $conversationID = $callbackData->Result->ConversationID;
        $transactionID = $callbackData->Result->TransactionID;
        $mpesa_disbursement_request = MpesaDisbursementRequest::query()
            ->where('OriginatorConversationID','=', $originatorConversationID)
            ->first();
        $order = Order::query()->with(['user', 'farmer'])->find($mpesa_disbursement_request->order_id);
        //if the disbursement was successful
        if ($resultCode == 0) {
            $TransactionAmount = $callbackData->Result->ResultParameters->ResultParameter[0]->Value;
            $TransactionReceipt = $callbackData->Result->ResultParameters->ResultParameter[1]->Value;
            $B2CRecipientIsRegisteredCustomer = $callbackData->Result->ResultParameters->ResultParameter[2]->Value;
            $B2CChargesPaidAccountAvailableFunds = $callbackData->Result->ResultParameters->ResultParameter[3]->Value;
            $ReceiverPartyPublicName = $callbackData->Result->ResultParameters->ResultParameter[4]->Value;
            $TransactionCompletedDateTime = $callbackData->Result->ResultParameters->ResultParameter[5]->Value;
            $B2CUtilityAccountAvailableFunds = $callbackData->Result->ResultParameters->ResultParameter[6]->Value;
            $B2CWorkingAccountAvailableFunds = $callbackData->Result->ResultParameters->ResultParameter[7]->Value;

            $TransactionCompletedDateTime = now(); //Carbon::parse($TransactionCompletedDateTime)->format('Y-m-d H:i:s');

            $result = [
                'ResultCode' => $resultCode,
                'ResultDesc' => $resultDesc,
                'OriginatorConversationID' => $originatorConversationID,
                'ConversationID' => $conversationID,
                'TransactionID' => $transactionID,
                'TransactionAmount' => $TransactionAmount,
                'TransactionReceipt' => $TransactionReceipt,
                'B2CRecipientIsRegisteredCustomer' => $B2CRecipientIsRegisteredCustomer,
                'B2CChargesPaidAccountAvailableFunds' => $B2CChargesPaidAccountAvailableFunds,
                'ReceiverPartyPublicName' => $ReceiverPartyPublicName,
                'TransactionCompletedDateTime' => $TransactionCompletedDateTime,
                'B2CUtilityAccountAvailableFunds' => $B2CUtilityAccountAvailableFunds,
                'B2CWorkingAccountAvailableFunds' => $B2CWorkingAccountAvailableFunds,
                'issued' => true,
                'order_id' => $order->id,
                'response'=>$callbackJsonData
            ];

        }
        //else the disbursement failed
        else {
            $result = [
                'ResultCode' => $resultCode,
                'ResultDesc' => $resultDesc,
                'OriginatorConversationID' => $originatorConversationID,
                'ConversationID' => $conversationID,
                'TransactionID' => $transactionID,
                'issued' => false,
                'order_id' => $order->id,
                'response'=>$callbackJsonData
            ];
        }

        $mpesa_disbursement_response = MpesaDisbursementResponse::query()
            ->where('OriginatorConversationID', '=', $originatorConversationID)
            ->first();
        if (!$mpesa_disbursement_response) {
            //mark request as complete
            $mpesa_disbursement_request->update(['issued' => true]);
            //store entire response
            $disbursement_response = MpesaDisbursementResponse::query()
                ->create($result);

            if ($disbursement_response->issued) {
                $transaction = new MpesaDisbursementTransaction();
                $transaction->order_id = $order->id;
                $transaction->transaction_receipt = $TransactionReceipt;
                $transaction->amount = $TransactionAmount;
                $transaction->channel = "MPESA-B2C";
                $transaction->disbursed_at = $TransactionCompletedDateTime;
                $transaction->disbursed_at = now();
                $transaction->disbursed_at = now();
                $transaction->save();

                $order->update([
                    "disbursed" => true,
                    "completed" => true
                ]);

                //notify farmer and user
                $farmer_message = "Dear ".$order->farmer->full_name.",  payment of Ksh. ".number_format($transaction->amount, 2)." for order $order->ref_number has been processed successfully. MPESA REF: $transaction->transaction_receipt";
                SendSMS::dispatch($order->farmer->phone_number, $farmer_message);

                $buyer_message = "Payment for $order->ref_number has been disbursed successfully. MPESA REF: $transaction->transaction_receipt";
                SendSMS::dispatch($order->user->phone_number, $buyer_message);
            }
        }
        Log::info("success response received on mpesa result url => ".(string)$callbackJsonData);
        //terminate transaction
        return $this->finishTransaction($disbursement_response->issued);
    }
    /**
     *
     * Timeout url that receives responses from Safaricom
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function timeout(Request $request)
    {
        $callbackJsonData = file_get_contents('php://input');
        $callbackData = json_decode($callbackJsonData);
        $resultCode = $callbackData->Result->ResultCode;
        $resultDesc = $callbackData->Result->ResultDesc;
        $originatorConversationID = $callbackData->Result->OriginatorConversationID;
        $conversationID = $callbackData->Result->ConversationID;
        $transactionID = $callbackData->Result->TransactionID;
        $mpesa_disbursement_request = MpesaDisbursementRequest::query()
            ->where('OriginatorConversationID','=', $originatorConversationID)
            ->first();
        $order = Order::query()->with(['user', 'farmer'])->find($mpesa_disbursement_request->order_id);
        $result = [
            'ResultCode' => $resultCode,
            'ResultDesc' => $resultDesc,
            'OriginatorConversationID' => $originatorConversationID,
            'ConversationID' => $conversationID,
            'TransactionID' => $transactionID,
            'issued' => false,
            'order_id' => $order->id,
            'json'=>$callbackJsonData
        ];
       MpesaDisbursementResponse::query()->create($result);
       MpesaTimeoutResponse::query()->create(['response'=>$callbackJsonData]);
        Log::info("timeout response received on mpesa timeout url => ".(string)$callbackJsonData);
        return $this->finishTransaction(false);
    }

    public function finishTransaction($issued)
    {
        if ($issued === true) {
            $resultArray = [
                "ResultDesc" => "Confirmation Service request accepted successfully",
                "ResultCode" => "0"
            ];
        } else {
            $resultArray = [
                "ResultDesc" => "Confirmation Service not accepted",
                "ResultCode" => "1"
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($resultArray);
    }
}
