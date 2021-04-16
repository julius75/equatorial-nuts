<?php

namespace Database\Seeders;

use App\Models\Farmer;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exists = Farmer::where('id_number', '=', '10000000')->exists();
        if (!$exists){
            Farmer::create([
                'full_name'=>'DEVEINT FARMER',
                'gender'=>'MALE',
                'id_number'=>'10000000',
                'phone_number'=>'254725730055',
                'status'=>true,
                'date_of_birth'=>Carbon::now()->subYears(30),
                'region_id'=>Region::first()->id
            ]);
        }
    }
}
