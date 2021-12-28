<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Patient::create([
        //     'gender' => 'P',
        //     'name' => 'Pasien Baru',
        //     'email' => 'randomemail@gmail.com',
        //     'no_hp' => 0213123131,
        //     'password' => Hash::make('password')
        // ]);
        // Patient::create([
        //     'gender' => 'L',
        //     'name' => 'Pasien Sepuh',
        //     'email' => 'randomemail1@gmail.com',
        //     'no_hp' => 0213123141,
        //     'password' => Hash::make('password')
        // ]);
        // Patient::create([
        //     'gender' => 'L',
        //     'name' => 'Pasien Senior',
        //     'email' => 'randomemai2l@gmail.com',
        //     'no_hp' => 0213123531,
        //     'password' => Hash::make('password')

        // ]);
        // Patient::create([
        //     'gender' => 'P',
        //     'name' => 'Pasien-KUN',
        //     'email' => 'randomemail3@gmail.com',
        //     'no_hp' => 0213125531,
        //     'password' => Hash::make('password')
        // ]);
        // Patient::create([
        //     'gender' => 'L',
        //     'name' => 'Pasien SUS',
        //     'email' => 'randomemail6@gmail.com',
        //     'no_hp' => 0213123661,
        //     'password' => Hash::make('password')
        // ]);

        Patient::create([
            'gender' => 'L',
            'name' => 'Pasien',
            'email' => 'pasien_normal@gmail.com',
            'no_hp' => '087808505477',
            'password' => Hash::make('password354123')
        ]);
    }
}
