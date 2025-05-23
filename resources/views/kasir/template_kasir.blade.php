<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('Title')</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/kasir.css') }}">
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <style>
    button {
      background-color:rgb(18, 109, 0);
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color:rgb(41, 247, 0);
    }
    </style>
</head>
<body>

<header>
  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s" alt="Logo">
  <h1 style="margin: 0; font-size: 20px;">Teh Boston</h1>
</header>

<div class="container">
  <div class="sidebar">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s" alt="Logo" class="sidebar-logo">
    <h1 style="font-size: 20px; color:white;">Teh Boston</h1>

    <h2>Kasir</h2>
    <div class="nav-item">
      <span style="margin-right: 8px;">🏠</span>
      <a href="/dashkasir" style="color:white;">Dashboard</a>
    </div>
    <div class="nav-item">
      <span style="margin-right: 8px;">🛒</span>
      <a href="/kasir" style="color:white;">Kasir</a>
    </div>
    <div class="nav-item">
      <span style="margin-right: 8px;">📄</span>
      <a href="/pelaporan" style="color:white;">Pelaporan</a>
    </div>
      <div class="nav-item">
      <span style="margin-right: 8px;">📄</span>
      <a href="/editakun" style="color:white;">Setting Akun</a>
    </div>
  </div>

    @yield('content')
</div>
    
    </footer>
<script src="{{ asset('assets/js/kasir.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>


</body>
</html>
