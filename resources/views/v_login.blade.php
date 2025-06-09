<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-image:url("{{ asset('finexo-html/images/outletblur.png') }}") center/cover no-repeat;
        }
        .login-container {
            margin-top: 8%;
        }
        .card-custom {
            border-radius: 12px;
            border: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }
        .card-header {
            border-radius: 12px 12px 0 0;
            background-color: #fff;
            text-align: center;
            padding: 15px;
        }
        .card-header img {
            width: 100px;
        }
        .input-group-text {
            background-color:rgb(13, 60, 21);
            color: white;
            border: none;
        }
        .btn-primary {
            background-color:rgb(7, 87, 22);
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color:rgb(11, 88, 27);
        }
        .card-footer a {
            text-decoration: none;
            color:rgb(11, 130, 29);
        }
        .card-footer a:hover {
            text-decoration: underline;
        }
.popup-top {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1055; /* lebih tinggi dari modal dan navbar */
    width: auto;
    max-width: 90%;
    animation: slideDown 0.6s ease-out;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

@keyframes slideDown {
    0% {
        opacity: 0;
        transform: translate(-50%, -30px);
    }
    100% {
        opacity: 1;
        transform: translate(-50%, 0);
    }
}


.alert-custom {
    animation: fadeInUp 0.6s ease;
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    border-left: 6px solid #28a745; /* bisa ubah ke #dc3545 untuk danger */
}
.alert-custom.alert-danger {
    border-left-color: #dc3545;
}

    </style>
</head>
<body>
@if (session('success'))
<div class="alert alert-success alert-dismissible popup-top fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible popup-top fade show" role="alert">
    <i class="fas fa-times-circle me-2"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card card-custom shadow-lg">

                <!-- Gambar Header -->
                <div class="card-header">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s" alt="Logo"> 
                </div>

                <div class="card-body">

                    <form action="{{ route('login.proses') }}" method="POST">
                        @csrf

                        <!-- Username -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" name="username" placeholder="Masukkan username" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <!-- Tombol Login -->
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <small>Belum punya akun? <a href="/register">Daftar di sini</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
