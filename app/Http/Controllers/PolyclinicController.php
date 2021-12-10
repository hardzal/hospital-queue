<?php

namespace App\Http\Controllers;

use App\Http\Requests\PolyclinicRequest;
use App\Models\Polyclinic;
use Illuminate\Http\Request;

class PolyclinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polyclinics = Polyclinic::all();
        $title = "Polyclinic Lists";
        return view('polyclinics.index', compact('polyclinics', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('polyclinics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PolyclinicRequest $request)
    {
        $validated = $request->validated();
        $polyclinic = [
            'name' => $validated->name,
            'code' => $validated->code,
            'description' => $validated->description ?? '',
        ];

        Polyclinic::create($polyclinic);

        return redirect()->route('polyclinic.index')->with('message', 'Berhasil menambahkan poly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Polyclinic $polyclinic)
    {
        return view('polyclinics.show', compact('polyclinic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Polyclinic $polyclinic)
    {
        return view('polyclinic.edit', compact('polyclinic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Polyclinic $request, Polyclinic $polyclinic)
    {
        $validated = $request->validated();
        $polyclinic->code = $validated->code;
        $polyclinic->name = $validated->name;
        $polyclinic->description = $validated->description ?? '';
        $polyclinic->save();

        return redirect()->route('polyclinics.index')->with('message', 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Polyclinic $polyclinic)
    {
        $polyclinic->delete();
        return redirect()->route('polyclinics.index')->with('message', 'Berhasil menghapus data!');
    }
}
