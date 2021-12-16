@extends('layouts.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Menambah Data Jadwal Dokter</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Doctor Schedule Create</li>
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

        <form method="POST" action="{{ route('doctorschedules.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="schedule_id">Jadwal</label>
                    <select name="schedule_id" class="form-control @error('schedule_id') is-invalid @enderror">
                        <option>Pilih Jadwal</option>
                        @foreach($schedules as $schedule)
                        @if(old('schedule_id') == $schedule->id)
                        <option value="{{ $schedule->id }}" selected>{{ $schedule->day_start . " s/d ".
                            $schedule->day_end . " -
                            ". $schedule->time_start. " - ". $schedule->time_end}}</option>
                        @else
                        <option value="{{ $schedule->id }}">{{ $schedule->day_start . " s/d ".
                            $schedule->day_end . " -
                            ". $schedule->time_start. " - ". $schedule->time_end}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('schedule_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="user_id">Dokter</label>
                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                        <option>Pilih Dokter</option>
                        @foreach($users as $user)
                        @if(old("user_id") == $user->id)
                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @else
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="polyclinic_id">Poliklinik</label>
                    <select name="polyclinic_id" class="form-control @error('polyclinic_id') is-invalid @enderror">
                        <option>Pilih Poli</option>
                        @foreach($polyclinics as $polyclinic)
                        @if(old('polyclinic_id') == $polyclinic->id)
                        <option value="{{ $polyclinic->id }}" selected>{{ $polyclinic->name }}</option>
                        @else
                        <option value="{{ $polyclinic->id }}">{{ $polyclinic->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('polyclinic_id')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quota">Kuota</label>
                    <input type="number" value="{{ old('quota') }}" name="quota"
                        class="form-control @error('quota') is-invalid @enderror" />
                    @error('quota')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" cols="30" rows="5"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control @error('status') @enderror" id="status">
                        <option>Pilih Status</option>
                        <option value=1 @if(old('status')==1) selected @endif>Aktif</option>
                        <option value=0>Tidak Aktif</option>
                    </select>
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
    // if(document.getElementById("check_password").checked) {
    //     console.log(document.getElementById("check_password").checked);
    //     alert("Hello?");
    //     let no_hp = document.getElementById('no_hp');
    //     document.getElementById('password').value = no_hp.value;
    // }
</script>
@endpush
