<!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('finexo-html/images/favicon.png') }}" type="">

    <!-- External Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- Project CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Finexo template CSS -->
    <link rel="stylesheet" href="{{ asset('finexo-html/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('finexo-html/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('finexo-html/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('finexo-html/css/responsive.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .profile-card {
        transition: all 0.3s ease;
        cursor: pointer;
        }
        .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .detail-view {
        display: none;
        }
        .active-card {
        display: block;
        }
        .back-button {
        cursor: pointer;
        transition: color 0.3s ease;
        }
        .back-button:hover {
        color: white !important;
        }
        .add-franchise-card {
        transition: all 0.3s ease;
        border: 2px dashed #cbd5e0;
        height: 100%;
        }
        .add-franchise-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        border-color: #9f7aea;
        background-color: #f8f9fa;
        }
        .cards-container {
        display: flex;
        flex-direction: row;
        gap: 20px;
        }
        .profile-container {
        flex: 2;
        }
        .add-franchise-container {
        flex: 1;
        }
        @media (max-width: 768px) {
        .cards-container {
            flex-direction: column;
        }
        .profile-container, .add-franchise-container {
            flex: auto;
        }
        }
    </style>

    <title>Teh Boston</title>
    </head>
    <body class="bg-gray-100">
    <div class="max-w-6xl mx-auto my-6 px-4">
    <div class="cards-container">
        <!-- Profile Container (Left Side) -->
        <div class="profile-container">
        <!-- Summary Card (Default View) -->
        <div id="summary-card" class="bg-white rounded-xl shadow-md overflow-hidden profile-card h-full">
            <div class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 p-4 relative">
            <div class="flex justify-center">
                <div class="w-20 h-20 bg-pink-600 text-white flex items-center justify-center text-3xl font-bold rounded-full border-4 border-white">
                @if(isset($profile->pas_photo))
                    <img src="{{ asset('uploads/photo/'.$profile->pas_photo) }}" alt="Profile" class="w-full h-full rounded-full object-cover">
                @else
                    <i class="fas fa-user-circle fa-2x"></i>
                @endif
                </div>
            </div>
            </div>
            <div class="p-4 text-center">
            <h2 class="text-lg font-semibold">{{ Session::get('user')['username'] ?? 'Guest' }}</h2>
            <p class="text-sm text-gray-600">{{ Session::get('user')['email'] ?? '-' }}</p>
            </div>

            @foreach ($franchise as $data)
            <div class="px-4 py-2">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Franchise</label>
                <div class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100">
                {{ $data->id_franchise ?? '-' }}
                </div>
            </div>
            
            <div class="text-center py-3">
                <button onclick="showDetail('{{ $data->id_franchise }}')" class="text-indigo-600 hover:text-indigo-800 font-medium">
                Lihat Detail Lengkap <i class="fas fa-chevron-down ml-1"></i>
                </button>
            </div>
            </div>
            @endforeach

            <div class="bg-indigo-900 text-white text-center py-4 rounded-b-xl">
            <div class="text-xl font-bold mb-1">Teh Boston</div>
            <a href="/home" class="inline-flex items-center text-red-300 hover:text-white text-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            </div>
        </div>
        </div>

        <!-- Add Franchise Container (Right Side) -->
        <div class="add-franchise-container">
        <a href="/tambahfranchise" class="block h-full">
            <div class="add-franchise-card bg-white rounded-xl shadow-sm overflow-hidden p-6 text-center flex flex-col justify-center h-full">
            <div class="flex justify-center mb-3">
                <div class="w-16 h-16 bg-purple-100 text-purple-600 flex items-center justify-center text-2xl rounded-full">
                <i class="fas fa-plus"></i>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Tambah Franchise Baru</h3>
            <p class="text-sm text-gray-600 mt-1">Daftarkan franchise baru Anda</p>
            </div>
        </a>
        </div>
    </div>

    <!-- Detail Card (Hidden by default) -->
    <div id="detail-card" class="bg-white rounded-xl shadow-md overflow-hidden mt-4 detail-view">
        <div class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 p-4 relative">
        <div class="flex justify-center">
            <div class="w-20 h-20 bg-pink-600 text-white flex items-center justify-center text-3xl font-bold rounded-full border-4 border-white">
            @if(isset($profile->pas_photo))
                <img src="{{ asset('uploads/photo/'.$profile->pas_photo) }}" alt="Profile" class="w-full h-full rounded-full object-cover">
            @else
                <i class="fas fa-user-circle fa-2x"></i>
            @endif
            </div>
        </div>
        </div>
        <div class="p-4 text-center">
        <h2 class="text-lg font-semibold">{{ Session::get('user')['username'] ?? 'Guest' }}</h2>
        <p class="text-sm text-gray-600">{{ Session::get('user')['email'] ?? '-' }}</p>
        </div>

        @foreach ($franchise as $data)
        <div class="px-4 py-2 franchise-detail" id="detail-{{ $data->id_franchise }}" style="display: none;">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Franchise</label>
            <div class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100">
            {{ $data->id_franchise ?? '-' }}
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Franchise</label>
            <div class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100">
            {{ $data->nama_franchise ?? '-' }}
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi Usaha</label>
            <div class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100">
            {{ $data->provinsi_usaha ?? '-' }}
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kota Usaha</label>
            <div class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100">
            {{ $data->kota_usaha ?? '-' }}
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan Usaha</label>
            <div class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100">
            {{ $data->kelurahan_usaha ?? '-' }}
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Usaha</label>
            <div class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100">
            {{ $data->alamat_usaha ?? '-' }}
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
            <div class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100">
            {{ $data->kode_pos ?? '-' }}
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Usaha</label>
            @if(isset($foto->lokasi_usaha))
            <img src="{{ asset('uploads/lokasi/'.$foto->lokasi_usaha) }}" alt="Lokasi Usaha" class="w-full h-48 object-cover rounded-md border border-gray-300">
            @else
            <div class="w-full h-48 bg-gray-200 rounded-md flex items-center justify-center text-gray-500">
                <i class="fas fa-image fa-3x"></i>
            </div>
            @endif
        </div>

        <div class="text-center py-3">
            <button onclick="hideDetail()" class="text-indigo-600 hover:text-indigo-800 font-medium">
            <i class="fas fa-chevron-up mr-1"></i> Sembunyikan Detail
            </button>
        </div>
        </div>
        @endforeach

        <div class="bg-indigo-900 text-white text-center py-4 rounded-b-xl">
        <div class="text-xl font-bold mb-1">Teh Boston</div>
        <a href="/home" class="inline-flex items-center text-red-300 hover:text-white text-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        </div>
    </div>
    </div>

    <script>
    function showDetail(franchiseId) {
        // Hide all franchise details first
        document.querySelectorAll('.franchise-detail').forEach(el => {
        el.style.display = 'none';
        });
        
        // Show the selected franchise detail
        const detailElement = document.getElementById(`detail-${franchiseId}`);
        if (detailElement) {
        detailElement.style.display = 'block';
        }
        
        // Show the detail card container
        document.getElementById('detail-card').style.display = 'block';
        
        // Hide the summary card
        document.getElementById('summary-card').style.display = 'none';
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function hideDetail() {
        // Hide the detail card
        document.getElementById('detail-card').style.display = 'none';
        
        // Show the summary card
        document.getElementById('summary-card').style.display = 'block';
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    </script>
    </body>
    </html>