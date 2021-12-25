@extends('layouts.app-home')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0">Doctor Schedule</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Doctor</a></li>
        <li class="breadcrumb-item active">Schedules</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Jadwal Dokter
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Poly</th>
                            <th>Nama Dokter</th>
                            <th>Jadwal Dokter</th>
                            <th>Quota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctorschedules as $doctorschedule)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $doctorschedule->polyclinic->name }}</td>
                            <td>{{ $doctorschedule->doctor->name }}</td>
                            <td>{{ $doctorschedule->schedule->day_start. " s/d ". $doctorschedule->schedule->day_end . "
                                - ".
                                $doctorschedule->schedule->time_start . " - ".
                                $doctorschedule->schedule->time_end }}</td>
                            <td>@if($doctorschedule->quota == 0)
                                <span class="badge badge-danger">PENUH</span>
                                @else
                                <span class="badge badge-success">{{ $doctorschedule->quota }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
