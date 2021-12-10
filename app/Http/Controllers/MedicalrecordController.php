<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalrecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicals = MedicalRecord::all();
        $title = "Medical Record Lists";

        return view('medical_records.index', compact('title', 'medicals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medical_records.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validated();
        $medical = [
            'patient_id' => $validated->patient_id,
            'doctor_schedule_id' => $validated->doctor_shedule_id,
            'time_start' => $validated->time_start,
            'time_end' => $validated->time_end,
            'quota' => $validated->quota,
            'description' => $validated->description ?? ''
        ];

        MedicalRecord::create($medical);
        return redirect()->route('medical_records.index')->with('message', 'Berhasil menambah data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalRecord $medicalrecord)
    {
        return view('medical_records.show', compact("medicalrecord"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalRecord $medicalrecord)
    {
        return view('medical_records.edit', compact('medicalrecord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validated();
        $medical = [
            'patient_id' => $validated->patient_id,
            'doctor_schedule_id' => $validated->doctor_shedule_id,
            'time_start' => $validated->time_start,
            'time_end' => $validated->time_end,
            'quota' => $validated->quota,
            'description' => $validated->description ?? ''
        ];

        MedicalRecord::create($medical);
        return redirect()->route('medical_records.index')->with('message', 'Berhasil menambah data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalRecord $medicalrecord)
    {
        $medicalrecord->delete();
        return redirect()->route('medical_records.index')->with('message', 'Berhasil menghapus data!');
    }
}
