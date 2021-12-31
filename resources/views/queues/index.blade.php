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
                @if(count($queues))
                <h3>{{ date('d F Y', strtotime($queues[0]->queue_date))}}</h3>
                @else
                <h3>Tidak ditemukan Antrian</h3>
                @endif

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
                <div class="row">
                    @if(count($queues))
                    @foreach($queues as $queue)
                    <div class="col-lg-4">
                        @if($queue->current_position == 1)
                        <div class="small-box bg-primary p-5 text-center">
                            <div class="inner">
                                <h2>{{ $queue->polyclinic->code }}{{
                                    expandingNumberSize($queue->queue_position)
                                    }}</h2>
                            </div>
                        </div>
                        @else
                        <div class="small-box bg-secondary p-5 text-center">
                            <div class="inner">
                                <h2>{{ $queue->polyclinic->code }}{{
                                    expandingNumberSize($queue->queue_position)
                                    }}</h2>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                    @else
                    <p class="alert alert-danger">Belum ada antrian</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
