<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 users using the user factory
        // factory(App\User::class, 10)->create();

        User::insert([
            'name'     => 'ara',
            'email'    => 'arakoswara2@gmail.com',
            'password' => app('hash')->make('qwerty')
        ]);
    }
}
