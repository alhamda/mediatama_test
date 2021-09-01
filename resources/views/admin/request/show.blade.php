@extends('layouts.master')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Permintaan Akses Video</h1>
</div>

@include('layouts._alert')

<!-- Content Row -->
<div class="row">

    <div class="col-lg-12">

        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Terima Permintaan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <p><b>{{ $req->customer->name }}</b> meminta hak akses untuk video <b>{{ $req->video->title }}</b></p>
                <form method="POST" action="{{ route('admin.requests.accept', $req->id) }}">
                    @csrf

                    <div class="form-group">
                        <label>Batas Skala Waktu (Jam)</label>

                        <input name="time" type="number" min="1" value="1" class="form-control @error('time') is-invalid @enderror" required>

                        @error('time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Terima</button>
                        <a class="btn btn-secondary" href="{{ route('admin.requests.index') }}">Batal</a>
                    </div>

                </form>


            </div>
        </div>


    </div>

</div>

@endsection
