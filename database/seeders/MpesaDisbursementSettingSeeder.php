<?php

namespace Database\Seeders;

use App\Models\MpesaDisbursementSetting;
use Illuminate\Database\Seeder;

class MpesaDisbursementSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check = MpesaDisbursementSetting::query()->where('environment', '=', 'sandbox')->exists();
        if (!$check){
            $setting = new MpesaDisbursementSetting();
            $setting->environment = "sandbox";
            $setting->paybill = encrypt("603021");
            //unencrypted credential = Safaricom3021#
            $setting->security_credential = encrypt("lOlTP/K3xY7tnEaeeBY4lm0CeHwERddAqYL25XeLCFKU1of8/OMsXlH3psWn6LsZkSui62hiKbavOmePLWfVnh9OusBA1oYMgXaJSHfDBJ6mCcGzJ8EC6IEwGWsSJRbYtZWxdSQROJe5r1Z/FdztD2PiqTsVv7f0PodKkb5WnUa0eaGvEkV3wk/3t5H1U92OgLNJ66g7PWEWf46sByzUMTvH6PvBjH/dBbl4c9pSAB6EukAGXcR33IXO2rFlaI3/X4uuPLrlYcyUKI/dosQaZuF9vocKPz5IEcTHKYY6BcqR8xEhUzzWLTUMVw2OmRBFP52XnuX3lpLgpX554/gCWg==");
            $setting->initiator_name = encrypt("apiop37");
            $setting->consumer_key = encrypt("8FBZP7EnagwQsicFVsKPPRwufFkhJOUy");
            $setting->consumer_secret = encrypt("cg6kSMlf3a4CBIhV");
            $setting->mmf_balance = null;
            $setting->utility_balance = null;
            $setting->last_updated_at = now();
            $setting->created_at = now();
            $setting->updated_at = now();
            $setting->save();
        }
    }
}
