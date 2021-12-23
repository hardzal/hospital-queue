<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQueueRequest;
use App\Models\DoctorSchedule;
use App\Models\Polyclinic;
use Illuminate\Http\Request;
use stdClass;

class QueueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:patient');
    }

    public function index()
    {
        $title = "Daftar Antrian Saat ini";
        return view('queues.index', compact('title'));
    }

    public function register()
    {
        $title = "Mendaftar Antrian";
        $polyclinics = Polyclinic::all();
        return view('queues.register', compact('title', 'polyclinics'));
    }

    public function store(StoreQueueRequest $request)
    {
    }

    public function getSchedules()
    {
        $schedules = DoctorSchedule::all();
        $result = [];
        foreach ($schedules as $schedule) {
            $temp = new stdClass;
            $temp->doctor_id = $schedule->user_id;
            $temp->polyclinic_id = $schedule->polyclinic_id;
            $temp->schedule_id = $schedule->schedule_id;
            $temp->status = $schedule->status;
            $temp->quota = $schedule->quota;
            $temp->doctor_name = $schedule->doctor->name;
            $temp->schedule = $schedule->schedule->day_start . " - " . $schedule->schedule->day_end . ": " .  $schedule->schedule->time_start . "-" . $schedule->schedule->time_end;

            $result[] = $temp;
        }

        $data =  [
            'status' => http_response_code(200),
            'data' => $result
        ];
        return response()->json($data);
    }
}
