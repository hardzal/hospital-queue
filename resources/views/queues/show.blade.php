@extends('layouts.app-home')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0">Queue Detail</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Queue</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
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
                <h3>Posisi Antrian</h3>
            </div>
            <div class="card-body">
                @if(is_int($queue))
                @if($queue==404)
                <div class="alert alert-warning">
                    <p>Jadwal belum tersedia!</p>
                </div>
                @else
                <p>Tidak ditemukan!</p>
                @endif
                @else
                <h1>{{ $queue->polyclinic->code }}{{ expandingNumberSize($queue->queue_position) }}</h1>

                {{-- <a href="{{ route('patient.print', ['queue' => $queue->id]) }}" class="btn btn-success btn-md"
                    onclick="openWin({{ route('patient.print', ['queue' => $queue->id]) }})">
                    <i class="fas fa-print mr-2"></i>
                    Cetak
                </a> --}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openWin(link)
    {
        let myWindow = window.open(link, '', 'width=200,height=100');
        myWindow.document.close();
    }
</script>
@endpush
