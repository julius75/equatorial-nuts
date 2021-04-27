<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MpesaDisbursementSetting;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

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
        $obj = json_decode($send_request->getBody(), true);
        return $obj->access_token;
    }

    public function post_disbursement(Request $request)
    {
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
            $amount = 100;
            $partyA = decrypt($disbursement_settings->paybill);
            $partyB = $recipient_phone;
        }
        elseif ($environment == 'production') {
            return response()->json(['message' => 'Production Disbursement settings not found'], Response::HTTP_NOT_FOUND);
        }else {
            return response()->json(['message' => 'Invalid Application Status'], Response::HTTP_UNAUTHORIZED);
        }
        $remarks = 'ENP RAW MATERIALS PURCHASE';
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
                    'QueueTimeoutURL'=>$queue_timeout_url,
                    'ResultURL'=>$result_url,
                    'Occasion'=>$occasion
                ])
            ]);
            $obj = json_decode((string)$send_request->getBody(), true);
            Log::info("response received from disbursement post =>".(string)$send_request->getBody());
            return response()->json(['message'=>'Successfully initiated payment request. Notification SMS will be sent once complete', 'response'=>$obj],Response::HTTP_OK );
        } catch (BadResponseException $exception){
            Log::error("guzzle exception => ". (string)$exception->getResponse()->getBody()->getContents());
            return response()->json(['message' => 'There seems to be an error connecting to the MPESA API, Try again later', 'exception'=>$exception->getResponse()->getBody()->getContents()],Response::HTTP_INTERNAL_SERVER_ERROR );
        }
    }

    public function result(Request $request)
    {
        $callbackJsonData = file_get_contents('php://input');
        Log::info("success response received on mpesa result url => ".$callbackJsonData);

    }

    public function timeout(Request $request)
    {
        $callbackJsonData = file_get_contents('php://input');
        Log::info("success response received on mpesa result url => ".$callbackJsonData);

    }
}
