@extends('layouts.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Memperbaharui Data Jadwal</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Schedule Edit</li>
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

        <form method="POST" action="{{ route('schedules.update', $schedule->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="day_start">Hari Mulai</label>
                            <select name="day_start" class="form-control @error('day_start') is-invalid @enderror">
                                <option>Pilih Hari Mulai</option>
                                @foreach($days as $day)
                                @if(old('day_start', $schedule->day_start) == $day)
                                <option value="{{ $day }}" selected>{{ $day }}</option>
                                @else
                                <option value="{{ $day }}">{{ $day }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="day_end">Hari Selesai</label>
                            <select name="day_end" class="form-control @error('day_end') is-invalid @enderror">
                                <option>Pilih Hari Selesai</option>
                                @foreach($days as $day)
                                @if(old('day_end', $schedule->day_end) == $day)
                                <option value="{{ $day }}" selected>{{ $day }}</option>
                                @else
                                <option value="{{ $day }}">{{ $day }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('day_end')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="time_start">Waktu Mulai</label>
                            <input type="time" name="time_start" id="time_start"
                                value="{{ old('time_start', $schedule->time_start)}}"
                                class="form-control @error('time_start') is-invalid @enderror" />
                            @error('time_start')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="time_end">Waktu Selesai</label>
                            <input type="time" name="time_end" id="time_end"
                                value="{{ old('time_end', $schedule->time_end) }}"
                                class="form-control @error('time_end') is-invalid @enderror" />
                            @error('time_end')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
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
