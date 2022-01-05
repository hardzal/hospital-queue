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
        <form method="GET" action="{{ route('queues') }}">
            <div class="row mb-2">
                <div class="col-md-6">
                    <select name="polyclinic" class="form-control">
                        <option value="">Pilih Poliklini</option>
                        <option value="0">Tampilkan semua antrian</option>
                        @foreach($polyclinics as $poly)
                        @if(@$_GET['polyclinic'] == $poly->id)
                        <option value="{{ $poly->id }}" selected>{{ $poly->name }}</option>
                        @else
                        <option value="{{ $poly->id }}">{{ $poly->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="date" name="date" class="form-control" @if(isset($_GET)) value="{{ @$_GET['date'] }}"
                        @endif />
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit">
                        Show
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
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
    <div class="col-md-12">
        @php
        $queue->first()->queue_position = expandingNumberSize($queue->first()->queue_position);
        @endphp
        <queue-component :data="{{ json_encode($queue->first()) }}"></queue-component>
    </div>
    @auth
    <queue-update-component :queueId="{{ $queue->id }}"
        :link="{{ route('queues.update', ['queue' => $queue->first()->id])  }}"></queue-update-component>
    @endauth
</div>
@endsection

@push('scripts')
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'pusherKey' => config('broadcasting.connections.pusher.key'),
        'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
    ]) !!};
</script>
@endpush
