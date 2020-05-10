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
        $user = \App\User::create([
            'username' => 'super',
            'last_name' => 'admin',
            'email' => 'super_admin@mypos.com',
            'password' => bcrypt('123456'),

        ]);

        $user->attachRole('super_admin');    }
}
