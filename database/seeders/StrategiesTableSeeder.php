<?php

namespace Database\Seeders;

use App\Models\Strategy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrategiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Strategy::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $strategies = [
            'DESKTOP',
            'MOBILE'
        ];

        for( $i=0; $i < count($strategies); $i++ ) { 
            Strategy::create( ['name' => $strategies[$i]] );
        }
    }
}
