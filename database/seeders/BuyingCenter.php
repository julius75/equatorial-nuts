<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Farmer;
use App\Models\RawMaterial;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BuyingCenter extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = Region::all();
        foreach ($regions as $region){
            \App\Models\BuyingCenter::create([
                'region_id'=>$region->id,
                'name'=>'Umoja',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        }
    }
}
