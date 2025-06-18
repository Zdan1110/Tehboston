<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pencatatan Transaksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* CSS Anda sebelumnya */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            padding: 30px;
            box-sizing: border-box;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .header-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .icon-header {
            font-size: 48px;
            color: #007bff;
            margin-bottom: 15px;
            animation: bounceIn 1s ease-out;
        }

        header h1 {
            color: #333;
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        header p {
            color: #666;
            margin-top: 5px;
            font-size: 16px;
        }

        .form-container {
            padding: 0 20px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            display: flex;
            align-items: center;
        }

        .form-group label .form-icon {
            margin-right: 8px;
            color: #007bff;
            font-size: 18px;
        }

        .form-group .required:after {
            content: " *";
            color: #dc3545;
            font-weight: normal;
        }

        .form-control {
            width: calc(100% - 40px); /* Adjust for padding/icon */
            padding: 12px 15px 12px 40px; /* Add padding for icon */
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 40px; /* Adjust based on label height */
            color: #888;
            font-size: 16px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 90px;
            padding-top: 10px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .radio-option {
            background-color: #f8f9fa;
            border: 1px solid #e2e6ea;
            border-radius: 8px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s, box-shadow 0.2s;
            flex: 1; /* Make them take equal width */
            min-width: 180px; /* Minimum width for responsiveness */
        }

        .radio-option:hover {
            background-color: #e9ecef;
            border-color: #007bff;
        }

        .radio-option input[type="radio"] {
            display: none; /* Hide default radio button */
        }

        .radio-option .checkmark {
            width: 20px;
            height: 20px;
            border: 2px solid #007bff;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .radio-option input[type="radio"]:checked + .checkmark:after {
            content: '';
            width: 10px;
            height: 10px;
            background-color: #007bff;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .radio-option input[type="radio"]:checked + .checkmark {
            background-color: #e6f2ff; /* Light blue background when checked */
            border-color: #007bff;
        }

        .radio-option .radio-label {
            display: flex;
            align-items: center;
            font-weight: 500;
            color: #333;
        }

        .radio-option .radio-icon {
            font-size: 20px;
            margin-right: 8px;
        }

        .income-icon {
            color: #28a745; /* Green for income */
        }

        .expense-icon {
            color: #dc3545; /* Red for expense */
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-right: 10px;
            font-size: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .btn:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .btn-animate {
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.1);
                opacity: 0;
            }
            60% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
            }
        }

        .form-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
        .swal2-container {
            z-index: 9999; /* Pastikan SweetAlert muncul di atas elemen lain */
        }
        /* Responsiveness */
        @media (max-width: 480px) {
            .radio-group {
                flex-direction: column;
                gap: 15px;
            }
            .radio-option {
                flex: none;
                width: 100%;
            }
            .container {
                padding: 20px;
            }
            header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <div class="icon-header">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <h1>Form Pencatatan Transaksi</h1>
                <p>Catat transaksi pemasukan dan pengeluaran dengan mudah</p>
            </div>
        </header>

        <div class="form-container">
            <form id="transactionForm" method="POST" action="{{ route('transaksi.store') }}">
                @csrf <div class="form-group">
                    <label for="jenis" class="required">
                        <div class="form-icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        Jenis Transaksi
                    </label>
                    <div class="radio-group">
                        <div class="radio-option" data-value="pemasukan">
                            <input type="radio" id="pemasukan" name="jenis" value="pemasukan" required>
                            <span class="checkmark"></span>
                            <span class="radio-label">
                                <i class="fas fa-arrow-circle-down radio-icon income-icon"></i>
                                Pemasukan
                            </span>
                        </div>
                        <div class="radio-option" data-value="pengeluaran">
                            <input type="radio" id="pengeluaran" name="jenis" value="pengeluaran">
                            <span class="checkmark"></span>
                            <span class="radio-label">
                                <i class="fas fa-arrow-circle-up radio-icon expense-icon"></i>
                                Pengeluaran
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="transaksi" class="required">
                        <div class="form-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        Deskripsi Transaksi
                    </label>
                    <i class="fas fa-align-left input-icon"></i>
                    <input type="text" class="form-control" id="transaksi" name="transaksi" placeholder="Deskripsi transaksi" required>
                </div>

                <div class="form-group">
                    <label for="jumlah" class="required">
                        <div class="form-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        Jumlah (Rp)
                    </label>
                    <i class="fas fa-coins input-icon"></i>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah transaksi" min="0" required>
                </div>

                <div class="form-group">
                    <label for="supplier" class="required">
                        <div class="form-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        Supplier/Penerima
                    </label>
                    <i class="fas fa-user-tie input-icon"></i>
                    <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Nama supplier atau penerima" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">
                        <div class="form-icon">
                            <i class="fas fa-sticky-note"></i>
                        </div>
                        Keterangan Tambahan
                    </label>
                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Tambahkan catatan atau detail transaksi"></textarea>
                </div>

                <button type="submit" class="btn" id="submitBtn">
                    <i class="fas fa-save"></i> Simpan Transaksi
                </button>

                <div class="form-footer">
                    <p>Form ini aman dan data Anda terlindungi</p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('transactionForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const btn = document.getElementById('submitBtn');

            // Validasi form manual sebelum AJAX
            const amount = document.getElementById('jumlah').value;
            const description = document.getElementById('transaksi').value;
            const supplier = document.getElementById('supplier').value;
            const transactionType = document.querySelector('input[name="jenis"]:checked');

            if (!transactionType) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap pilih jenis transaksi (Pemasukan atau Pengeluaran)!',
                });
                return;
            }

            if (!amount || !description || !supplier) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap lengkapi semua field yang wajib diisi!',
                });
                return;
            }

            // Animasi tombol
            btn.classList.add('btn-animate');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

            // Kirim data menggunakan AJAX
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    // Pastikan Anda memiliki meta tag CSRF di <head> Anda
                    // <meta name="csrf-token" content="{{ csrf_token() }}">
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: new FormData(form)
            })
            .then(response => {
                if (!response.ok) {
                    // Coba baca respons sebagai JSON untuk pesan error dari Laravel
                    return response.json().then(err => {
                        throw new Error(err.message || 'Terjadi kesalahan jaringan atau server.');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Transaksi berhasil disimpan!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Redirect ke halaman transaksi setelah 2 detik
                        window.location.href = '/admin/transaksi'; // Ganti jika route Anda berbeda
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan saat menyimpan transaksi');
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.message,
                });
            })
            .finally(() => {
                btn.classList.remove('btn-animate');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-save"></i> Simpan Transaksi';
            });
        });

        // Tambahkan event listener untuk radio button agar lebih responsif
        const radioOptions = document.querySelectorAll('.radio-option');
        radioOptions.forEach(option => {
            option.addEventListener('click', function() {
                const radioInput = this.querySelector('input[type="radio"]');
                radioInput.checked = true;

                // Hapus kelas 'checked-option' dari semua opsi
                radioOptions.forEach(opt => opt.classList.remove('checked-option'));
                // Tambahkan kelas 'checked-option' ke opsi yang saat ini dipilih
                this.classList.add('checked-option');

                // Beri feedback visual (opsional, sudah ada di CSS)
                // this.style.backgroundColor = '#f8f9fa';
                // setTimeout(() => {
                //     this.style.backgroundColor = '';
                // }, 200);
            });
        });

        // Pastikan salah satu radio button terpilih saat halaman dimuat (opsional)
        document.addEventListener('DOMContentLoaded', () => {
            const defaultChecked = document.querySelector('input[name="jenis"]:checked');
            if (defaultChecked) {
                defaultChecked.closest('.radio-option').classList.add('checked-option');
            }
        });
    </script>
</body>
</html>