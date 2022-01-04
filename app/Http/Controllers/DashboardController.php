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
        $queue_today = MQueue::where('queue_date', date('Y-m-d'));
        $queue = $queue_today->where('current_position', 1)->get();
        $queues = $queue_today->where('current_position', 0)->orderBy('queue_position', 'ASC')->get();
        $doctorschedules = DoctorSchedule::all();

        return view('dashboard', compact('title', 'queue', 'doctorschedules', 'queues'));
    }

    public function profile()
    {
    }
}
