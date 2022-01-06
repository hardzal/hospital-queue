<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQueueRequest;
use App\Models\DoctorSchedule;
use App\Models\Medicalrecord;
use App\Models\MQueue;
use App\Models\Polyclinic;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use stdClass;

class QueueController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:patient');
    }

    public function index(Request $request)
    {
        $title = "Daftar Antrian Saat ini";
        $polyclinics = Polyclinic::all();

        $queues = MQueue::where('queue_date', date('Y-m-d'))->orderBy('queue_position', 'ASC')->orderBy('current_position', 'DESC')->get();
        $queue_dates = [];
        if ($request->polyclinic) {
            $queues = MQueue::where('polyclinic_id', $request->polyclinic)->where('current_position', '!=', 2)
                ->orderBy('queue_date', 'ASC')->orderBy('queue_position', 'ASC')->orderBy('current_position', 'DESC')
                ->get();
            $queue_dates = Arr::pluck(MQueue::select('queue_date')->distinct()->where('polyclinic_id', $request->polyclinic)->get(), 'queue_date');
        }

        if ($request->date) {
            $queues = MQueue::where('polyclinic_id', $request->polyclinic)->where('queue_date', $request->date)
                ->where('current_position', '!=', 2)->orderBy('queue_position', 'ASC')->orderBy('current_position', 'DESC')->get();
        }

        if ($request->polyclinic == 0) {
            $queues = MQueue::where('current_position', '!=', 2)->where('queue_date', '>=', date('Y-m-d'))
                ->orderBy('queue_date', 'ASC')->orderBy('queue_position', 'ASC')->orderBy('current_position', 'DESC')
                ->get();
            $queue_dates = Arr::pluck(MQueue::select('queue_date')->where('current_position', '!=', 2)->where('queue_date', '>=', date('Y-m-d'))->orderBy('queue_date', 'ASC')->distinct()->get(), 'queue_date');
        }

        $queues_data = new stdClass;
        $queues_data->data = $queues;
        $queues_data->time = $queue_dates;

        $queue_today = MQueue::with('polyclinic', 'doctorschedule', 'patient')->where('queue_date', date('Y-m-d'));
        $queue = $queue_today->where('current_position', 1)->get();

        return view('queues.index', compact('title', 'queue', 'queues_data', 'polyclinics', 'queue_dates'));
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

            if ($jumlah > $doctor->quota) {
                return redirect()->route('queues')->with('error', 'Antrian sudah penuh!');
            }

            $queue_position = $last->get()->first()->queue_position + 1;

            if ($last->where('patient_id', $validated['patient_id'])->count()) {
                return redirect()->route('queues')->with('error', 'Anda sudah mengantri!');
            }
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
        $this->createPrint($queue);

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

    public function lists(Request $request)
    {
        $title = "Daftar Seluruh Antrian";
        $polyclinics = Polyclinic::all();

        $queues = MQueue::orderBy('status', 'ASC')->orderBy('queue_date', 'ASC')->with('polyclinic', 'doctorschedule', 'patient');

        if (isset($request->polyclinic_id)) {
            $queues = MQueue::orderBy('status', 'ASC')->where('polyclinic_id', $request->polyclinic_id);
        }

        if (isset($request->queue_date)) {
            $queues = $queues->where('queue_date', $request->queue_date);
        }

        if (!isset($request->queue_date)) {
            $queues = $queues->where('queue_date', date('Y-m-d'))->get();
        }

        return view('queues.lists', compact('title', 'queues', 'polyclinics'));
    }

    public function poly(Polyclinic $polyclinic)
    {
        return view('queues.polys', compact('polyclinic'));
    }

    public function update(Request $request, MQueue $queue)
    {
        $request->validate([
            'current_position' => 'required',
            'status' => 'required'
        ]);

        $queue->current_position = $request->current_position;
        $queue->status = $request->status;
        $queue->save();
        $queue_current = null;

        if ($request->current_position == 0) {
            if ($request->type == 'next') {
                $queue_current = MQueue::where('queue_position', $queue->queue_position + 1)->where('queue_date', $queue->queue_date)->get()->first();
            } else if ($request->type == 'prev') {
                $queue_current = MQueue::where('queue_position', $queue->queue_position - 1)->where('queue_date', $queue->queue_date)->get()->first();
            }
            if ($queue_current != null) {
                $queue_current->current_position = 1;
                $queue_current->save();
            }
        }
        // dd($queue);
        if ($queue_current != null && $request->status == 2) {

            $history_medics = [
                'patient_id' => $queue->patient_id,
                'doctor_schedule_id' => $queue->doctor_schedule_id,
                'type' => $request->type,
                'description' => "",
                'queue_position' => $queue->queue_position,
            ];

            Medicalrecord::create($history_medics);
        }

        if ($request->status != 2) {
            // return redirect()->route('queues.list', ['polyclinic_id' => $request->poly_id, 'queue_date' => $request->queue_date])->with('error', 'Antrian terskip, lanjut ke antrian selanjutnya');
            return response()->json([
                'message' => 'Antrian terskip, lanjut ke antrian selanjutnya'
            ]);
        }

        // return redirect()->route('queues.list', ['polyclinic_id' => $request->poly_id, 'queue_date' => $request->queue_date])->with('success', 'Lanjut ke antrian selanjutnya');

        return response()->json([
            'message' => 'Lanjut ke antrian selanjutnya'
        ]);
    }

    public function delete(MQueue $queue)
    {
        $queue->delete();
        return redirect()->route('queues.list')->with('success', 'Berhasil menghapus data antrian');
    }

    public function print(MQueue $queue)
    {
        $this->createPrint($queue);
    }

    protected function createPrint(MQueue $queue)
    {
        $connector = new WindowsPrintConnector("POS-80C");
        $printer = new Printer($connector);

        /* Initialize */
        $printer->initialize();
        $text = $queue->polyclinic->code . " | " . expandingNumberSize($queue->queue_position);
        $poly = $queue->polyclinic->name;
        /* Text */
        $printer->setTextSize(2, 1);
        $printer->setJustification(
            Printer::JUSTIFY_CENTER,
        );
        $printer->text("Rumah Sakit Ananda\n\n");
        $printer->setTextSize(2, 2);
        $printer->text("$text\n");
        $printer->setTextSize(1, 1);
        $printer->text("$poly\n\n");
        $printer->setTextSize(1, 1);
        $printer->text(date("Y/m/d H:i:s") . "\n\n");
        $printer->cut();

        /* Always close the printer! On some PrintConnectors, no actual
         * data is sent until the printer is closed. */
        $printer->close();
    }

    public function newQueue(Request $request)
    {
        $request->validate([
            'polyclinic_id' => 'required',
            'status' => 'required',
            'queue_date' => 'required',
            'patient_id' => 'required',
        ]);

        $data['doctor_schedule_id'] = 0;
        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
        $today = date('w');

        $polyclinic_id = $request->polyclinic_id;
        $schedules = Schedule::all();
        $schedule_day = [];
        // retrieve all schedule to find the day beetween of the schedule that same of this day
        foreach ($schedules as $index => $schedule) {
            $temp = new stdClass;
            $date_day = [];
            $temp_start = array_keys($days, $schedule->day_start);
            $temp_end = array_keys($days, $schedule->day_end);
            for ($i = $temp_start[0]; $i <= $temp_end[0]; $i++) {
                $date_day[] = $i;
            }

            if (in_array($today, $date_day)) {
                $temp->schedule_id = $schedule->id;
                $temp->date_day = $date_day;
                $schedule_day[] = $temp;
            }
        }
        $doctor_schedule = [];
        // find the doctor_schedule_id based on polyclinic_id and the schedule_id
        foreach ($schedule_day as $index => $item) {
            $doctorschedules = DoctorSchedule::where('polyclinic_id', $polyclinic_id)->where('schedule_id', $item->schedule_id)->get();
            if (count($doctorschedules)) {
                $doctor_schedule[] = $doctorschedules->first()->id;
            }
        }
        $today = date('Y-m-d');
        $last = MQueue::where('polyclinic_id', $polyclinic_id)
            ->where('queue_date', $today)
            ->orderBy('queue_date', 'DESC')
            ->orderBy('queue_position', 'DESC');

        $queue_position = 1;
        if (!empty($doctor_schedule)) {
            $doctor_schedule_id = $doctor_schedule[0];
        } else {
            $queue = 404;
            $title = "Antrian Rumah Sakit";
            return view('queues.show', compact('queue', 'title'));
        }

        if ($last->count() > 0) {
            foreach ($doctor_schedule as $item) {
                $doctor = DoctorSchedule::find($item);
                $jumlah = $last->count();

                if ($jumlah > $doctor->quota) {
                    return redirect()->route('queues')->with('error', 'Antrian sudah penuh!');
                }
                $doctor_schedule_id = $item;
            }

            if ($last->where('patient_id', $request->patient_id)->count()) {
                if ($request->patient_id != 6) {
                    return redirect()->route('queues')->with('error', 'Anda sudah mengantri!');
                }
            }

            if ($last->get()->first()) {
                $queue_position = $last->get()->first()->queue_position + 1;
            }
        }

        $current_position = 0;

        if ($queue_position == 1) {
            $current_position = 1;
        }

        $data = [
            'patient_id' => $request->patient_id,
            'polyclinic_id' => $polyclinic_id,
            'doctor_schedule_id' => $doctor_schedule_id,
            'queue_date' => $today,
            'queue_position' => $queue_position,
            'current_position' => $current_position,
            'status' => $request->status
        ];

        $queue = MQueue::create($data);

        $this->print($queue);

        return redirect()->route('queue.show', ['queue' => $queue->id])->with('success', 'Berhasil mendaftar ke dalam antrian');
    }

    public function search(Request $request)
    {
        $request->validate([
            'code_rm' => 'required',
            'queue_date' => 'required'
        ]);

        $title = "Hasil Pencarian Antrian";
        $poly_code = substr($request->code_rm, 0, 3);
        $last_part = str_split(substr($request->code_rm, 3, 4));
        $last_position = 0;
        for ($i = 0; $i < sizeof($last_part); $i++) {
            if ($last_part[$i] > 0) {
                $last_position = $i;
                break;
            }
        }
        $queue_position = "";
        for ($i = $last_position; $i < sizeof($last_part); $i++) {
            $queue_position .= $last_part[$i];
        }

        $queue_date = $request->queue_date;
        $polyclinic = Polyclinic::where('code', $poly_code)->get()->first();
        $queue = [];

        if ($polyclinic->id != null) {
            $queue = MQueue::where('polyclinic_id', $polyclinic->id)->where('queue_date', $queue_date)->where('queue_position', $queue_position)->get()->first();
        }
        return view('queues.show', compact('title', 'queue'));
    }

    public function call(MQueue $queue)
    {
    }
}
