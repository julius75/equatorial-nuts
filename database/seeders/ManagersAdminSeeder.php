<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagersAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gm = Admin::query()->where('email', '=', 'gmanager@deveint.com')->exists();
        if (!$gm){
            $quality = Admin::query()->create([
                'first_name'=>'Deveint',
                'last_name'=>'GManager',
                'email'=>'gmanager@deveint.com',
                'phone_number'=>'2547325',
                'password'=>Hash::make('secretpassword'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'status'=>true
            ]);
            $quality->assignRole('general_management');
        }

        $manager = Admin::query()->where('email', '=', 'manager@deveint.com')->exists();
        if (!$manager){
            $inventory = Admin::query()->create([
                'first_name'=>'Deveint',
                'last_name'=>'Manager',
                'email'=>'manager@deveint.com',
                'phone_number'=>'2547373',
                'password'=>Hash::make('secretpassword'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'status'=>true
            ]);
            $inventory->assignRole('management');
        }
    }
}
