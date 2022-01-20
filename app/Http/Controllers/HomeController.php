<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\Medicalrecord;
use App\Models\MQueue;
use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:patient');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Dashboard";
        $queues = MQueue::orderBy('status', 'ASC')->orderBy('queue_date', 'ASC')->with('polyclinic', 'doctorschedule', 'patient')->get();

        $doctorschedules = DoctorSchedule::all();
        $queue_user = [];
        if (auth()->check()) {
            $queue_user = MQueue::where('patient_id', auth()->user()->id)->where('status', 1)->get();
        }

        return view('home.index', compact('title', 'queues', 'doctorschedules', 'queue_user'));
    }

    public function welcome()
    {
        return view('home.welcome');
    }

    public function profile()
    {
        $title = "Profile";
        return view('home.profile', compact('title'));
    }

    public function histories()
    {
        $title = "History Medic Record";
        $medicalrecords = Medicalrecord::where('patient_id', auth()->user()->id);
        return view('home.histories', compact('title', 'medicalrecords'));
    }

    public function test_print()
    {
        $connector = new WindowsPrintConnector("POS-80C");
        $printer = new Printer($connector);

        /* Initialize */
        $printer->initialize();

        /* Text */
        $printer->text("Hello world\n");
        $printer->cut();

        /* Always close the printer! On some PrintConnectors, no actual
         * data is sent until the printer is closed. */
        $printer->close();
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
        $text = $queue->polyclinic->code . expandingNumberSize($queue->queue_position);
        $poly = $queue->polyclinic->name;
        /* Text */
        $printer->text("$text\n");
        $printer->text("\n");
        $printer->text("$poly\n");
        $printer->text("$queue->queue_date\n\n");
        $printer->cut();

        /* Always close the printer! On some PrintConnectors, no actual
         * data is sent until the printer is closed. */
        $printer->close();
    }
}
