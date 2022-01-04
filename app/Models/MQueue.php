<?php

namespace App\Models;

use App\Events\QueueUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MQueue extends Model
{
    use HasFactory;
    protected $table = 'queues';
    protected $guarded = [];

    protected $dispatched = [
        'updated' => QueueUpdated::class
    ];

    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class, 'polyclinic_id');
    }

    public function doctorschedule()
    {
        return $this->belongsTo(DoctorSchedule::class, 'doctor_schedule_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
