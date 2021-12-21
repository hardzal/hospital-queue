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

                <p class="card-text">
                    Anda belum mendaftar kedalam antrian!
                </p>

                <a href="#" class="btn btn-primary">Daftar Antrian Baru</a>
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
                <table id="data_user" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5" style="text-align:center;">No</th>
                            <th>No Antrian</th>
                            <th>No RM</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Waktu Masuk</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>0001</td>
                            <td>AP123</td>
                            <td>Poli Anak</td>
                            <td>Dr AA Sp.d</td>
                            <td>28/12/2021 - 15:00</td>
                            <td><span class="badge badge-warning">waiting</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>0001</td>
                            <td>AP123</td>
                            <td>Poli Anak</td>
                            <td>Dr AA Sp.d</td>
                            <td>28/12/2021 - 15:00</td>
                            <td><span class="badge badge-success">selesai</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>0001</td>
                            <td>AP123</td>
                            <td>Poli Anak</td>
                            <td>Dr AA Sp.d</td>
                            <td>28/12/2021 - 15:00</td>
                            <td><span class="badge badge-success">selesai</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card card-info card-outline">
            <div class="card-header">
                Daftar Jadwal Dokter
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div clas="card">
            <div class="card-header card-dark card-outline">
                Pesan WhatsApp
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
