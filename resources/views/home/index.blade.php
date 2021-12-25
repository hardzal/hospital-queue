@extends('layouts.app-home')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0"> Dashboard User</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>Status Antrian Rumah Sakit</h5>
            </div>
            <div class="card-body">

                <p class="card-text">
                    Anda belum mendaftar kedalam antrian!
                </p>

                <a href="{{ route('queue.register') }}" class="btn btn-primary">Daftar Antrian Baru</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Antrian Terbaru</h3>
            </div>
            <div class="card-body">
                <table id="data_user" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5" style="text-align:center;">No</th>
                            <th>No Antrian</th>
                            <th>No RM</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Waktu Masuk</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($queues as $queue)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $queue->queue_position }}</td>
                            <td>{{ substr($queue->polyclinic->code, 0, 2) . $queue->queue_position }}</td>
                            <td>{{ $queue->polyclinic->name }}</td>
                            <td>{{ $queue->doctorschedule->doctor->name }}</td>
                            <td>{{ $queue->queue_date }}</td>
                            <td>
                                @if($queue->status == 1)
                                <span class="badge badge-warning">waiting</span>
                                @elseif($queue->status == 2)
                                <span class="badge badge-success">success</span>
                                @else
                                <span class="badge badge-danger">skipped</span>
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
<div class="row">
    <div class="col-lg-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                Daftar Jadwal Dokter
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
    <div class="col-lg-4">
        <div class="card card-info card-outline">
            <div class="card-header">
                Pesan WhatsApp
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
