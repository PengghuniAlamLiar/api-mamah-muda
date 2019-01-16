<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name'     => 'ara',
            'email'    => 'arakoswara2@gmail.com',
            'password' => app('hash')->make('qwerty')
        ]);
    }
}
