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
                        <select name="polyclinic_id" class="form-control @error('polyclinic_id') is-invalid @enderror"
                            id="polyclinic_id">
                            <option>Pilih Poly</option>
                            @foreach ($polyclinics as $polyclinic)
                            <option value="{{ $polyclinic->id }}">{{ $polyclinic->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="doctor_schedule_id">Jadwal Dokter</label>
                        <select name="doctor_schedule_id"
                            class="form-control @error('doctor_schedule_id') is-invalid @enderror'"
                            id="doctor_schedule_id">
                            <option>Pilih Jadwal Dokter</option>
                        </select>
                        @error('doctor_schedule_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="queue_date">Tanggal Antrian</label>
                        <select name="queue_date" class="form-control @error('queue_date') is-invalid @enderror"
                            id="queue_date">
                            <option value="">Pilih Tanggal</option>
                        </select>
                    </div>
                    <input type="hidden" name="patient_id" value="{{ auth()->user()->id }}" />
                    <input type="hidden" name="status" value=1 />
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
    $(document).ready(function() {
        $('#polyclinic_id').on('change', function() {
            $('#doctor_schedule_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Pilih Jadwal</option>');

            let polyclinic_id = document.getElementById('polyclinic_id').value;
            const url = "{{ url('getSchedules') }}/" + polyclinic_id;

            $.get(url, function(data, status) {
                if(Object.keys(data.data).length == 0) {
                    let o = new Option("Jadwal belum tersedia", "");
                    $('#doctor_schedule_id').append(o);
                }

                for (let item of data.data) {
                    let o = new Option(item.doctor_name + " - "  + item.schedule, item.id);
                    $('#doctor_schedule_id').append(o);
                }
            });
        });

        $('#doctor_schedule_id').on('change', function() {
            $('#queue_date')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Pilih Tanggal</option>');

            const tgl = new Date();
            const time_date = (tgl.getTime()) / 1000;
            let doctor_schedule = document.getElementById('doctor_schedule_id');
            const value = (doctor_schedule.options[doctor_schedule.selectedIndex].text).split(" ");

            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
            let day_period = [value[3], value[5]];
            let day = [];
            day_period[0] = days.indexOf(day_period[0]);
            day_period[1] = days.indexOf(day_period[1]);
            for(let i = day_period[0]; i <= day_period[1]; i++) {
                day.push(i);
            }

            const url = "{{ url('getDate') }}/" + time_date;
            $.get(url, function(data, status) {
                if(Object.keys(data.data).length == 0) {
                    let o = new Option("Jadwal belum tersedia", "");
                    $('#queue_date').append(o);
                }

                for (let item of data.data) {
                    const time = new Date(item);
                    // getDay() dimulai dari Sunday(0) hingga Saturday(6)
                    if(day.includes(time.getDay())) {
                        let o = new Option(item, item);
                        $('#queue_date').append(o);
                    }
                }
            });
        });

    });
</script>
@endpush