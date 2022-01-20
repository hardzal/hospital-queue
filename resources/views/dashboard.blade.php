@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            {{-- <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>

                        <p>Jumlah Antrian</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people-outline"></i>
                    </div>
                </div>
            </div> --}}
            <!-- ./col -->
            {{-- <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div> --}}
            <!-- ./col -->
            {{-- <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div> --}}
            <!-- ./col -->
            {{-- <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div> --}}
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            @if(count($queue))
            <div class="col-lg-12 d-table mb-3">
                @php
                $queue->first()->queue_position = expandingNumberSize($queue->first()->queue_position);
                @endphp
                <queue-component :data="{{ json_encode($queue->first()) }}"></queue-component>
            </div>

            <div class="col-lg-4 text-center">
                <form method="POST" action="{{ route('queues.update', ['queue' => $queue->first()->id]) }}">
                    @csrf
                    <input type="hidden" name="queue_id" value="{{ $queue->first()->id }}" />
                    <input type="hidden" name="type" value="prev" />
                    <input type="hidden" name="current_position" value=0 />
                    <input type="hidden" name="status" value=2 />
                    <button type="submit">
                        <i class="fas fa-arrow-circle-left"></i>
                    </button>
                </form>
            </div>

            <div class="col-lg-4 text-center" id="center-button">
                <button class="btn btn-primary" style="display:inlien;" id="call" type="button">CALL</button>
                <form method="POST" action="{{ route('queues.update', ['queue' => $queue->first()->id ]) }}"
                    style=" display:inline!important;">
                    @csrf
                    <input type="hidden" name="queue_id" value="{{ $queue->first()->id }}" />
                    <input type="hidden" name="current_position" value=0 />
                    <input type="hidden" name="status" value=0 />
                    <input type="hidden" name="type" value="skip" />
                    <button type="submit" class="btn btn-secondary" style="display:inlien;">
                        SKIP
                    </button>
                </form>
            </div>

            <div class="col-lg-4 text-center">
                <form method="POST" action="{{ route('queues.update', ['queue' => $queue->first()->id]) }}">
                    @csrf
                    <input type="hidden" name="queue_id" value="{{ $queue->first()->id }}" />
                    <input type="hidden" name="current_position" value=0 />
                    <input type="hidden" name="status" value=2 />
                    <input type="hidden" name="type" value="next" />
                    <button type="submit">
                        <i class="fas fa-arrow-circle-right"></i>
                    </button>
                </form>
            </div>

            @else
            <div class="alert alert-danger p-5 text-center">
                <h2>Antrian belum tersedia!</h2>
            </div>
            @endif
        </div>
        <!-- /.row (main row) -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Antrian Selajutnya</h3>
                    </div>
                    <div class="card-body">
                        @if(count($queues))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode RM</th>
                                    <th>No Antrian</th>
                                    <th>Poli</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($queues as $item)
                                <tr>
                                    <td>{{ $item->polyclinic->code . expandingNumberSize($item->queue_position)}}</td>
                                    <td>{{ $item->queue_position }}</td>
                                    <td>{{ $item->polyclinic->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="alert alert-primary p-3">Tidak ada antrian lanjutan saat ini!</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        Daftar Jadwal Dokter Hari ini
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="data_schedule">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Poly</th>
                                    <th>Nama Dokter</th>
                                    <th>Jadwal Dokter</th>
                                    <th>Quota</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctorschedules as $doctorschedule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $doctorschedule->polyclinic->name }}</td>
                                    <td>{{ $doctorschedule->doctor->name }}</td>
                                    <td>{{ $doctorschedule->schedule->day_start. " s/d ".
                                        $doctorschedule->schedule->day_end . "
                                        - ".
                                        $doctorschedule->schedule->time_start . " - ".
                                        $doctorschedule->schedule->time_end }}</td>
                                    <td>@if($doctorschedule->checkQuota($doctorschedule->id) == 0)
                                        <span class="badge badge-danger">PENUH</span>
                                        @else
                                        <span class="badge badge-success">{{
                                            $doctorschedule->checkQuota($doctorschedule->id) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('scripts')
<audio id="tingtung" src="{{ asset('assets/audio/tingtung.mp3') }}"></audio>

<script src="{{ mix('js/app.js') }}" defer></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}
<script src="//code.responsivevoice.org/responsivevoice.js?key=fgAqPdhm"></script>
@php
$posisi = implode(" ", str_split($queue->first()->queue_position));
@endphp

<script type="text/javascript">
    $(document).ready(function() {
        $('#center-button').on('click', 'button#call', function () {
        var bell  = document.getElementById('tingtung');
        // MAINKAN SUARA BEL PADA SAAT AWAL
        bell.pause();
        bell.currentTime=0;
        bell.play();

        // SET DELAY UNTUK MEMAINKAN REKAMAN NOMOR URUT
        totalwaktu = bell.duration * 700;

        // MAINKAN SUARA NOMOR URUT
        setTimeout(function() {
            return responsiveVoice.speak(" Nomor Antrian, " + "{{ $posisi }} Ke loket antrian"  ,"Indonesian Female", {rate: 0.8, pitch: 1, volume: 1});
        }, totalwaktu);
    } );

    });
</script>
@endpush
