<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctor_schedule', 'schedule_id', 'user_id');
    }

    public function scheduleTime($schedule)
    {
        return DB::table('schedules')
            ->where('day_start', $schedule['day_start'])
            ->where('day_end', $schedule['day_end'])
            ->where('time_start', $schedule['time_start'])
            ->where('time_end', $schedule['time_end'])
            ->get();
    }
}
