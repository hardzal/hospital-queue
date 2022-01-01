<?php

namespace Database\Seeders;

use App\Models\Polyclinic;
use Illuminate\Database\Seeder;

class PolyclinicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Polyclinic::create([
            'code' => 'AA0',
            'name' => 'Poli Umum',
            'description' => "Poli Umum"
        ]);
        // Polyclinic::create([
        //     'code' => 'AA1',
        //     'name' => 'POLI Anak - Anak',
        //     'description' => 'Untuk anak - anak yang sedang menuju ke dewasaannya'
        // ]);
        // Polyclinic::create([
        //     'code' => 'OD1',
        //     'name' => 'POLI Orang Dewasa',
        //     'description' => 'Untuk Orang Dewasa yang sedang menuju bingung tentang keadaanya'
        // ]);
        // Polyclinic::create([
        //     'code' => 'JW1',
        //     'name' => 'POLI Orang Dalam Gangguan Jiwa',
        //     'description' => 'Untuk Orang - Orang yang tengah mengalami gangguan jiwa'
        // ]);
    }
}
