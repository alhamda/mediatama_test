<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Alhamda Adisoka B">

    <title>Login</title>

    <link href="{{ url('/') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ url('/') }}/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-md-5">

                <div class="card">
                    <div class="card-body">

                    <form action="{{ route('login') }}" method="post">
                        @csrf

                        <div style="text-align: center;" class="mb-3">
                            <h1>Dashboard</h1>
                            <p>Silahkan login untuk memulai</p>
                        </div>


                        @include('layouts._alert')


                        <div class="form-group mt-3">
                            <label>Email</label>

                            <input name="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>

                            <input name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>

                    </form>

                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="{{ url('/') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ url('/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ url('/') }}/js/sb-admin-2.min.js"></script>

</body>




