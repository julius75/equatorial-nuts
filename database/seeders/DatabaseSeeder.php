<?php

namespace Database\Seeders;

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
            RawMaterialSeeder::class,
            CountySeeder::class,
            RegionSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            RawMaterialRequirementSeeder::class,
            FarmerSeeder::class,
            PriceListSeeder::class
        ]);
    }
}
