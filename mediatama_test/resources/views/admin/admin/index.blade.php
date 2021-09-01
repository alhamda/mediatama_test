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
                <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

              <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-4">Tambah Admin</a>

              <table class="table table-striped table-hover">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <form method="post" action="{{ route('admin.users.destroy', $user->id) }}">
                                @csrf
                                @method('delete')

                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm mr-2">
                                <i class="fa fa-edit"></i> Ubah</a>
                                <button onclick="return confirm('Apakah anda yakin untuk menghapus data ini ?');" class="btn btn-danger btn-sm" type="submit" style="color: white;"><i class="fa fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>


            </div>
        </div>


    </div>

</div>

@endsection
