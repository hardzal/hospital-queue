@extends('layouts.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Memperbaharui Data Pasien</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Patient Edit</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pasien</h3>
        </div>

        <form method="POST" action="{{ route('patients.update', $patient->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email', $patient->email) }}"
                        required />
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Enter name" name="name" value="{{ old('name', $patient->name) }}" required />
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                        placeholder="Enter No HP" name="no_hp" value="{{ old('no_hp', $patient->no_hp) }}" required />
                    @error('no_hp')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="no_hp">Password</label>
                    <input type="password" class="form-control" placeholder="Enter a password" id="password"
                        name="password" />
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="check_password">
                        <label for="check_password" class="custom-control-label">Same as No HP</label>
                    </div>
                </div> --}}
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="gender" id="gender_man" class="custom-control-input" value="L"
                            @if(old('gender', $patient->gender)=='L' ) checked @endif required />
                        <label for="gender_man" class="custom-control-label">Laki - Laki</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="gender" id="gender_woman" class="custom-control-input" value="P"
                            @if(old('gender', $patient->gender)=='P' ) checked @endif required />
                        <label for="gender_woman" class="custom-control-label">Perempuan</label>
                    </div>
                    @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" value="{{ $patient->id }}" name="patient_id" />
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
