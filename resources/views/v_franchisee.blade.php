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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
   />
   <script src="https://cdn.tailwindcss.com"></script>

  <title>Teh Boston</title>
</head>
<body>
<div class="max-w-md mx-auto mt-6 bg-white rounded-xl shadow-md overflow-hidden">
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
    @endforeach

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Poto Usaha</label>
            @if(isset($foto->lokasi_usaha))
                <img src="{{ asset('uploads/lokasi/'.$foto->lokasi_usaha) }}" alt="Profile" class="w-full h-full rounded-full object-cover">
            @else
                <p>Tidak ada gambar</p>
            @endif
        </div>
    </div>

    <div class="bg-indigo-900 text-white text-center py-4 mt-4 rounded-b-xl">
        <div class="text-xl font-bold mb-1">Teh Boston</div>
        <a href="/home" class="inline-flex items-center text-red-300 hover:text-white text-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
</div>
</body>
</html>