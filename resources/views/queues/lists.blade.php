@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Antrian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Queues Lists</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
            <form method="GET" action="{{ route('queues.list') }}">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <select name="polyclinic_id" class="form-control">
                            <option value="">Pilih Poliklini</option>
                            @foreach($polyclinics as $poly)
                            @if(@$_GET['polyclinic_id'] == $poly->id)
                            <option value="{{ $poly->id }}" selected>{{ $poly->name }}</option>
                            @else
                            <option value="{{ $poly->id }}">{{ $poly->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="queue_date" class="form-control" @if(isset($_GET))
                            value="{{ isset($_GET['queue_date']) ? $_GET['queue_date'] : date('Y-m-d') }}" @endif />
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" type="submit">
                            Show
                        </button>
                    </div>
                </div>
            </form>
            <table id="data_user" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5" style="text-align:center;">No</th>
                        <th>No Antrian</th>
                        <th>Kode RM</th>
                        <th>Nama</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Jadwal Antrian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($queues as $queue)
                    <tr class="">
                        <td style="text-align:center;">{{ $loop->iteration }}</td>
                        <td>{{ expandingNumberSize($queue->queue_position) }}</td>
                        <td>{{ $queue->polyclinic->code. expandingNumberSize($queue->queue_position) }}
                        </td>
                        <td>{{ $queue->patient->name }}</td>
                        <td>{{ $queue->polyclinic->name }}</td>
                        <td>{{ $queue->doctorschedule->doctor->name }}</td>
                        <td>{{ $queue->queue_date. " - ". $queue->doctorschedule->schedule->time_start. " - ".
                            $queue->doctorschedule->schedule->time_end }}</td>
                        <td>
                            @if($queue->status==1)
                            <span class="badge badge-warning">waiting</span>
                            @elseif($queue->status==2)
                            <span class="badge badge-success">success</span>
                            @else
                            <span class="badge badge-danger">skipped</span>
                            @endif
                        </td>
                        <td>
                            @if($queue->current_position)
                            <form method="POST" action="{{ route('queues.update', ['queue' => $queue->id]) }}"
                                style="display:inline">
                                @csrf
                                <input type="hidden" name="poly_id" value="{{ $queue->polyclinic->id }}" />
                                <input type="hidden" name="queue_date" value="{{ $queue->queue_date }}" />
                                <input type="hidden" name="current_position" value=0 />
                                <input type="hidden" name="status" value=2 />
                                <button class="btn btn-md btn-success mr-5" type="submit">Next</button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('queues.destroy', ['queue' => $queue->id]) }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-md btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')">Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    {{-- <tr>
                        <th>Email</th>
                        <th>Nama Lengkap</th>
                        <th>No HP</th>
                        <th>Jenis Kelamin</th>
                    </tr> --}}
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection

@push('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endpush

@push('scripts')
<script>
    $("#data_user").DataTable({
        "dom": 'Brtip',
        "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "buttons": [
            {
                "extend": 'copyHtml5',
                "exportOptions": {
                    "columns": [ 1, ':visible' ]
                }
            },
            {
                "extend": 'excelHtml5',
                "exportOptions": {
                    "columns": [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                "extend": 'pdfHtml5',
                "exportOptions": {
                    "columns": [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                "extend": "csv",
                "exportOptions": {
                    "columns": [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                "extend": "print",
                "exportOptions": {
                    "columns": [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            'colvis'
        ]
    }).buttons().container().appendTo('#data_user_wrapper .col-md-6:eq(0)');
</script>
@endpush
