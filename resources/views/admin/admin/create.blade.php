@extends('layouts.master')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Admin</h1>
</div>

@include('layouts._alert')

<!-- Content Row -->
<div class="row">

    <div class="col-lg-12">

        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Admin</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    @include('admin.admin._form', ['update' => false])

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Batal</a>
                    </div>

                </form>

            </div>
        </div>


    </div>

</div>

@endsection
