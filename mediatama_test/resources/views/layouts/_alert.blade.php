        <div class="row">
            <div class="col-lg-12">

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {!! session('success') !!}
                      </div>
                @endif

                @if(session('fail'))
                    <div class="alert alert-danger" role="alert">
                        {!! session('fail') !!}
                      </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                    <b>Terjadi kesalahan ketika melakukan operasi data :</b><br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
