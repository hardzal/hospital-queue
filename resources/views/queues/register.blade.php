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
            <form method="POST" action="{{ route('queue.store') }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="polyclinic_id">Poliklinik</label>
                        <select name="polyclinic_id" class="form-control" id="polyclinic_id">
                            <option>Pilih Poly</option>
                            @foreach ($polyclinics as $polyclinic)
                            <option value="{{ $polyclinic->id }}">{{ $polyclinic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="doctor_schedule_id">Jadwal Dokter</label>
                        <select name="doctor_schedule_id" class="form-control" id="doctor_schedule_id">
                            <option>Pilih Jadwal Dokter</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

</script>
@endpush
