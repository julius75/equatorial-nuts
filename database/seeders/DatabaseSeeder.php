<?php

namespace Database\Seeders;

use App\Models\RawMaterialRequirement;
use App\Models\Region;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            CountySeeder::class,
            RawMaterialSeeder::class,
            RawMaterialRequirement::class,
            RegionSeeder::class,
            FarmerSeeder::class
        ]);
    }
}
