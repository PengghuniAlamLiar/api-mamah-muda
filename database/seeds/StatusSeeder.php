<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->delete();
        DB::table('status')->create([
            [
                'status_name' => 'active'
            ],
            [
                'status_name' => 'on riview'
            ]
        ]);
    }
}
