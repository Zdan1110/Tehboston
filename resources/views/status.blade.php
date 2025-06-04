<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Status Pendaftar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes pulseScale {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.1);
      }
    }

    .pulse-icon {
      animation: pulseScale 2s infinite;
      transform-origin: center;
    }
  </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-50 p-6">

  <h1 class="text-3xl font-extrabold text-teal-700 mb-8">Status Pendaftaran</h1>

  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
    <div class="mb-6">
      <p class="text-gray-700"><strong>ID:</strong> {{ $calon->id_calon }}</p>
      <p class="text-gray-700"><strong>Nama Lengkap:</strong> {{ $calon->nama_lengkap }}</p>
    </div>

    <!-- Tracking Progress -->
    <div class="flex items-center justify-between space-x-4">

      <!-- Status Diterima -->
      <div class="flex flex-col items-center flex-1">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-10 h-10 mb-2 {{ $calon->status == 'Diterima' ? 'pulse-icon' : '' }}"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
             style="color: {{ $calon->status == 'Diterima' ? '#16a34a' : '#9ca3af' }};
                    opacity: {{ $calon->status == 'Diterima' ? '1' : '0.4' }};"
             title="Diterima">
          <circle cx="12" cy="12" r="10" />
          <path d="M9 12l2 2l4 -4" />
        </svg>
        <span class="text-sm font-semibold"
              style="color: {{ $calon->status == 'Diterima' ? '#16a34a' : '#6b7280' }};
                     opacity: {{ $calon->status == 'Diterima' ? '1' : '0.6' }};">
          Diterima
        </span>
      </div>

      <!-- Garis penghubung -->
      <div class="flex-1 border-t border-gray-300 mt-6"></div>

      <!-- Status Proses -->
      <div class="flex flex-col items-center flex-1">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-10 h-10 mb-2 {{ $calon->status == 'Proses' ? 'pulse-icon' : '' }}"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
             style="color: {{ $calon->status == 'Proses' ? '#ca8a04' : '#9ca3af' }};
                    opacity: {{ $calon->status == 'Proses' ? '1' : '0.4' }};"
             title="Proses">
          <circle cx="12" cy="12" r="10" />
          <polyline points="12 6 12 12 16 14" />
        </svg>
        <span class="text-sm font-semibold"
              style="color: {{ $calon->status == 'Proses' ? '#ca8a04' : '#6b7280' }};
                     opacity: {{ $calon->status == 'Proses' ? '1' : '0.6' }};">
          Proses
        </span>
      </div>

      <!-- Garis penghubung -->
      <div class="flex-1 border-t border-gray-300 mt-6"></div>

      <!-- Status Ditolak -->
      <div class="flex flex-col items-center flex-1">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-10 h-10 mb-2 {{ $calon->status == 'Ditolak' ? 'pulse-icon' : '' }}"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
             style="color: {{ $calon->status == 'Ditolak' ? '#dc2626' : '#9ca3af' }};
                    opacity: {{ $calon->status == 'Ditolak' ? '1' : '0.4' }};"
             title="Ditolak">
          <circle cx="12" cy="12" r="10" />
          <line x1="15" y1="9" x2="9" y2="15" />
          <line x1="9" y1="9" x2="15" y2="15" />
        </svg>
        <span class="text-sm font-semibold"
              style="color: {{ $calon->status == 'Ditolak' ? '#dc2626' : '#6b7280' }};
                     opacity: {{ $calon->status == 'Ditolak' ? '1' : '0.6' }};">
          Ditolak
        </span>
      </div>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-8 flex justify-center">
      <a href="/home"
         class="px-6 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition-colors duration-200">
        ← Kembali ke Beranda
      </a>
    </div>
  </div>

</body>
</html>
