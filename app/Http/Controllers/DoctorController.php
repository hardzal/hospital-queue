<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $title = "Jadwal Dokter";
        $doctorschedules = DoctorSchedule::all();

        return view('home.schedules', compact('title', 'doctorschedules'));
    }
}
