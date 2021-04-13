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
        $exists = User::where('email', '=', 'admin@deveint.com')->exists();
        if (!$exists){
            $admin = User::create([
                'first_name'=>'Nuts',
                'last_name'=>'Buyer',
                'email'=>'buyers@deveint.com',
                'password'=>Hash::make('secretpassword'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
            $admin->assignRole('buyer');
        }
    }
}
