<?php

namespace Database\Seeders;

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
        DB::table('admins')->insert([
            'role_id' => '1',
            'first_name' => 'Admin',
            'last_name' => 'admin@gmail.com',
            'email' => 'Admin',
            'phone_number' => 'admin@gmail.com',
            'password'=>Hash::make('secretpassword'),
        ]);
    }
}
