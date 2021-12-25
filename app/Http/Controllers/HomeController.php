<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\MQueue;
use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
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
        $this->middleware('auth:patient');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Dashboard";
        $queues = MQueue::all();
        $doctorschedules = DoctorSchedule::all();
        return view('home.index', compact('title', 'queues', 'doctorschedules'));
    }

    public function profile()
    {
        $title = "Profile";
        return view('home.profile', compact('title'));
    }

    public function histories()
    {
        $title = "History Medic Record";

        return view('home.histories', compact('title'));
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

        $printer->pulse();
        /* Always close the printer! On some PrintConnectors, no actual
         * data is sent until the printer is closed. */
        $printer->close();
    }
}
