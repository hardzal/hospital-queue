<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'gender' => 'P',
            'name' => 'Pasien Baru',
            'email' => 'randomemail@gmail.com',
            'no_hp' => 0213123131
        ]);
        Patient::create([
            'gender' => 'L',
            'name' => 'Pasien Sepuh',
            'email' => 'randomemail1@gmail.com',
            'no_hp' => 0213123141
        ]);
        Patient::create([
            'gender' => 'L',
            'name' => 'Pasien Senior',
            'email' => 'randomemai2l@gmail.com',
            'no_hp' => 0213123531
        ]);
        Patient::create([
            'gender' => 'P',
            'name' => 'Pasien-KUN',
            'email' => 'randomemail3@gmail.com',
            'no_hp' => 0213125531
        ]);
        Patient::create([
            'gender' => 'L',
            'name' => 'Pasien SUS',
            'email' => 'randomemail6@gmail.com',
            'no_hp' => 0213123661
        ]);
    }
}
