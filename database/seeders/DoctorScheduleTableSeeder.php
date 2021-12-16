<?php

namespace Database\Seeders;

use App\Models\DoctorSchedule;
use Illuminate\Database\Seeder;

class DoctorScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctorSchedule::create([
            'polyclinic_id' => 1,
            'schedule_id' => 2,
            'user_id' => 4,
            'quota' => 40,
            'status' => 1,
            'description' => 'Apapun itu saya akan bertanya'
        ]);

        DoctorSchedule::create([
            'polyclinic_id' => 1,
            'schedule_id' => 3,
            'user_id' => 4,
            'quota' => 40,
            'status' => 1,
            'description' => 'Apapun itu saya akan bertanya'
        ]);

        DoctorSchedule::create([
            'polyclinic_id' => 2,
            'schedule_id' => 1,
            'user_id' => 5,
            'quota' => 30,
            'status' => 1,
            'description' => 'Apapun itu saya akan bertanya'
        ]);

        DoctorSchedule::create([
            'polyclinic_id' => 2,
            'schedule_id' => 3,
            'user_id' => 5,
            'quota' => 30,
            'status' => 1,
            'description' => 'Apapun itu saya akan bertanya'
        ]);
    }
}
