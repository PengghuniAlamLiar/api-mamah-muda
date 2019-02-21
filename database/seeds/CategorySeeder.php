<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('category')->delete();
        DB::table('category')->insert([
            [
                'category_name' => 'gizi',
                'category_status' => 1
            ],
            [
                'category_name' => 'artikel',
                'category_status' => 1
            ],
            [
                'category_name' => 'penyakit',
                'category_status' => 1
            ],
            [
                'category_name' => 'tips',
                'category_status' => 1
            ]
        ]);
    }
}
