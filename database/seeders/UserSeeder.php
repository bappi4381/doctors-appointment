<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'  => 'admin',
            'firstname' => 'Admin',
            'lastname'  => '',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt(12345678),
            'user_type' => 'admin',
            'phone'     => '',
        ]);

    }
}
