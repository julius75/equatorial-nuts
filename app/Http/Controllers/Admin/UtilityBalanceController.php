<?php

namespace App\Http\Controllers\Admin;

use AfricasTalking\SDK\AfricasTalking;
use App\Http\Controllers\Controller;
use App\Models\MpesaDisbursementSetting;
use Illuminate\Http\Request;

class UtilityBalanceController extends Controller
{
    public function index()
    {
        try {
            $mpesa_balance = new AccountBalanceController();
            $mpesa_balance->mpesa_balance();
        } catch (\Exception $exception) {
            //
        }
        $environment = config('app.mpesa_environment');
        $disbursement_settings = MpesaDisbursementSetting::query()
            ->where('environment', '=', $environment)
            ->first();
        $username = config('app.africastalking_username');
        $apiKey   = config('app.africastalking_api_key');
        $AT = new AfricasTalking($username, $apiKey);
        $application = $AT->application();
        // Fetch the application data
        try {
            $data = $application->fetchApplicationData();
            $balance = $data['data']->UserData->balance;
        } catch (\Exception $e) {
            $balance = 'N/A';
        }
        $data['paybill'] = decrypt($disbursement_settings->paybill);
        $data['ATBalance'] = $balance;

        if ($disbursement_settings->utility_balance != null) {
            $exp = explode('|', $disbursement_settings->utility_balance);
            $work = explode('|', $disbursement_settings->mmf_balance);
            $data['mpesa_paybill_balance'] = 'KES ' . number_format($exp[2], 2) . ' as at ' . $disbursement_settings->last_updated_at;
            $data['mpesa_paybill_working_balance'] = 'KES ' . number_format($work[2], 2) . ' as at ' . $disbursement_settings->last_updated_at;
        } else {
            $data['mpesa_paybill_balance'] = '--';
            $data['mpesa_paybill_working_balance'] = '--';
        }
        return view('admin.utilities.index', $data);
    }
}
