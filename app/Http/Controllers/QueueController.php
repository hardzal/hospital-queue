<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQueueRequest;
use App\Models\DoctorSchedule;
use App\Models\MQueue;
use App\Models\Polyclinic;
use Illuminate\Http\Request;
use stdClass;

class QueueController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:patient');
    }

    public function index()
    {
        $title = "Daftar Antrian Saat ini";
        $queues = MQueue::all();
        return view('queues.index', compact('title', 'queues'));
    }

    public function register()
    {
        $title = "Mendaftar Antrian";
        $polyclinics = Polyclinic::all();
        return view('queues.register', compact('title', 'polyclinics'));
    }

    public function store(StoreQueueRequest $request)
    {
        $validated = $request->validated();
        $queue_position = 1;
        $polyclinic_id = $request['polyclinic_id'];
        date_default_timezone_set('Asia/Jakarta');

        $last = MQueue::where('polyclinic_id', $polyclinic_id)
            ->where('queue_date', $validated['queue_date'])
            ->orderBy('queue_date', 'DESC');


        if ($last->count() > 0) {
            $doctor = DoctorSchedule::find($validated['doctor_schedule_id']);
            $jumlah = $last->count();
            if ($jumlah + 1 > $doctor->quota) {
                return redirect()->route('queues')->with('error', 'Antrian sudah penuh!');
            }

            $queue_position = $last->get()->first()->queue_position + 1;
        }

        $current_position = 0;

        if ($queue_position == 1) {
            $current_position = 1;
        }

        $data = [
            'patient_id' => $validated['patient_id'],
            'polyclinic_id' => $polyclinic_id,
            'doctor_schedule_id' => $validated['doctor_schedule_id'],
            'queue_date' => $validated['queue_date'],
            'queue_position' => $queue_position,
            'current_position' => $current_position,
            'status' => $validated['status']
        ];

        $queue = MQueue::create($data);

        return redirect()->route('queue.show', ['queue' => $queue->id])->with('success', 'Berhasil mendaftar ke dalam antrian');
    }

    public function getSchedules($poly_id)
    {
        $schedules = DoctorSchedule::where('polyclinic_id', $poly_id)->where('quota', '>', 0)->get();
        $result = [];

        foreach ($schedules as $schedule) {
            $temp = new stdClass;
            $temp->id = $schedule->id;
            $temp->doctor_id = $schedule->user_id;
            $temp->polyclinic_id = $schedule->polyclinic_id;
            $temp->schedule_id = $schedule->schedule_id;
            $temp->status = $schedule->status;
            $temp->quota = $schedule->quota;
            $temp->doctor_name = $schedule->doctor->name;
            $temp->schedule = $schedule->schedule->day_start . " - " . $schedule->schedule->day_end . " : " .  $schedule->schedule->time_start . " - " . $schedule->schedule->time_end;

            $result[] = $temp;
        }

        $data =  [
            'status' => http_response_code(200),
            'data' => $result
        ];
        return response()->json($data);
    }

    public function show(MQueue $queue)
    {
        $title = "Detail Antrian";

        return view('queues.show', compact('title', 'queue'));
    }

    public function getDate($time)
    {
        $date_start = date('Y-m-d', $time);
        $data = [0 => $date_start];

        for ($i = 1; $i <= 30; $i++) {
            $data[] = date('Y-m-d', strtotime("+" . $i . " day", $time));
        }
        $result = [
            'data' => $data
        ];

        return response()->json($result);
    }

    public function lists()
    {
        $title = "Daftar Seluruh Antrian";
        $queues = MQueue::orderBy('queue_date', 'ASC')->with('polyclinic', 'doctorschedule', 'patient')->get();
        return view('queues.lists', compact('title', 'queues'));
    }

    public function update(MQueue $queue)
    {
        
    }

    public function delete()
    {
    }
}
