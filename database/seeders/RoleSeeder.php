<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Role::where('name', '=', 'admin')->exists() and
            !Role::where('name', '=', 'user')->exists() and
            !Role::where('name', '=', 'buyer')->exists() and
            !Role::where('name', '=', 'inventory')->exists() and
            !Role::where('name', '=', 'management')->exists() and
            !Role::where('name', '=', 'quality_management')->exists())
        {
            DB::table('roles')->insert([
                ['name' => 'admin',
                    'guard_name' => 'admin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),],
                ['name' => 'inventory',
                    'guard_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),],
                ['name' => 'management',
                    'guard_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),],
                ['name' => 'quality_management',
                    'guard_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),],
                ['name' => 'buyer',
                    'guard_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),],
                ['name' => 'user',
                    'guard_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),],
            ]);
        }

    }
}
