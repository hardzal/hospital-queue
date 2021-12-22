<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $title = "Jadwal Dokter";
        return view('home.schedules', compact('title'));
    }
}
