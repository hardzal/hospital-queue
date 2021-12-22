@extends('layouts.app-home')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0">Queue Register</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Queue</a></li>
        <li class="breadcrumb-item active">Register</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3>Pendaftaran Antrian</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('queue.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for=""></label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
