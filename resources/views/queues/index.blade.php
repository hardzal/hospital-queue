@extends('layouts.app-home')

@push('head')
<script src="{{ mix('js/app.js') }}" defer></script>
@endpush

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
<div class="row mb-3">
    <div class="col-md-12 d-table">
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
    <div class="col-md-6 d-table">
        @php
        if($queue->first()) {
        $queue->first()->queue_position = expandingNumberSize($queue->first()->queue_position);
        }
        @endphp
        @if($queue->first())
        <queue-component :data="{{ json_encode($queue->first()) }}"></queue-component>
        @else
        <div class="alert alert-primary p-5 text-center" style="height:400px;">
            <h1>Belum ada antrian</h1>
        </div>
        @endif
    </div>
    <div class="col-md-6">
        <iframe width="100%" height="405" src="https://www.youtube-nocookie.com/embed/9Ff8YzqqEFE"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>
    @auth
    <queue-update-component :queueId="{{ $queue->first()->id }}"
        :link="{{ json_encode(route('queues.update', ['queue' => $queue->first()->id]))  }}">
    </queue-update-component>
    @endauth
</div>
@endsection

@push('scripts')
{{-- <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'pusherKey' => config('broadcasting.connections.pusher.key'),
        'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
    ]) !!};
</script> --}}
{{-- <script src="//code.responsivevoice.org/responsivevoice.js?key=fgAqPdhm"></script> --}}
@endpush
