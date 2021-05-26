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
        $checkSandbox = MpesaDisbursementSetting::query()->where('environment', '=', 'sandbox')->exists();
        if (!$checkSandbox){
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

        $checkProduction = MpesaDisbursementSetting::query()->where('environment', '=', 'production')->exists();
        if (!$checkProduction){
            $setting = new MpesaDisbursementSetting();
            $setting->environment = "production";
            $setting->paybill = encrypt("3017177");
            $setting->security_credential = encrypt("f947LA6CAklh5T5KqOPuFDNtJFPnGrW+BlbgkA0hGdlXv03hg6wXWyn1UzhfUvPEDaLc8MNKONbOpT4MWfQhdlTD/IhhKML590g7hFDGv0yVcf8ODWGloHg72Vqq64q5XJ/zUgmQG0F9E24t8UPaSQ3T9HAKmqrjvDl+9Gl2Ppojs+bEDUqN8u67UI7CRxIllDXPJT9zxRhGDHZB2brANAa+39l0f2Kh/3xcVOeiByFIVCZa7GRENt9sM/937ytRALhquh4dFq9oibNdwqsBN4ERLtqby7MkXtbHOeA5w+5OY8e37B7mCytmno0ouRmvcsMf4eR60LSr2I6JaeAIjg==");
            $setting->initiator_name = encrypt("DEVEINT");
            $setting->consumer_key = encrypt("FrgaVjYRDIdIyi9HPdnAnBa6agrNv2Di");
            $setting->consumer_secret = encrypt("p7SX4K1F1IN7cBt4");
            $setting->mmf_balance = null;
            $setting->utility_balance = null;
            $setting->last_updated_at = now();
            $setting->created_at = now();
            $setting->updated_at = now();
            $setting->save();
        }
    }
}
