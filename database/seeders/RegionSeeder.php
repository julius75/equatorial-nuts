<?php

namespace Database\Seeders;

use App\Models\County;
use App\Models\RawMaterial;
use App\Models\Region;
use App\Models\SubCounty;
use Illuminate\Database\Seeder;
use function PHPUnit\Framework\isEmpty;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $regions = Region::all();
        $raw_material = RawMaterial::where('name', '=', 'MACADAMIA NUTS')->firstOrFail();
        if (isEmpty($regions))
        {
            $county = SubCounty::where('name', '=', 'Thika town')->first();
            $centers = ['Kamwangi', 'Kiganjo', 'Gitare', 'Marige', 'Kihumbu', 'Chomo', 'Ngorongo', 'Riuki'];
            $region =  Region::create([
                'name'=>'Thika',
                'county_id'=>$county->county_id,
                'sub_county_id'=>$county->id,
            ]);
            foreach ($centers as $center){
              $buying_center = $region->buying_centers()->create([
                   'name'=>$center
               ]);
              $buying_center->raw_materials()->attach($raw_material->id);
            }
        }
    }
}
