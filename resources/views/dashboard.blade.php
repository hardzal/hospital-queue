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
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>

                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">
                @if(count($queue))
                <div class="alert alert-info p-5 text-center">
                    <p>
                    <h1>No Antrian : {{ expandingNumberSize($queue->first()->queue_position) }}</h1>
                    <h2>{{ $queue->first()->polyclinic->code.expandingNumberSize($queue->first()->queue_position) }}
                    </h2>
                    <h3>{{ $queue->first()->polyclinic->name }}</h3>
                    </p>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <form method="POST" action="{{ route('queues.update', ['queue' => $queue->first()->id]) }}">
                    <input type="hidden" name="queue_id" value="{{ $queue->first()->id }}" />
                    <input type="hidden" name="type" value="prev" />
                    <input type="hidden" name="current_position" value=0 />
                    <input type="hidden" name="status" value=2 />
                    <button type="submit">
                        <i class="fas fa-arrow-circle-left"></i>
                    </button>
                </form>
            </div>
            <div class="col-lg-4 text-center">
                <form method="POST" action="{{ route('queue.call', ['queue' => $queue->first()->id]) }}">
                    <input type="hidden" name="queue_id">
                    <button type="submit" class="btn btn-primary">Panggil</button>
                </form>
            </div>
            <div class="col-lg-4 text-center">
                <form method="POST" action="{{ route('queues.update', ['queue' => $queue->first()->id]) }}">
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
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Antrian Selajutnya</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode RM</th>
                                    <th>No Antrian</th>
                                    <th>Poli</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($queues as $queue)
                                <tr>
                                    <td>{{ $queue->polyclinic->code . expandingNumberSize($queue->queue_position)}}</td>
                                    <td>{{ $queue->queue_position }}</td>
                                    <td>{{ $queue->polylclinic->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Jadwal Dokter</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
@endpush
