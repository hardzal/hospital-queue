@extends('layouts.app-home')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0">History User</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active">Histories</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Riwayat User
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
                        @foreach($medicalrecord as $medicalrecord)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $medicalrecord->polyclinic->name }}</td>
                            <td>{{ $medicalrecord->doctor->name }}</td>
                            <td>{{ $medicalrecord->schedule->day_start. " s/d ". $medicalrecord->schedule->day_end . "
                                - ".
                                $medicalrecord->schedule->time_start . " - ".
                                $medicalrecord->schedule->time_end }}</td>
                            <td>@if($medicalrecord->quota == 0)
                                <span class="badge badge-danger">PENUH</span>
                                @else
                                <span class="badge badge-success">{{ $medicalrecord->quota }}</span>
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
