<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\Polyclinic;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class PatientLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:patient')->except('index')->except('postLogout');
    }

    public function index()
    {
        $title = "Login Pasien";
        $polyclinics = Polyclinic::all();
        $data['status'] = 1;
        $data['patient_id'] = 6;
        return view('home', compact('title', 'polyclinics', 'data'));
    }

    public function showLoginForm()
    {
        $title = "Login Pasien";
        return view('auth.patient.login', compact('title'));
    }

    public function showRegisterForm()
    {
        $title = "Register Pasien";
        return view('auth.patient.register', compact('title'));
    }

    // public function username()
    // {
    //     return 'username';
    // }

    protected function guard()
    {
        return Auth::guard('patient');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required',
            'gender'        => 'required',
            'email'         => 'required|string|email|unique:patients',
            // 'password'      => 'required|string|min:6|confirmed',
            'no_hp'         => 'required',
        ]);
        $data['password'] = bcrypt($data['no_hp']);

        \App\Models\Patient::create($data);
        return redirect()->route('patient.register')->with('message', 'Successfully register!');
    }

    public function postLogout()
    {
        auth()->guard('patient')->logout();
        session()->flush();
        return redirect()->route('patient.login');
    }
}
