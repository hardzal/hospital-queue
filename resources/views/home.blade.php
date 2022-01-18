@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h3>Pendaftaran Antrian Rumah Sakit</h3>
                    <form method="POST" action="{{ route('queue.new') }}">
                        @csrf
                        <div class="form-group">
                            <label for="polyclinic_id">Poliklinik</label>
                            <select name="polyclinic_id"
                                class="form-control @error('polyclinic_id') is-invalid @enderror" id="polyclinic_id">
                                <option>Pilih Poli</option>
                                @foreach ($polyclinics as $polyclinic)
                                <option value="{{ $polyclinic->id }}">{{ $polyclinic->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                        </div>
                        <input type="hidden" name="status" value="{{ $data['status'] }}" />
                        <input type="hidden" name="patient_id" value="{{ $data['patient_id'] }}" />
                        <input type="hidden" name="queue_date" id="todayDate" />
                        <button type="submit" class="btn btn-primary btn-lg btn-block w-100 mt-3">Submit</button>
                    </form>
                </div>
                <div class="card-footer">
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <h3>Pencarian Antrian</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('queue.search') }}">
                        @csrf
                        <input type="text" id="search" class="form-control" name="code_rm" />
                        <input type="hidden" value="{{ date('Y-m-d') }}" name="queue_date" />
                        <button type="submit" class="btn btn-primary btn-lg btn-block w-100 mt-3">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ mix('js/app.js') }}" defer></script>

<script type="text/javascript">
    function getDate()
    {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}
        today = yyyy+"-"+mm+"-"+dd;

        document.getElementById("todayDate").value = today;
    }

    getDate();
</script>
@endpush
