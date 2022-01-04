<?php

namespace App\Http\Controllers;

use App\Models\MQueue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $queue = MQueue::where('queue_date', date('Y-m-d'))->where('current_position', 1)->get();
        return view('dashboard', compact('title', 'queue'));
    }

    public function profile()
    {
    }
}
