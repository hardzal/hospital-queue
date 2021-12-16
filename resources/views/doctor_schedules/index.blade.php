@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Jadwal Dokter</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Doctor Schedule Lists</li>
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
            <h3 class="card-title">Daftar Jadwal Dokter</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <a href="{{ route('doctorschedules.create') }}" class="btn btn-md btn-primary mb-3">Tambah Jadwal Dokter</a>
            @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("message") }}
            </div>
            @endif

            @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session("error") }}
            </div>
            @endif
            <table id="data_pasien" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5" style="text-align:center;">No</th>
                        <th>Nama Dokter</th>
                        <th>Jadwal Hari</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctor_schedule as $item)
                    <tr>
                        <td style="text-align:center;">{{ $loop->iteration }}</td>
                        <td>{{ $item->doctor->name }}</td>
                        <td>{{ $item->schedule->day_start. " s/d ". $item->schedule->day_end . " - ".
                            $item->schedule->time_start . " - ".
                            $item->schedule->time_end }}</td>
                        <td>{{ $item->quota }}</td>
                        <td>{!! ($item->status) == 1 ? '<span class="badge badge-success">Aktif</span>' : '<span
                                class="badge badge-danger">Tidak Aktif</span>' !!}</td>
                        <td>
                            <a href="{{ route('doctorschedules.edit', ['doctorschedule' => $item->id]) }}"
                                class="btn btn-md btn-success mr-5">Edit</a>
                            <form method="POST"
                                action="{{ route('doctorschedules.destroy', ['doctorschedule' => $item->id]) }}"
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
    $("#data_pasien").DataTable({
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
    }).buttons().container().appendTo('#data_pasien_wrapper .col-md-6:eq(0)');
</script>
@endpush
