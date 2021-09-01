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
                <h6 class="m-0 font-weight-bold text-primary">Lihat Video</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <b>{{ $video->title }}</b><br>
                {{ $video->description }}<br><br>

                <div class="mt-5 mb-5">
                <video width="600" controls>
                    <source src="{{ $video->video_url }}" type="video/mp4">
                    Browser anda tidak mendukung HTML video.
                  </video>
                </div>

                <a href="{{ route('customer.videos.index') }}" class="btn btn-secondary">Kembali</a>

            </div>
        </div>


    </div>

</div>

@endsection
