@extends('layouts.auth.patient')

@section('content')
<div class="register-box">
    <div class="card card-outline card-primary">
        {{-- <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
        </div> --}}
        <div class="card-body">
            <p class="login-box-msg">Register a new membership</p>
            @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("message") }}
            </div>
            @endif
            <form action="{{ route('patient.register') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full name"
                        name="name" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                        name="email" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option>Pilih Gender</option>
                        <option value="P">Perempuan</option>
                        <option value="L">Laki - Laki</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-venus-mars"></i>
                        </div>
                    </div>
                    @if($errors->has('gender'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="no hp"
                        name="no_hp" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if($errors->has('no_hp'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('no_hp') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    {{-- <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div> --}}
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ route('patient.login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
@endsection
