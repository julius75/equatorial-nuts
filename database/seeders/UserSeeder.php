<?php

namespace Database\Seeders;

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
        $buyer = User::where('email', '=', 'buyer@deveint.com')->exists();
        if (!$buyer){
            $buyer = User::create([
                'first_name'=>'Nuts',
                'last_name'=>'Buyer',
                'email'=>'buyers@deveint.com',
                'phone_number'=>'254725730055',
                'password'=>Hash::make('secretpassword'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
            $buyer->assignRole('buyer');
        }
    }
}
