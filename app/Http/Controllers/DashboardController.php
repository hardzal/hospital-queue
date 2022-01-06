<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\MQueue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $queue_today = MQueue::with('polyclinic', 'doctorschedule', 'patient')->where('queue_date', date('Y-m-d'));
        $queue = $queue_today->where('current_position', 1)->get();

        // ketika menggunakan eloquent harus menggunakan object yang berbeda
        $queue_today = MQueue::with('polyclinic', 'doctorschedule', 'patient')->where('queue_date', date('Y-m-d'));
        $queues = $queue_today->where('current_position', 0)->where('status', '<', 2)->orderBy('queue_position', 'ASC')->get();
        $doctorschedules = DoctorSchedule::all();

        return view('dashboard', compact('title', 'queue', 'doctorschedules', 'queues'));
    }

    public function profile()
    {
    }
}
