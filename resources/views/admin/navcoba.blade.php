<aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-gradient-to-b from-green-950 to-green-800 text-white h-screen fixed transition-all duration-300 ease-in-out overflow-y-auto z-40">

  <div class="flex items-center justify-between px-4 py-5 border-b border-green-700">
    <div class="flex items-center space-x-3">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s" class="h-10" alt="Logo">
      <span class="text-xl font-semibold tracking-wide" x-show="sidebarOpen">Admin Panel</span>
    </div>
    <button @click="sidebarOpen = !sidebarOpen" class="text-white text-lg focus:outline-none">
      <i :class="sidebarOpen ? 'fas fa-angle-left' : 'fas fa-angle-right'"></i>
    </button>
  </div>

  <nav class="mt-4 px-2 text-sm space-y-1">
    <a href="/admin" class="flex items-center px-4 py-3 rounded-md hover:bg-green-700 transition {{ Request::is('admin') ? 'bg-green-700 font-medium' : '' }}">
      <i class="fas fa-gauge mr-3"></i>
      <span x-show="sidebarOpen">Dashboard</span>
    </a>

    <!-- Data Master -->
    <div x-data="{ open: false }">
      <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-md hover:bg-green-700 transition">
        <span class="flex items-center">
          <i class="fas fa-folder-open mr-3"></i>
          <span x-show="sidebarOpen">Data Master</span>
        </span>
        <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''" x-show="sidebarOpen"></i>
      </button>
      <div x-show="open" x-transition class="ml-8 mt-1 space-y-1" x-cloak>
        <a href="/admin/tabelcalon" class="block px-3 py-2 rounded-md hover:bg-green-700 transition {{ Request::is('admin/tabelcalon') ? 'bg-green-700 font-medium' : '' }}">
          <i class="fas fa-user-group mr-2"></i> <span x-show="sidebarOpen">Data Calon</span>
        </a>
        <a href="/admin/tabelakun" class="block px-3 py-2 rounded-md hover:bg-green-700 transition {{ Request::is('admin/tabelakun') ? 'bg-green-700 font-medium' : '' }}">
          <i class="fas fa-id-card mr-2"></i> <span x-show="sidebarOpen">Data Akun</span>
        </a>
        <a href="/admin/tabelproduk" class="block px-3 py-2 rounded-md hover:bg-green-700 transition {{ Request::is('admin/tabelproduk') ? 'bg-green-700 font-medium' : '' }}">
          <i class="fas fa-cubes mr-2"></i> <span x-show="sidebarOpen">Data Produk</span>
        </a>
        <a href="/admin/tabelfranchise" class="block px-3 py-2 rounded-md hover:bg-green-700 transition {{ Request::is('admin/tabelfranchise') ? 'bg-green-700 font-medium' : '' }}">
          <i class="fas fa-store-alt mr-2"></i> <span x-show="sidebarOpen">Data Franchise</span>
        </a>
        <a href="/admin/tabelfranchise" class="block px-3 py-2 rounded-md hover:bg-green-700 transition">
          <i class="fas fa-store-alt mr-2"></i> <span x-show="sidebarOpen">Data Franchise Baru</span>
        </a>
      </div>
    </div>

    <!-- Pelaporan -->
    <div x-data="{ open: false }" class="mt-3">
      <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-md hover:bg-green-700 transition">
        <span class="flex items-center">
          <i class="fas fa-file-alt mr-3"></i>
          <span x-show="sidebarOpen">Pelaporan</span>
        </span>
        <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''" x-show="sidebarOpen"></i>
      </button>
      <div x-show="open" x-transition class="ml-8 mt-1 space-y-1" x-cloak>
        <a href="/admin/laporan/transaksi" class="block px-3 py-2 rounded-md hover:bg-green-700 transition">
          <i class="fas fa-money-bill-wave mr-2"></i> <span x-show="sidebarOpen">Laporan Transaksi</span>
        </a>
        <a href="/admin/laporan/franchise" class="block px-3 py-2 rounded-md hover:bg-green-700 transition">
          <i class="fas fa-store mr-2"></i> <span x-show="sidebarOpen">Laporan Franchise</span>
        </a>
        <a href="/admin/laporan/survey" class="block px-3 py-2 rounded-md hover:bg-green-700 transition">
          <i class="fas fa-chart-line mr-2"></i> <span x-show="sidebarOpen">Hasil Survey</span>
        </a>
      </div>
    </div>
  </nav>
</aside>
