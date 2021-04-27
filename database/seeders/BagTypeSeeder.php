<?php

namespace Database\Seeders;

use App\Models\BagType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BagTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sisal = BagType::query()->where('name', '=', 'Sisal')->exists();
        if (!$sisal){
            BagType::create([
                'name'=>'Sisal',
                'weight'=>1,
                'unit'=>'kg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        }
        $pp = BagType::query()->where('name', '=', 'Polythene')->exists();
        if (!$pp){
            BagType::create([
                'name'=>'Polythene',
                'weight'=>0.1,
                'unit'=>'kg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        }
    }
}
