<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\RawMaterial;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rawMaterials = RawMaterial::all();
        $randomPrices = [201.50,111,256,81.50,901.50];
        foreach ($rawMaterials as $material){
            $key = array_rand($randomPrices);
            $amount = $randomPrices[$key];
            $material->prices()->create([
                'region_id'=>Region::first()->id,
                'date'=>Carbon::now()->subDays(2),
                'amount'=>$amount,
                'value'=>1,
                'unit'=>'kg',
                'approved'=>true,
                'created_by'=>Admin::first()->id,
                'approved_by'=>Admin::first()->id,
                'approved_at'=>Carbon::now(),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        }
    }
}
