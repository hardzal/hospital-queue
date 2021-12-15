<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'day_start' => 'Senin',
            'day_end' => 'Rabu',
            'time_start' => '08:00',
            'time_end' => '10:00',
        ]);

        Schedule::create([
            'day_start' => 'Senin',
            'day_end' => 'Kamis',
            'time_start' => '13:00',
            'time_end' => '17:00'
        ]);

        Schedule::create([
            'day_start' => 'Rabu',
            'day_end' => 'Jum\'at',
            'time_start' => '15:00',
            'time_end' => '18:00',
        ]);
    }
}
