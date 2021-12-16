<?php

namespace App\Http\Controllers;

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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
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
