@extends('layouts.app-home')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0">Queue List</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Queue</a></li>
        <li class="breadcrumb-item active">Lists</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session("success") }}
                </div>
                @endif

                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session("error") }}
                </div>
                @endif
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Waktu Ngantri</th>
                        <th>Waktu Masuk</th>
                    </thead>
                    <tbody>
                        @foreach($queues as $queue)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ substr($queue->polyclinic->code, 0, 2) . expandingNumberSize($queue->queue_position)
                                }}</td>
                            <td>{{ $queue->polyclinic->name }}</td>
                            <td>{{ $queue->doctorschedule->doctor->name }}</td>
                            <td>{{ $queue->queue_date }}</td>
                            <td>-</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection