<?php

namespace Database\Seeders;

use App\Models\Medicalrecord;
use Illuminate\Database\Seeder;

class MedicalrecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medicalrecord::create([
            'patient_id' => 1,
            'doctor_schedule_id' => 1,
            'type' => 'BPJS',
            'description' => 'Hello'
        ]);
        Medicalrecord::create([
            'patient_id' => 2,
            'doctor_schedule_id' => 3,
            'type' => 'BPJS',
            'description' => 'Hello wakowkaokwao'
        ]);
        Medicalrecord::create([
            'patient_id' => 3,
            'doctor_schedule_id' => 2,
            'type' => 'BPJS',
            'description' => 'Hello wakowkaokwao wkaokaokowkakwao'
        ]);
    }
}
