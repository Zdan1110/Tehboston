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
    
    /* Two-column layout */
    .status-container {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
    }
    
    @media (min-width: 768px) {
      .status-container {
        flex-direction: row;
        align-items: flex-start;
      }
      
      .status-card {
        flex: 1;
      }
      
      .payment-card {
        flex: 1;
        margin-top: 0;
      }
    }
    
    /* Payment Card */
    .payment-card {
      background: white;
      border-radius: 0.75rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      border: 1px solid #e2e8f0;
      overflow: hidden;
    }
    
    .payment-card-header {
      background: linear-gradient(135deg, #8b5cf6, #7c3aed);
      color: white;
      padding: 1rem 1.5rem;
      font-weight: 600;
      font-size: 1.125rem;
      display: flex;
      align-items: center;
    }
    
    .payment-card-header i {
      margin-right: 0.75rem;
      font-size: 1.25rem;
    }
    
    .payment-card-body {
      padding: 1.5rem;
    }
    
    .payment-amount {
      background: #f9fafb;
      border-radius: 0.5rem;
      padding: 1rem;
      margin-bottom: 1.5rem;
      text-align: center;
      border: 1px dashed #d1d5db;
    }
    
    .payment-amount-label {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 0.25rem;
    }
    
    .payment-amount-value {
      font-size: 1.5rem;
      font-weight: 700;
      color: #8b5cf6;
    }

    /* Modern Bank Selection */
    .bank-options {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      gap: 12px;
      margin-bottom: 1.5rem;
    }
    
    .bank-option {
      position: relative;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      padding: 12px;
      cursor: pointer;
      transition: all 0.2s ease;
      background: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    
    .bank-option:hover {
      border-color: #c7d2fe;
      transform: translateY(-2px);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .bank-option.selected {
      border-color: #8b5cf6;
      background-color: #f5f3ff;
      box-shadow: 0 0 0 3px #ede9fe;
    }
    
    .bank-logo {
      width: 48px;
      height: 48px;
      margin-bottom: 8px;
      object-fit: contain;
    }
    
    .bank-name {
      font-weight: 600;
      font-size: 0.875rem;
      color: #1e293b;
      margin-bottom: 4px;
    }
    
    .bank-number {
      font-family: monospace;
      font-size: 0.75rem;
      color: #64748b;
      word-break: break-all;
    }
    
    .bank-radio {
      position: absolute;
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .bank-option .checkmark {
      position: absolute;
      top: -8px;
      right: -8px;
      width: 24px;
      height: 24px;
      background-color: #8b5cf6;
      border-radius: 50%;
      display: none;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 12px;
      border: 2px solid white;
    }
    
    .bank-option.selected .checkmark {
      display: flex;
    }
    
    /* Modern File Upload */
    .modern-upload {
      border: 2px dashed #cbd5e1;
      border-radius: 12px;
      padding: 2rem;
      text-align: center;
      margin-bottom: 1.5rem;
      transition: all 0.2s ease;
      background: #f8fafc;
    }
    
    .modern-upload:hover {
      border-color: #8b5cf6;
      background: #f5f3ff;
    }
    
    .modern-upload.active {
      border-color: #8b5cf6;
      background: #f5f3ff;
    }
    
    .upload-icon {
      font-size: 2rem;
      color: #8b5cf6;
      margin-bottom: 1rem;
    }
    
    .upload-text {
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #1e293b;
    }
    
    .upload-hint {
      font-size: 0.875rem;
      color: #64748b;
      margin-bottom: 1rem;
    }
    
    .upload-btn {
      display: inline-block;
      padding: 0.5rem 1rem;
      background: #8b5cf6;
      color: white;
      border-radius: 6px;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.2s;
    }
    
    .upload-btn:hover {
      background: #7c3aed;
    }
    
    .preview-container {
      margin-top: 1rem;
      display: none;
    }
    
    .preview-image {
      max-width: 100%;
      max-height: 200px;
      border-radius: 8px;
      margin-top: 1rem;
      border: 1px solid #e2e8f0;
    }
    
    .file-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: white;
      padding: 0.75rem;
      border-radius: 8px;
      margin-top: 1rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .file-details {
      display: flex;
      align-items: center;
    }
    
    .file-icon {
      margin-right: 0.75rem;
      color: #8b5cf6;
    }
    
    .file-name {
      font-weight: 500;
      color: #1e293b;
      word-break: break-all;
      text-align: left;
    }
    
    .file-remove {
      color: #ef4444;
      cursor: pointer;
      margin-left: 1rem;
    }
  </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-50 p-4 sm:p-6">

  <h1 class="text-2xl sm:text-3xl font-extrabold text-teal-700 mb-6">Status Pendaftaran</h1>

  <div class="status-container">
    <!-- Card Status (left side) -->
    <div class="status-card bg-white p-6 sm:p-8 rounded-xl shadow-md">
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

      <div class="mt-8 flex justify-center">
        <a href="/home" 
           class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-lg 
                  transition-colors duration-200 font-medium shadow-sm hover:shadow-md">
          Kembali ke Beranda
        </a>
      </div>
    </div>

    <!-- Card Pembayaran (right side) -->
    @if($franchise->status == 'Pembayaran')
    <div class="payment-card">
      <div class="payment-card-header">
        <i class="fas fa-money-bill-wave"></i>
        Pembayaran Franchise
      </div>
      
      <div class="payment-card-body">
        <!-- Payment Amount -->
        <div class="payment-amount">
          <div class="payment-amount-label">Total Pembayaran</div>
          <div class="payment-amount-value">Rp 25.000.000</div>
        </div>
        
        <!-- Modern Bank Selection -->
        <form id="uploadForm" action="/uploadbuktifranchise/{{ $franchise->id_franchisebaru }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_franchisebaru" value="{{ $franchise->id_franchisebaru }}">
          
          <div class="mb-6">
            <h3 class="font-semibold text-gray-700 mb-3">Pilih Bank Tujuan</h3>
            <div class="bank-options">
              <!-- BCA -->
              <label class="bank-option">
                <input type="radio" name="via_pembayaran" value="BCA" class="bank-radio" required>
                <div class="checkmark"><i class="fas fa-check"></i></div>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/1200px-Bank_Central_Asia.svg.png" alt="BCA" class="bank-logo">
                <div class="bank-name">BCA</div>
                <div class="bank-number">1234 5678 9012</div>
              </label>
              
              <!-- BRI -->
              <label class="bank-option">
                <input type="radio" name="via_pembayaran" value="BRI" class="bank-radio">
                <div class="checkmark"><i class="fas fa-check"></i></div>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Bank_BRI_logo.svg/1200px-Bank_BRI_logo.svg.png" alt="BRI" class="bank-logo">
                <div class="bank-name">BRI</div>
                <div class="bank-number">9876 5432 1098</div>
              </label>
              
              <!-- BNI -->
              <label class="bank-option">
                <input type="radio" name="via_pembayaran" value="BNI" class="bank-radio">
                <div class="checkmark"><i class="fas fa-check"></i></div>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png" alt="BNI" class="bank-logo">
                <div class="bank-name">BNI</div>
                <div class="bank-number">5678 9012 3456</div>
              </label>
              
              <!-- Mandiri -->
              <label class="bank-option">
                <input type="radio" name="via_pembayaran" value="Mandiri" class="bank-radio">
                <div class="checkmark"><i class="fas fa-check"></i></div>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" class="bank-logo">
                <div class="bank-name">Mandiri</div>
                <div class="bank-number">2345 6789 0123</div>
              </label>
            </div>
          </div>
          
          <!-- Modern File Upload -->
          <div class="modern-upload" id="dropArea">
            <div class="upload-icon">
              <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <div class="upload-text">Seret & Jatuhkan file bukti transfer di sini</div>
            <div class="upload-hint">Atau</div>
            <label for="modernUpload" class="upload-btn">
              <i class="fas fa-folder-open mr-2"></i> Pilih File
            </label>
            <input type="file" id="modernUpload" name="bukti" class="hidden" accept=".jpg,.jpeg,.png,.pdf" required>
            <div class="preview-container" id="previewContainer">
              <div class="file-info">
                <div class="file-details">
                  <i class="fas fa-file-alt file-icon"></i>
                  <div class="file-name" id="displayFileName">file_bukti.jpg</div>
                </div>
                <i class="fas fa-times file-remove" id="removeFile"></i>
              </div>
              <img src="" alt="Preview" class="preview-image" id="imagePreview">
            </div>
          </div>
          
          <!-- Submit Button -->
          <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-purple-600 to-indigo-700 text-white rounded-lg 
                     shadow-md hover:shadow-lg transition-all duration-200 font-medium flex items-center justify-center">
            <i class="fas fa-paper-plane mr-2"></i> Kirim Bukti Pembayaran
          </button>
        </form>
      </div>
    </div>
    @endif
  </div>

  <script>
    // Modern Bank Selection
    const bankOptions = document.querySelectorAll('.bank-option');
    bankOptions.forEach(option => {
      option.addEventListener('click', function() {
        bankOptions.forEach(opt => opt.classList.remove('selected'));
        this.classList.add('selected');
      });
    });
    
    // Modern File Upload
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('modernUpload');
    const previewContainer = document.getElementById('previewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const displayFileName = document.getElementById('displayFileName');
    const removeFile = document.getElementById('removeFile');
    
    // Click to select file
    dropArea.addEventListener('click', () => fileInput.click());
    
    // Handle file selection
    fileInput.addEventListener('change', function(e) {
      handleFiles(e.target.files);
    });
    
    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
      e.preventDefault();
      e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
      dropArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
      dropArea.classList.add('active');
    }
    
    function unhighlight() {
      dropArea.classList.remove('active');
    }
    
    // Handle dropped files
    dropArea.addEventListener('drop', function(e) {
      const dt = e.dataTransfer;
      const files = dt.files;
      handleFiles(files);
    });
    
    // Handle file processing
    function handleFiles(files) {
      if (files.length) {
        const file = files[0];
        displayFileName.textContent = file.name;
        
        // Show image preview if it's an image
        if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
          };
          reader.readAsDataURL(file);
        } else {
          imagePreview.style.display = 'none';
        }
        
        previewContainer.style.display = 'block';
        fileInput.files = files; // Update the file input
      }
    }
    
    // Remove file
    removeFile.addEventListener('click', function(e) {
      e.stopPropagation();
      fileInput.value = '';
      previewContainer.style.display = 'none';
      imagePreview.src = '';
      displayFileName.textContent = '';
    });
  </script>

</body>
</html>