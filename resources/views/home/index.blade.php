@extends('layouts.app-home')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0"> Dashboard User</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>Status Antrian Rumah Sakit</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('queue.register') }}" class="btn btn-primary">Daftar Antrian Baru</a>

                @if($queue_user->count())
                <h3>Daftar Antrian Anda Saat ini</h3>

                <table id="data_user_queue" class="table table-bordered table-striped table-responsive-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode RM</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>Waktu Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($queue_user as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->polyclinic->code.expandingNumberSize($item->queue_position) }}</td>
                            <td>{{ $item->polyclinic->name }}</td>
                            <td>
                                @if($item->queue_date >= date('Y-m-d')) @if($item->status == 1)
                                <span class="badge badge-warning">waiting</span>
                                @elseif($item->status == 2)
                                <span class="badge badge-success">success</span>
                                @endif
                                @else
                                <span class="badge badge-danger">skipped</span>
                                @endif
                            </td>
                            <td>{{ $item->queue_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
                {{--
                <h3>{{ substr($queue_user->get()->polyclinic->code,
                    0,2).expandingNumberSize($queue_user->get()->first()->queue_position) }}</h3> --}}
                {{-- <button href="{{ route('patient.print', ['queue' => $queue_user->get()->first()->id]) }}"
                    class="btn btn-success btn-md" type="button"
                    onClick="openWin('{{ route('patient.print', ['queue' => $queue_user->get()->first()->id]) }}');">
                    <i class="fas fa-print mr-2"></i>
                    Cetak
                </button> --}}
                @else
                <p>Anda belum mendaftar kedalam antrian!</p>
                @endif
                </p>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Antrian Terbaru</h3>
            </div>
            <div class="card-body">
                <table id="data_queue" class="table table-bordered table-striped table-responsive-sm">
                    <thead>
                        <tr>
                            <th width="5" style="text-align:center;">No</th>
                            <th>No Antrian</th>
                            <th>No RM</th>
                            <th>Status</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Waktu Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($queues as $queue)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ expandingNumberSize($queue->queue_position) }}</td>
                            <td>{{ $queue->polyclinic->code . expandingNumberSize($queue->queue_position)
                                }}</td>
                            <td>
                                @if($queue->status == 1)
                                <span class="badge badge-warning">waiting</span>
                                @elseif($queue->status == 2)
                                <span class="badge badge-success">success</span>
                                @else
                                <span class="badge badge-danger">skipped</span>
                                @endif
                            </td>
                            <td>{{ $queue->polyclinic->name }}</td>
                            <td>{{ $queue->doctorschedule->doctor->name }}</td>
                            <td>{{ $queue->queue_date }}</td>
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
<div class="row">
    <div class="col-lg-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                Daftar Jadwal Dokter
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
                            <td>{{ $doctorschedule->schedule->day_start. " s/d ". $doctorschedule->schedule->day_end . "
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
    <div class="col-lg-4">
        <div class="card card-info card-outline">
            <div class="card-header">
                Pesan WhatsApp
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection

@push('scripts')
<script>
    function openWin(link)
    {
        let myWindow = window.open(link, '', 'width=200,height=100');
        myWindow.document.close();
    }
</script>
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
    $("#data_queue").DataTable({
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "pageLength": 5,
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
    }).buttons().container().appendTo('#data_queue_wrapper .col-md-6:eq(0)');

    $("#data_user_queue").DataTable({
        "pageLength": 5,
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
                    "columns": [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                "extend": 'pdfHtml5',
                "exportOptions": {
                    "columns": [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                "extend": "csv",
                "exportOptions": {
                    "columns": [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                "extend": "print",
                "exportOptions": {
                    "columns": [ 0, 1, 2, 3, 4 ]
                }
            },
            'colvis'
        ]
    }).buttons().container().appendTo('#data_user_queue_wrapper .col-md-6:eq(0)');
</script>
@endpush
