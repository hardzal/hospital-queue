<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::all();
        $title = "Schedule lists";
        return view('schedules.index', compact('title', 'schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create a new Schedule';
        $days = $this->days;

        return view('schedules.create', compact('days', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleRequest $request)
    {
        $validated = $request->validated();
        $schedule = [
            'day_start' => $validated['day_start'],
            'day_end' => $validated['day_end'],
            'time_start' => $validated['time_start'],
            'time_end' => $validated['time_end']
        ];

        Schedule::create($schedule);
        return redirect()->route('schedules.index')->with('message', 'Berhasil membuat jadwal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = '';
        return view('schedules.show', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $title = 'Edit Schedule';
        $days = $this->days;

        return view('schedules.edit', compact('schedule', 'title', 'days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $validated = $request->validated();
        $schedule->day_start = $validated['day_start'];
        $schedule->day_end = $validated['day_end'];
        $schedule->time_start = $validated['time_start'];
        $schedule->time_end = $validated['time_end'];

        $schedule->save();
        return redirect()->route('schedules.index')->with('message', 'Berhasil membuat jadwal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('message', 'Berhasil menghapus jadwal');
    }
}
