<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorscheduleRequest;
use App\Models\DoctorSchedule;
use App\Models\Polyclinic;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class DoctorscheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Doctor Schedule Lists";
        $doctor_schedule = DoctorSchedule::all();
        return view('doctor_schedules.index', compact('title', 'doctor_schedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Doctor Schedule";
        $schedules = Schedule::all();
        $polyclinics = Polyclinic::all();
        $users = User::where('role_id', '3')->get();

        return view('doctor_schedules.create', compact('title', 'schedules', 'polyclinics', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorscheduleRequest $request)
    {
        $validated = $request->validated();

        $doctor_schedule = [
            'user_id' => $validated['user_id'],
            'schedule_id' => $validated['schedule_id'],
            'polyclinic_id' => $validated['polyclinic_id'],
            'quota' => $validated['quota'],
            'description' => $validated['description'] ?? '',
            'status' => $validated['status']
        ];

        $doktor = new DoctorSchedule;

        if (sizeof($doktor->doctorTime($doctor_schedule))) {
            return redirect()->route('doctorschedules.index')->with('error', 'Jadwal dokter telah tersedia!');
        }
        DoctorSchedule::create($doctor_schedule);
        return redirect()->route('doctorschedules.index')->with('message', 'Berhasil menambah data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorSchedule $doctorschedule)
    {
        $title = "Edit Doctor Schedule";
        $schedules = Schedule::all();
        $polyclinics = Polyclinic::all();
        $users = User::where('role_id', '3')->get();

        return view('doctor_schedules.edit', compact('title', 'schedules', 'polyclinics', 'users', 'doctorschedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorscheduleRequest $request, DoctorSchedule $doctorschedule)
    {
        $validated = $request->validated();
        $data = ['user_id' => $doctorschedule['user_id'], 'schedule_id' => $doctorschedule['schedule_id']];
        $doktor = new DoctorSchedule;

        if ($data['user_id'] != $doctorschedule->user_id && $data['schedule_id'] != $doctorschedule->schedule_id) {
            if (sizeof($doktor->doctorTime($data))) {
                return redirect()->route('doctorschedules.index')->with('error', 'Jadwal dokter telah tersedia!');
            }
        }
        $doctorschedule->user_id = $validated['user_id'];
        $doctorschedule->schedule_id = $validated['schedule_id'];
        $doctorschedule->polyclinic_id = $validated['polyclinic_id'];
        $doctorschedule->quota = $validated['quota'];
        $doctorschedule->description = $validated['description'] ?? '';
        $doctorschedule->status = $validated['status'];
        $doctorschedule->save();

        return redirect()->route('doctorschedules.index')->with('message', 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorSchedule $doctorschedule)
    {
        $doctorschedule->delete();
        return redirect()->route('doctorschedules.index')->with('message', 'Berhasil menghapus data!');
    }
}
