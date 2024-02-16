<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            'ACCESSIBILITY',
            'BEST_PRACTICES',
            'PERFORMANCE',
            'PWA',
            'SEO'
        ];

        for( $i=0; $i < count($categories); $i++ ) { 
            Category::create( ['name' => $categories[$i]] );
        }
    }
}
