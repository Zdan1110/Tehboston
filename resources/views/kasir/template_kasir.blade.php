<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'Kasir - Teh Boston')</title>
  
  <!-- Favicon -->
  <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s" type="image/x-icon">
  
  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/kasir.css') }}">
  
  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <style>
    :root {
      --primary-color: #28a745;
      --primary-hover: #218838;
      --secondary-color: #f8f9fa;
      --text-dark: #343a40;
      --text-light: #f8f9fa;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      color: white;
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 0.375rem;
      cursor: pointer;
      font-size: 0.875rem;
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      background-color: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .btn-primary:active {
      transform: translateY(1px);
    }
    
    /* Layout konsisten untuk semua halaman */
    .main-content {
      margin-left: 16rem; /* Sesuai dengan lebar sidebar */
      padding: 1.5rem;
      min-height: calc(100vh - 4rem);
      margin-top: 4rem; /* Sesuai dengan tinggi header */
    }
    
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 1rem;
      }
    }
    
    /* Sidebar tetap konsisten */
    .sidebar {
      width: 16rem;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 40;
      transition: transform 0.3s ease;
    }
    
    /* Header tetap konsisten */
    .main-header {
      height: 4rem;
      position: fixed;
      top: 0;
      right: 0;
      left: 16rem; /* Sesuai lebar sidebar */
      z-index: 30;
    }
    
    @media (max-width: 768px) {
      .main-header {
        left: 0;
      }
    }
  </style>
</head>
<body class="antialiased">
  <!-- Header -->
  <header class="main-header bg-white shadow-md py-2 px-6 flex items-center justify-between">
    <div class="flex items-center space-x-3">
      <h1 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard Kasir')</h1>
    </div>
    <div class="flex items-center space-x-4">
      <span id="liveClock" class="text-sm font-semibold text-green-700"></span>
      <div class="relative">
        <button class="flex items-center space-x-2 focus:outline-none">
          <span class="text-sm font-medium text-gray-700">{{ Session::get('user')['username'] ?? 'Kasir' }}</span>
          <i class="fas fa-user-circle text-xl text-green-600"></i>
        </button>
      </div>
    </div>
  </header>

  <!-- Sidebar -->
  <div class="sidebar bg-green-800 text-white space-y-6 py-7 px-2">
    <div class="flex flex-col items-center mb-10">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s" 
           alt="Logo Teh Boston" 
           class="h-16 w-16 rounded-full object-cover mb-2">
      <h1 class="text-xl font-bold">Teh Boston</h1>
      <p class="text-sm text-green-200 mt-1">Kasir</p>
    </div>
    
    <nav class="space-y-2">
      <a href="/dashkasir" class="nav-item flex items-center space-x-2 px-4 py-3 rounded-lg hover:bg-green-700">
        <i class="fas fa-home"></i>
        <span>Dashboard</span>
      </a>
      
      <a href="/kasir" class="nav-item flex items-center space-x-2 px-4 py-3 rounded-lg hover:bg-green-700">
        <i class="fas fa-cash-register"></i>
        <span>Kasir</span>
      </a>

      <a href="/tambah-stok" class="nav-item flex items-center space-x-2 px-4 py-3 rounded-lg hover:bg-green-700">
        <i class="fas fa-cash-register"></i>
        <span>Bahan Baku</span>
      </a>
      
      <a href="/pelaporan" class="nav-item flex items-center space-x-2 px-4 py-3 rounded-lg hover:bg-green-700">
        <i class="fas fa-file-alt"></i>
        <span>Pelaporan</span>
      </a>
      
      <a href="{{ route('editakun', Session::get('user')['id_akun']) }}" class="nav-item flex items-center space-x-2 px-4 py-3 rounded-lg hover:bg-green-700">
        <i class="fas fa-user-cog"></i>
        <span>Setting Akun</span>
      </a>
      
      <a href="/logout" class="nav-item flex items-center space-x-2 px-4 py-3 rounded-lg hover:bg-green-700">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </a>
    </nav>
  </div>

  <!-- Main Content -->
  <main class="main-content bg-gray-50">
    @yield('content')
  </main>

  <!-- Scripts -->
  <script src="{{ asset('assets/js/kasir.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
  
  <script>
    // Live Clock
    function updateClock() {
      const now = new Date();
      const time = now.toLocaleTimeString('id-ID', { hour12: false });
      const date = now.toLocaleDateString('id-ID', { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
      });
      document.getElementById('liveClock').textContent = `${date} | ${time}`;
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>
</body>
</html>