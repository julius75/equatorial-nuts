<?php

namespace Database\Seeders;

use App\Models\County;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //only seed if counties table is empty
        $count = DB::table('counties')->count();
        if ($count == 0){
            $path = public_path().'/counties-json/counties.json';
            $counties_array = json_decode(file_get_contents($path), true);
            foreach ($counties_array as $item){
                $county = County::create([
                    'name'=>$item['name'],
                    'capital'=>$item['capital'] ?? null,
                    'code'=>$item['code'],
                ]);

                foreach ($item['sub_counties'] as $subItem){
                    $county->subCounties()->create([
                        'name'=>$subItem
                    ]);
                }
            }
        }
    }
}
