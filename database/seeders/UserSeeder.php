<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role; 


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username'  => 'admin',
            'firstname' => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt(12345678),
            'user_type' => 'admin',
        ]);

        $role = Role::where('name','admin')->first();

        DB::table('model_has_roles')->insert([
            'role_id' => $role->id,
            'model_type' => 'App\Models\User',
            'model_id' => $user->id,
            'team_id' => 1,
        ]);
    }
}
