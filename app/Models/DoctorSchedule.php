<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $table = 'doctor_schedule';
    protected $guarded = [];

    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function medicalrecords()
    {
        return $this->hasMany(Medicarecord::class);
    }

    public function doctorTime($data)
    {
        return DB::table('doctor_schedule')
            ->where('user_id', $data['user_id'])
            ->where('schedule_id', $data['schedule_id'])
            ->get();
    }
}
