<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buyer = User::query()->where('email', '=', 'mukhami@deveint.com')->exists();
        $region = Region::query()->first();
        $admin = Admin::query()->first();
        if (!$buyer){
            $buyer = User::create([
                'first_name'=>'Test',
                'last_name'=>'Buyer',
                'email'=>'mukhami@deveint.com',
                'phone_number'=>'254725730055',
                'password'=>Hash::make('secretpassword'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
            $buyer->assignRole('buyer');
            $buyer->regions()->attach($region->id,['current'=> true,'assigned_by'=> $admin->id, 'assigned_at'=> now()]);
        }
    }
}
