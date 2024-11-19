<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAbKa - Code Collective Indonesia</title>
    <link rel="icon" type="image/x-icon" href="{{url('dist/img/logo.jpg')}}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

    <style>
        body {
            background: url('{{url('dist/img/bg.png')}}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: rgba(29, 188, 216, 0.8);
            padding: 5px;
            border-radius: 3px;
        }
    </style>
</head>
<body class="hold-transition">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline">
            <div class="card-header text-center d-flex justify-content-center align-items-center">
                <img src="{{url('dist/img/logo.jpg')}}" alt="SIMAS Logo" class="brand-image img-circle elevation-3" style="width: 40px; height: 40px;">
                <a href="/" class="h1 ml-2"><b>SIAbKa</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>
                @if($message=Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-text">{{ucwords($message)}}</div>
                    </div>
                @endif
                <form id="login-form">
                    <div id="responseMessage"></div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                </form>
                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#login-form').on('submit', function(e) {
                e.preventDefault();

                const email = $('input[name="email"]').val();
                const password = $('input[name="password"]').val();
                const csrfToken = $('input[name="_token"]').val();

                $.ajax({
                    url: '/login',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                            window.location.href = '/dashboard';
                        } else {
                            $('#responseMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        if (xhr.status === 401 || xhr.status === 404) {
                            $('#responseMessage').html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
                        } else {
                            $('#responseMessage').html('<div class="alert alert-danger">Terjadi kesalahan, silakan coba lagi.</div>');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
