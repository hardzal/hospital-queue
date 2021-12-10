<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'Admin Pertama',
            'username' => 'admin_pertama',
            'password' => bcrypt('password'),
            'email' => 'admin_pertama@gmail.com'
        ]);
    }
}
