<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MpesaDisbursementSetting;
use App\Models\MpesaTimeoutResponse;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AccountBalanceController extends Controller
{
    /**
     *
     * Get Access Token
     * @return void
     */
    protected function get_sandbox_access_token()
    {
        $disbursement_settings = MpesaDisbursementSetting::query()
            ->where('environment', '=', 'sandbox')
            ->first();
        if (!$disbursement_settings){
            return null;
        }
        $consumer_key = decrypt($disbursement_settings->consumer_key);
        $consumer_secret = decrypt($disbursement_settings->consumer_secret);
        if (!isset($consumer_key) or !isset($consumer_secret)){
            return null;
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
    //mpesa balance
    public function mpesa_balance()
    {
        $environment = config('app.mpesa_environment');
        $disbursement_settings = MpesaDisbursementSetting::query()
            ->where('environment', '=', $environment)
            ->first();
        if (!$disbursement_settings){
            return response()->json(['message' => 'Sandbox Disbursement settings not found'], Response::HTTP_NOT_FOUND);
        }
        if ($environment == "production") {
            $url = 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query';
            $token = self::generateLiveToken();
        } elseif ($environment == "sandbox") {
            $url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';
            $token = self::get_sandbox_access_token();
        } else {
            return json_encode(["Message" => "invalid application status"]);
        }
        $initiator_name = decrypt($disbursement_settings->initiator_name);
        $security_credentials = decrypt($disbursement_settings->security_credential);
        $command_id = config('app.mpesa_account_balance_command_id');
        $identifier_type = config('app.mpesa_account_balance_identifier_type');
        $partyA = decrypt($disbursement_settings->paybill);
        $queue_timeout_url = route('mpesa_account_balance.timeout');
        $result_url = route('mpesa_account_balance.result');
        $remarks = 'MPESA Balance';

        try {
            $client = new Client();
            $send_request = $client->request('post', $url, [
                'verify' => false,
                'http_errors' => false,
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode(
                    [
                        'Initiator' => $initiator_name,
                        'SecurityCredential' => $security_credentials,
                        'CommandID' => $command_id,
                        'PartyA' => $partyA,
                        'Remarks' => $remarks,
                        'QueueTimeOutURL' => $queue_timeout_url,
                        'ResultURL' => $result_url,
                        'IdentifierType' => $identifier_type
                    ]
                )
            ]);
            $obj = json_decode((string)$send_request->getBody());
            if ($obj->ResponseCode == 0) {
                Log::info("Account Balance Post Response =>".(string)$send_request->getBody());
                return true;
            }
            Log::error("Account Balance Post Response =>".(string)$send_request->getBody());
            return false;
        } catch (BadResponseException $e) {
            Log::error("guzzle exception Account Balance => ". (string)$e->getResponse()->getBody()->getContents());
            return false;
        }
    }

    public function mpesa_balance_result()
    {
        $callbackJSONData = file_get_contents('php://input');
        $callbackData = json_decode($callbackJSONData);
        $resultCode = $callbackData->Result->ResultCode;
        $environment = config('app.mpesa_environment');
        Log::info("Account-Balance Result Url => ".(string)$callbackJSONData);
        if ($resultCode == 0) {
            $ar = explode('&', $callbackData->Result->ResultParameters->ResultParameter[0]->Value);
            $disbursement_settings = MpesaDisbursementSetting::query()
                ->where('environment', '=', $environment)
                ->first();
            $disbursement_settings->update([
                'mmf_balance' => $ar[0],
                'utility_balance' => $ar[1],
                'last_updated' => Carbon::now()
            ]);
        }
    }

    public function mpesa_balance_timeout(Request $request)
    {
        $callbackJSONData = file_get_contents('php://input');
        MpesaTimeoutResponse::query()->create(['response'=>$callbackJSONData]);

    }
}
