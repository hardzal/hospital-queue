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
        // current_position
        // 0 -> posisi yang belum berjalan
        // 1 -> posisi yang terdepan
        // status
        // 0 -> skip
        // 1 -> waiting
        // 2 -> done

        $queues = $queue_today->where('current_position', 0)->where('status', '!=', 0)->where('status', '!=', 2)->orderBy('queue_position', 'ASC')->get();
        // dd($queues);
        $doctorschedules = DoctorSchedule::all();

        return view('dashboard', compact('title', 'queue', 'doctorschedules', 'queues'));
    }

    public function profile()
    {
    }
}
