<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserWithRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventory = Admin::firstOrCreate([
            'first_name'=>'Deveint',
            'last_name'=>'Inventory',
            'email'=>'inventory@demo.com',
            'phone_number'=>'254720202050',
            'password'=>Hash::make('secretpassword'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            'status'=>true
        ])->assignRole('inventory');
        $general_management = Admin::firstOrCreate([
            'first_name'=>'Deveint ',
            'last_name'=>'GManagement',
            'email'=>'gmanagement@demo.com',
            'phone_number'=>'254720202040',
            'password'=>Hash::make('secretpassword'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            'status'=>true
        ])->assignRole('general_management');
        $management = Admin::firstOrCreate([
            'first_name'=>'Deveint',
            'last_name'=>'Management',
            'email'=>'management@demo.com',
            'phone_number'=>'254720202030',
            'password'=>Hash::make('secretpassword'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            'status'=>true
        ])->assignRole('management');
        $management = Admin::firstOrCreate([
            'first_name'=>'Deveint',
            'last_name'=>'QManagement',
            'email'=>'qmanagement@demo.com',
            'phone_number'=>'254720202010',
            'password'=>Hash::make('secretpassword'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            'status'=>true
        ])->assignRole('quality_management');
    }

}
