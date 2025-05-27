<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form ID Pendaftar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/html5-qrcode"></script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-cyan-200 to-teal-600 p-6">

  <!-- Card Form -->
  <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative z-10">
    <div class="flex justify-center mb-6">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s"
           alt="Logo"
           class="w-20 h-20 object-contain drop-shadow-md" />
    </div>
    <h1 class="text-3xl font-extrabold text-teal-700 mb-8 text-center">Cek Status Pendaftaran</h1>

    <form action="{{ route('cek.status') }}" method="POST" class="flex flex-col space-y-6">
      @csrf
      <!-- Input ID -->
      <div class="relative w-full">
        <input
          type="text"
          id="id_pendaftar"
          name="id_pendaftar"
          placeholder=" "
          class="peer h-12 w-full border-b-2 border-gray-300 bg-transparent text-gray-900 placeholder-transparent outline-none transition-all duration-300 focus:border-teal-600"
          required
        />
        <label
          for="id_pendaftar"
          class="absolute left-0 top-3 text-gray-500 text-sm transition-all duration-300
                 peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
                 peer-focus:top-0 peer-focus:text-sm peer-focus:text-teal-600 cursor-text"
        >
          Masukan ID Pendaftar
        </label>
        <div class="absolute bottom-0 left-0 h-0.5 w-0 bg-teal-600 transition-all duration-300 peer-focus:w-full"></div>
      </div>

      <!-- Tombol Lihat Status -->
      <button
        type="submit"
        class="px-6 py-3 rounded-full bg-teal-600 text-white font-semibold
               transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:bg-teal-700"
      >
        Lihat Status
      </button>

      <!-- Tombol Scan QR -->
      <button
        type="button"
        onclick="startQrScanner()"
        class="px-6 py-2 rounded-full bg-white border border-teal-600 text-teal-700 font-medium
               transition-all duration-300 hover:bg-teal-50 hover:shadow-sm hover:scale-105"
      >
        📷 Scan QR
      </button>

      <!-- Kembali -->
      <a href="/home"
         class="text-center px-6 py-2 rounded-full bg-white border border-teal-600 text-teal-700 font-medium
                transition-all duration-300 hover:bg-teal-50 hover:shadow-sm hover:scale-105">
        ← Kembali ke Beranda
      </a>
    </form>
  </div>

  <!-- Modal QR Scanner -->
  <div id="qr-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl w-80">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-teal-700">Scan QR Code</h2>
      </div>
      <div id="reader" class="w-full"></div>
    </div>
  </div>

  <!-- QR Code Scanner Script -->
<script src="https://unpkg.com/html5-qrcode@2.3.7/html5-qrcode.min.js"></script>

<script>
  let html5QrCode;

  function startQrScanner() {
    const qrModal = document.getElementById('qr-modal');
    qrModal.classList.remove('hidden');

    html5QrCode = new Html5Qrcode("reader");
    Html5Qrcode.getCameras().then(devices => {
      if (devices && devices.length) {
        const cameraId = devices[0].id;
        html5QrCode.start(
          cameraId,
          {
            fps: 10,
            qrbox: 250
          },
          qrCodeMessage => {
            document.getElementById('id_pendaftar').value = qrCodeMessage;
            stopQrScanner();
          },
          errorMessage => {
            // Ignore read errors
          }
        ).catch(err => {
          alert("Camera error: " + err);
        });
      }
    });

    // Event listener klik di luar area scanner untuk menutup kamera
    qrModal.addEventListener('click', (event) => {
      if (event.target === qrModal) {
        stopQrScanner();
      }
    });
  }

  function stopQrScanner() {
    if (html5QrCode) {
      html5QrCode.stop().then(() => {
        html5QrCode.clear();
        document.getElementById('qr-modal').classList.add('hidden');
      }).catch(err => {
        console.error("Stop failed", err);
      });
    }
  }

  // Fungsi startScan() yang lain, kalau kamu pakai, tidak aku ubah di sini
  function startScan() {
    document.getElementById('reader').style.display = 'block';
    const html5QrCode = new Html5Qrcode("reader");
    html5QrCode.start(
      { facingMode: "environment" },
      {
        fps: 10,
        qrbox: { width: 250, height: 250 }
      },
      qrCodeMessage => {
        window.location.href = qrCodeMessage; // Arahkan ke link dari QR
        html5QrCode.stop();
      },
      errorMessage => {
        // Ignore errors
      })
    .catch(err => {
      console.error('Gagal memulai kamera:', err);
    });
  }
</script>


</body>
</html>
