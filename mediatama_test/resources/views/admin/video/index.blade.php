@extends('layouts.master')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Video</h1>
</div>

@include('layouts._alert')

<!-- Content Row -->
<div class="row">

    <div class="col-lg-12">

        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Video</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

              <a href="{{ route('admin.videos.create') }}" class="btn btn-primary mb-4">Tambah Video</a>

              <table class="table table-striped table-hover">
                <thead>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Link</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $video->title }}</td>
                        <td>{{ \Str::limit($video->description) }}</td>
                        <td><a href="{{ \Storage::url($video->file); }}">Lihat Video</a></td>
                        <td style="width:200px;">
                            <form style="display: block;" method="post" action="{{ route('admin.videos.destroy', $video->id) }}">
                                @csrf
                                @method('delete')

                                <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-primary btn-sm mr-2">
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
