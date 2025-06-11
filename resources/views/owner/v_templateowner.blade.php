<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true }" x-cloak>
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Admin Panel')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
  <!-- CDN Asset -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }} " />
  <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-900">

<div class="flex min-h-screen">
  
  @include('admin.navcoba')

  <!-- Main Content -->
  <div class="flex-1 ml-20 md:ml-64 transition-all duration-300 ease-in-out">

    <!-- Topbar -->
    <header class="flex items-center justify-between px-6 py-4 bg-white shadow-sm border-b sticky top-0 z-30">
      <!-- Search -->
      <div class="relative w-full max-w-md">
        <input type="text" placeholder="Cari sesuatu..." class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-700 focus:outline-none transition">
      </div>

      <!-- Right Actions -->
      <div class="flex items-center gap-6">
        <div id="liveClock" class="text-sm font-semibold text-green-900 tracking-widest"></div>
        <button class="relative text-green-800 hover:text-green-900 transition">
          <i class="fas fa-bell text-xl"></i>
          <span class="absolute -top-1 -right-1 h-2 w-2 bg-red-500 rounded-full border border-white"></span>
        </button>
        <div class="relative group">
          <button class="flex items-center space-x-2 focus:outline-none">
            <img src="https://i.pravatar.cc/32" class="w-8 h-8 rounded-full border" alt="Profile">
            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
            <i class="fas fa-chevron-down text-xs text-gray-500"></i>
          </button>
          <div class="absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded-md shadow-lg opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transform transition duration-150 origin-top-right z-50">
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <main class="p-6 bg-gray-50 min-h-[calc(100vh-64px)]">
      @yield('content')
    </main>

  </div>
</div>

<script>
  function updateClock() {
    const now = new Date();
    const time = now.toLocaleTimeString('id-ID', { hour12: false });
    document.getElementById('liveClock').textContent = time;
  }
  setInterval(updateClock, 1000);
  updateClock();
</script>

</body>
</html>
