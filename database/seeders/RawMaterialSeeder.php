<?php

namespace Database\Seeders;

use App\Models\RawMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!RawMaterial::where('name', '=', 'CASHEW NUTS')->exists() and
            !RawMaterial::where('name', '=', 'MACADAMIA NUTS')->exists() and
            !RawMaterial::where('name', '=', 'MAIZE')->exists() and
            !RawMaterial::where('name', '=', 'WHITE SORGHUM')->exists() and
            !RawMaterial::where('name', '=', 'SOYABEANS')->exists())
        {
            DB::table('raw_materials')->insert([
                ['name' => 'CASHEW NUTS'],
                ['name' => 'MACADAMIA NUTS'],
                ['name' => 'MAIZE'],
                ['name' => 'WHITE SORGHUM'],
                ['name' => 'SOYABEANS'],
            ]);
        }    }
}
