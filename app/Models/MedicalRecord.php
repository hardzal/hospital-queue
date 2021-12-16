<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicalrecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctorSchedules()
    {
        return $this->belongsTo(DoctorSchedule::class);
    }
}
