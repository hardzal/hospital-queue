<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQueueRequest;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:patient');
    }

    public function index()
    {
        $title = "Daftar Antrian Saat ini";
        return view('queues.index', compact('title'));
    }

    public function register()
    {
        $title = "Mendaftar Antrian";
        return view('queues.register', compact('title'));
    }

    public function store(StoreQueueRequest $request)
    {
    }
}
