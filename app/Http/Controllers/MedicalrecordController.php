<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalrecordRequest;
use App\Models\DoctorSchedule;
use App\Models\MedicalRecord;
use App\Models\Patient;
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
        $patients = Patient::all();
        $title = "Add new patient medical record";
        $doctorschedule = DoctorSchedule::all();

        return view('medical_records.create', compact('patients', 'doctorschedule', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicalrecordRequest $request)
    {
        $validated = $request->validated();
        $medical = [
            'patient_id' => $validated['patient_id'],
            'doctor_schedule_id' => $validated['doctor_schedule_id'],
            'type' => $validated['type'],
            'description' => $validated['description'] ?? ''
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
    public function edit(MedicalRecord $record)
    {
        $title = "Edit Medical Record";
        $patients = Patient::all();
        $doctorschedule = DoctorSchedule::all();

        return view('medical_records.edit', compact('record', 'title', 'patients', 'doctorschedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MedicalrecordRequest $request, MedicalRecord $record)
    {
        $validated = $request->validated();
        $record->patient_id = $validated['patient_id'];
        $record->doctor_schedule_id = $validated['doctor_schedule_id'];
        $record->type = $validated['type'];
        $record->description = $validated['description'];

        $record->save();

        return redirect()->route('records.index')->with('message', 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalRecord $record)
    {
        $record->delete();
        return redirect()->route('records.index')->with('message', 'Berhasil menghapus data!');
    }
}
