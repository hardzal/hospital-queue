<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicalrecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctorschedule()
    {
        return $this->belongsTo(DoctorSchedule::class, 'doctor_schedule_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
