<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class QualityInventoryAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quality = Admin::query()->where('email', '=', 'quality@deveint.com')->exists();
        if (!$quality){
            $quality = Admin::query()->create([
                'first_name'=>'Deveint',
                'last_name'=>'Quality',
                'email'=>'quality@deveint.com',
                'phone_number'=>'2547300',
                'password'=>Hash::make('secretpassword'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'status'=>true
            ]);
            $quality->assignRole('quality_management');
        }

        $inventory = Admin::query()->where('email', '=', 'inventory@deveint.com')->exists();
        if (!$inventory){
            $inventory = Admin::query()->create([
                'first_name'=>'Deveint',
                'last_name'=>'Inventory',
                'email'=>'inventory@deveint.com',
                'phone_number'=>'2547355',
                'password'=>Hash::make('secretpassword'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'status'=>true
            ]);
            $inventory->assignRole('inventory');
        }
    }
}
