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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Permintaan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

              <table class="table table-striped table-hover">
                <thead>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Judul Video</th>
                    <th>Tanggal Permintaan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $request->customer->name }}</td>
                        <td>{{ $request->video->title }}</td>
                        <td>{{ $request->created_at->format('d F Y H:i') }}</td>
                        <td>
                            <form method="post" action="{{ route('admin.requests.destroy', $request->id) }}">
                                @csrf
                                @method('delete')

                                <a href="{{ route('admin.requests.show', $request->id) }}" class="btn btn-success btn-sm mr-2">
                                <i class="fa fa-check"></i> Terima</a>
                                <button onclick="return confirm('Apakah anda yakin untuk menolak permintaan ini ?');" class="btn btn-danger btn-sm" type="submit" style="color: white;"><i class="fa fa-times"></i> Tolak</button>
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
