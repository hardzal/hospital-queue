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
    {   // seed 1
        User::create([
            'role_id' => 1,
            'name' => 'Admin Pertama',
            'username' => 'admin_pertama',
            'password' => bcrypt('password'),
            'email' => 'admin_pertama@gmail.com'
        ]);
        // seed 2
        User::create([
            'role_id' => 2,
            'name' => 'Staff Pertama',
            'username' => 'staff_pertama',
            'password' => bcrypt('password'),
            'email' => 'staff_pertama@gmail.com'
        ]);
        User::create([
            'role_id' => 2,
            'name' => 'Staff Kedua',
            'username' => 'staff_kedua',
            'password' => bcrypt('password'),
            'email' => 'staff_kedua@gmail.com'
        ]);
        User::create([
            'role_id' => 3,
            'name' => 'Doketer Pertama',
            'username' => 'dokter_pertama',
            'password' => bcrypt('password'),
            'email' => 'dokter_pertama@gmail.com'
        ]);
        User::create([
            'role_id' => 3,
            'name' => 'Dokter Kedua',
            'username' => 'dokter_kedua',
            'password' => bcrypt('password'),
            'email' => 'dokter_kedua@gmail.com'
        ]);
    }
}
