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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Video</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

              <table class="table table-striped table-hover">
                <thead>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                    <tr>
                        <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                        <td style="vertical-align: middle;">
                            <b>{{ $video->title }}</b><br>
                            {{ $video->description }}
                        </td>
                        <td style="vertical-align: middle;">
                            @if($video->can_access)
                            <span class="badge badge-success">Sudah Memiliki Akses</span>
                            @else
                            <span class="badge badge-secondary">Belum Memiliki Akses</span>
                            @endif
                        </td>
                        <td style="vertical-align: middle;width:150px;">
                            @if($video->can_access)
                            <a href="{{ route('customer.videos.show', $video->id) }}" class="btn btn-success">
                                Lihat Video
                            </a>
                            @else
                            <a href="{{ route('customer.videos.request', $video->id) }}" class="btn btn-primary">
                                Minta Akses
                            </a>
                            @endif
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
