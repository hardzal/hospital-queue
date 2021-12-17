@extends('layouts.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Menambah Data Rekam Medik Pasien</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Patient Medical Record Create</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>

        <form method="POST" action="{{ route('records.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="patiend_id">Pasien</label>
                    <select name="patient_id" id="patient_id"
                        class="form-control @error('patient_id') is-invalid @enderror">
                        <option>Pilih Pasien</option>
                        @foreach($patients as $patient)
                        @if(old('patient_id') == $patient->id)
                        <option value="{{ $patient->id }}" selected>{{ $patient->name }}</option>
                        @else
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="doctor_schedule_id">Jadwal</label>
                    <select name="doctor_schedule_id"
                        class="form-control @error('doctor_schedule_id') is-invalid @enderror">
                        <option>Pilih Jadwal</option>
                        @foreach($doctorschedule as $item)
                        @php $detail = $item->doctor->name. " - ".
                        $item->schedule->day_start . " s/d ".
                        $item->schedule->day_end . " -
                        ". $item->schedule->time_start. " - ". $item->schedule->time_end;
                        @endphp
                        @if(old('doctor_schedule_id') == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $detail }}</option>
                        @else
                        <option value="{{ $item->id }}">{{ $detail }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('doctor_schedule_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type">Tipe</label>
                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                        <option>Pilih Tipe</option>
                        <option value="BPJS">BPJS</option>
                        <option value="UMUM">Umum</option>
                    </select>
                    @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" cols="30" rows="5"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
</script>
@endpush
