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
            width: 100px; /* Sesuaikan ukuran logo */
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
    </style>
</head>
<body>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
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
