<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Status Franchise Baru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'review': '#ca8a04',
            'survey': '#3b82f6',
            'diterima': '#16a34a',
            'pembayaran': '#8b5cf6',
            'booth': '#ec4899',
            'ditolak': '#dc2626',
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @keyframes pulseScale {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.1); }
    }
    .pulse-icon {
      animation: pulseScale 2s infinite;
      transform-origin: center;
    }
    .track-container {
      display: flex;
      overflow-x: auto;
      scrollbar-width: thin;
      scrollbar-color: #cbd5e0 #f3f4f6;
      padding-bottom: 16px;
    }
    .track-container::-webkit-scrollbar {
      height: 6px;
    }
    .track-container::-webkit-scrollbar-thumb {
      background-color: #cbd5e0;
      border-radius: 3px;
    }
    .status-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      min-width: 90px;
      position: relative;
    }
    .status-line {
      flex: 1;
      border-top: 2px solid #d1d5db;
      margin-top: 28px;
    }
    .status-icon {
      width: 2.5rem;
      height: 2.5rem;
      margin-bottom: 0.5rem;
    }
    .status-label {
      font-size: 0.75rem;
      font-weight: 600;
      text-align: center;
      line-height: 1.2;
      padding: 0 4px;
    }
    
    /* Warna untuk status indicator */
    .status-review { background-color: #fef9c3; color: #854d0e; }
    .status-survey { background-color: #dbeafe; color: #1e40af; }
    .status-diterima { background-color: #dcfce7; color: #166534; }
    .status-pembayaran { background-color: #ede9fe; color: #5b21b6; }
    .status-booth { background-color: #fce7f3; color: #9d174d; }
    .status-ditolak { background-color: #fee2e2; color: #b91c1c; }
    .status-default { background-color: #f3f4f6; color: #4b5563; }
    
    .bank-info {
      background-color: #f8fafc;
      border-radius: 0.5rem;
      padding: 1rem;
      margin-top: 1rem;
      border: 1px solid #e2e8f0;
    }
    .bank-item {
      display: flex;
      align-items: center;
      margin-bottom: 0.75rem;
      padding: 0.75rem;
      border-radius: 0.5rem;
      background: white;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .bank-icon {
      width: 50px;
      height: 50px;
      margin-right: 1rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: white;
    }
    .bank-bca { background: linear-gradient(135deg, #0061a8, #004e85); }
    .bank-bri { background: linear-gradient(135deg, #0039a6, #00287a); }
    .bank-bni { background: linear-gradient(135deg, #0061a8, #004e85); }
    .bank-mandiri { background: linear-gradient(135deg, #00a54f, #00873d); }
    .bank-details {
      flex: 1;
    }
    .bank-name {
      font-weight: 600;
      color: #1e293b;
    }
    .bank-number {
      font-family: monospace;
      font-size: 1.05rem;
      color: #334155;
      letter-spacing: 0.5px;
    }
    .bank-account {
      font-size: 0.875rem;
      color: #64748b;
    }
    
    /* Dropdown styling */
    .bank-selector {
      position: relative;
      margin-bottom: 1rem;
    }
    .bank-dropdown {
      width: 100%;
      padding: 0.75rem;
      border-radius: 0.5rem;
      border: 1px solid #d1d5db;
      background-color: white;
      appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 1em;
      cursor: pointer;
    }
    
    /* File upload styling */
    .file-upload {
      position: relative;
      overflow: hidden;
      display: inline-block;
      width: 100%;
    }
    .file-upload-input {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    .file-upload-button {
      display: block;
      padding: 0.75rem;
      background-color: #8b5cf6;
      color: white;
      border-radius: 0.5rem;
      text-align: center;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    .file-upload-button:hover {
      background-color: #7c3aed;
    }
    .file-name {
      margin-top: 0.5rem;
      font-size: 0.875rem;
      color: #4b5563;
      text-align: center;
    }
  </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-50 p-4 sm:p-6">

  <h1 class="text-2xl sm:text-3xl font-extrabold text-teal-700 mb-6">Status Pendaftaran</h1>

  <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md w-full max-w-md">
    <div class="mb-6">
      <p class="mb-2 text-gray-700"><strong class="text-gray-800">ID:</strong> {{ $franchise->id_franchisebaru }}</p>
      <p class="text-gray-700"><strong class="text-gray-800">Nama Lengkap:</strong> {{ $franchise->nama_lengkap }}</p>
    </div>

    <!-- Tracking container -->
    <div class="track-container">
      <div class="flex items-start min-w-max">
        <!-- Review Dokumen -->
        <div class="status-item">
          <svg xmlns="http://www.w3.org/2000/svg" class="status-icon {{ $franchise->status == 'Review Dokumen' ? 'pulse-icon' : '' }}"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke-linecap="round"
            stroke-linejoin="round"
            style="
              color: {{ $franchise->status == 'Review Dokumen' ? '#ca8a04' : '#9ca3af' }};
              opacity: {{ in_array($franchise->status, ['Review Dokumen', 'Survey Lokasi', 'Diterima', 'Pembayaran', 'Pembuatan Booth']) ? '1' : '0.4' }};
            "
            title="Review Dokumen"
          >
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg>
          <span class="status-label"
            style="
              color: {{ $franchise->status == 'Review Dokumen' ? '#ca8a04' : '#6b7280' }};
              opacity: {{ in_array($franchise->status, ['Review Dokumen', 'Survey Lokasi', 'Diterima', 'Pembayaran', 'Pembuatan Booth']) ? '1' : '0.6' }};
            "
          >Review Dokumen</span>
        </div>

        <div class="status-line"></div>

        <!-- Survey Lokasi -->
        <div class="status-item">
          <svg xmlns="http://www.w3.org/2000/svg" class="status-icon {{ $franchise->status == 'Survey Lokasi' ? 'pulse-icon' : '' }}"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke-linecap="round"
            stroke-linejoin="round"
            style="
              color: {{ $franchise->status == 'Survey Lokasi' ? '#3b82f6' : '#9ca3af' }};
              opacity: {{ in_array($franchise->status, ['Survey Lokasi', 'Diterima', 'Pembayaran', 'Pembuatan Booth']) ? '1' : '0.4' }};
            "
            title="Survey Lokasi"
          >
            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
          <span class="status-label"
            style="
              color: {{ $franchise->status == 'Survey Lokasi' ? '#3b82f6' : '#6b7280' }};
              opacity: {{ in_array($franchise->status, ['Survey Lokasi', 'Diterima', 'Pembayaran', 'Pembuatan Booth']) ? '1' : '0.6' }};
            "
          >Survey Lokasi</span>
        </div>

        <div class="status-line"></div>

        <!-- Diterima -->
        <div class="status-item">
          <svg xmlns="http://www.w3.org/2000/svg" class="status-icon {{ $franchise->status == 'Diterima' ? 'pulse-icon' : '' }}"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke-linecap="round"
            stroke-linejoin="round"
            style="
              color: {{ $franchise->status == 'Diterima' ? '#16a34a' : '#9ca3af' }};
              opacity: {{ in_array($franchise->status, ['Diterima', 'Pembayaran', 'Pembuatan Booth']) ? '1' : '0.4' }};
            "
            title="Diterima"
          >
            <circle cx="12" cy="12" r="10" />
            <path d="M9 12l2 2l4 -4" />
          </svg>
          <span class="status-label"
            style="
              color: {{ $franchise->status == 'Diterima' ? '#16a34a' : '#6b7280' }};
              opacity: {{ in_array($franchise->status, ['Diterima', 'Pembayaran', 'Pembuatan Booth']) ? '1' : '0.6' }};
            "
          >Diterima</span>
        </div>

        <div class="status-line"></div>

        <!-- Pembayaran -->
        <div class="status-item">
          <svg xmlns="http://www.w3.org/2000/svg" class="status-icon {{ $franchise->status == 'Pembayaran' ? 'pulse-icon' : '' }}"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke-linecap="round"
            stroke-linejoin="round"
            style="
              color: {{ $franchise->status == 'Pembayaran' ? '#8b5cf6' : '#9ca3af' }};
              opacity: {{ in_array($franchise->status, ['Pembayaran', 'Pembuatan Booth']) ? '1' : '0.4' }};
            "
            title="Pembayaran"
          >
            <line x1="12" y1="1" x2="12" y2="23"></line>
            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
          </svg>
          <span class="status-label"
            style="
              color: {{ $franchise->status == 'Pembayaran' ? '#8b5cf6' : '#6b7280' }};
              opacity: {{ in_array($franchise->status, ['Pembayaran', 'Pembuatan Booth']) ? '1' : '0.6' }};
            "
          >Pembayaran</span>
        </div>

        <div class="status-line"></div>

        <!-- Pembuatan Booth -->
        <div class="status-item">
          <svg xmlns="http://www.w3.org/2000/svg" class="status-icon {{ $franchise->status == 'Pembuatan Booth' ? 'pulse-icon' : '' }}"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke-linecap="round"
            stroke-linejoin="round"
            style="
              color: {{ $franchise->status == 'Pembuatan Booth' ? '#ec4899' : '#9ca3af' }};
              opacity: {{ $franchise->status == 'Pembuatan Booth' ? '1' : '0.4' }};
            "
            title="Pembuatan Booth"
          >
            <path d="M20 9.556V20a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h7.414l2 2H20v5.556"></path>
            <path d="M10 16v-4h4v4h-4z"></path>
          </svg>
          <span class="status-label"
            style="
              color: {{ $franchise->status == 'Pembuatan Booth' ? '#ec4899' : '#6b7280' }};
              opacity: {{ $franchise->status == 'Pembuatan Booth' ? '1' : '0.6' }};
            "
          >Pembuatan Booth</span>
        </div>
      </div>
    </div>

    <!-- Status Ditolak -->
    <div class="flex flex-col items-center mt-6 pt-4 border-t border-gray-200">
      <div class="status-item">
        <svg xmlns="http://www.w3.org/2000/svg" class="status-icon {{ $franchise->status == 'Ditolak' ? 'pulse-icon' : '' }}"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
          stroke-linecap="round"
          stroke-linejoin="round"
          style="
            color: {{ $franchise->status == 'Ditolak' ? '#dc2626' : '#9ca3af' }};
            opacity: {{ $franchise->status == 'Ditolak' ? '1' : '0.4' }};
          "
          title="Ditolak"
        >
          <circle cx="12" cy="12" r="10" />
          <line x1="15" y1="9" x2="9" y2="15" />
          <line x1="9" y1="9" x2="15" y2="15" />
        </svg>
        <span class="status-label"
          style="
            color: {{ $franchise->status == 'Ditolak' ? '#dc2626' : '#6b7280' }};
            opacity: {{ $franchise->status == 'Ditolak' ? '1' : '0.6' }};
          "
        >Ditolak</span>
      </div>
    </div>

    <!-- Current status indicator -->
    <div class="mt-6 py-3 px-4 rounded-lg text-center font-medium 
        @php
            $statusClass = 'status-default';
            if ($franchise->status == 'Review Dokumen') $statusClass = 'status-review';
            elseif ($franchise->status == 'Survey Lokasi') $statusClass = 'status-survey';
            elseif ($franchise->status == 'Diterima') $statusClass = 'status-diterima';
            elseif ($franchise->status == 'Pembayaran') $statusClass = 'status-pembayaran';
            elseif ($franchise->status == 'Pembuatan Booth') $statusClass = 'status-booth';
            elseif ($franchise->status == 'Ditolak') $statusClass = 'status-ditolak';
            echo $statusClass;
        @endphp">
      Status saat ini: <span class="font-bold">{{ $franchise->status }}</span>
    </div>

    <!-- Tombol Upload Bukti Pembayaran -->
    @if($franchise->status == 'Pembayaran')
    <div class="mt-6">
      <!-- Informasi Transfer Bank -->
      <div class="bank-info">
        <h3 class="font-semibold text-gray-700 mb-4 text-center">Transfer ke Rekening Berikut:</h3>
        
        <div class="bank-item">
          <div class="bank-icon bank-bca">
            <i class="fas fa-university"></i>
          </div>
          <div class="bank-details">
            <p class="bank-name">Bank BCA</p>
            <p class="bank-number">1234 5678 9012</p>
            <p class="bank-account">a.n. Teh Boston</p>
          </div>
        </div>
        
        <div class="bank-item">
          <div class="bank-icon bank-bri">
            <i class="fas fa-university"></i>
          </div>
          <div class="bank-details">
            <p class="bank-name">Bank BRI</p>
            <p class="bank-number">9876 5432 1098</p>
            <p class="bank-account">a.n. Teh Boston</p>
          </div>
        </div>
        
        <div class="bank-item">
          <div class="bank-icon bank-bni">
            <i class="fas fa-university"></i>
          </div>
          <div class="bank-details">
            <p class="bank-name">Bank BNI</p>
            <p class="bank-number">5678 9012 3456</p>
            <p class="bank-account">a.n. Teh Boston</p>
          </div>
        </div>
        
        <div class="bank-item">
          <div class="bank-icon bank-mandiri">
            <i class="fas fa-university"></i>
          </div>
          <div class="bank-details">
            <p class="bank-name">Bank Mandiri</p>
            <p class="bank-number">2345 6789 0123</p>
            <p class="bank-account">a.n. Teh Boston</p>
          </div>
        </div>
        
        <p class="mt-4 text-center">
          <span class="text-gray-600">Jumlah Pembayaran:</span>
          <span class="ml-2 text-lg font-bold text-purple-700">Rp 25.000.000</span>
        </p>
        
      </div>
      
      <!-- Form Upload -->
      <div class="mt-4">
        <form id="uploadForm" action="/uploadbuktifranchise/{{ $franchise->id_franchisebaru }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_franchisebaru" value="{{ $franchise->id_franchisebaru }}">
          
          <!-- Dropdown Pilihan Bank -->
          <div class="bank-selector mb-4">
            <label for="bankSelect" class="block text-sm font-medium text-gray-700 mb-1">Pilih Bank</label>
            <select id="bankSelect" name="via_pembayaran" class="bank-dropdown" required>
              <option value="">-- Pilih Bank --</option>
              <option value="BCA">Bank BCA</option>
              <option value="BRI">Bank BRI</option>
              <option value="BNI">Bank BNI</option>
              <option value="Mandiri">Bank Mandiri</option>
            </select>
          </div>
          
          <!-- File Upload -->
          <div class="file-upload mb-4">
            <button type="button" class="file-upload-button">
              <i class="fas fa-upload mr-2"></i> Pilih File Bukti Transfer
            </button>
            <input type="file" id="buktiTransfer" name="bukti" class="file-upload-input" accept=".jpg,.jpeg,.png,.pdf" required>
            <div id="fileName" class="file-name">Belum ada file dipilih</div>
          </div>
          
          <!-- Tombol Submit -->
          <button type="submit" class="w-full px-4 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-700 text-white rounded-lg 
                     shadow-md hover:shadow-lg transition-all duration-200 font-medium">
            <i class="fas fa-paper-plane mr-2"></i> Kirim Bukti Pembayaran
          </button>
        </form>
      </div>
    </div>
    @endif

    <div class="mt-8 flex justify-center">
      <a href="/home" 
         class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-lg 
                transition-colors duration-200 font-medium shadow-sm hover:shadow-md">
        Kembali ke Beranda
      </a>
    </div>

  </div>

</body>
</html>