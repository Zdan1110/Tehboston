<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Mitra Teh Boston</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #388e3c;
            --light-green: #e8f5e9;
            --dark-green: #1b5e20;
            --accent-color: #4caf50;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .form-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .form-header {
            color: var(--primary-color);
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 10px;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .logo-container img {
            max-height: 80px;
        }
        
        .form-title {
            color: var(--dark-green);
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .form-subtitle {
            color: var(--secondary-color);
            font-weight: 500;
            margin-bottom: 30px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-green);
            margin-bottom: 8px;
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            background-color: var(--dark-green);
            transform: translateY(-2px);
        }
        
        .btn-cancel {
            background-color: #6c757d;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-cancel:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }
        
        .required-field::after {
            content: " *";
            color: red;
        }
        
        .file-upload-label {
            display: block;
            padding: 12px;
            background-color: var(--light-green);
            border: 1px dashed var(--accent-color);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .file-upload-label:hover {
            background-color: #d4edda;
        }
        
        .same-address-check {
            margin: 20px 0;
            padding: 15px;
            background-color: var(--light-green);
            border-radius: 8px;
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }
            
            .btn-submit, .btn-cancel {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="logo-container">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s" alt="Logo Teh Boston" class="img-fluid">
        </div>
        
        <h1 class="text-center form-title">Formulir Pendaftaran Mitra Teh Boston</h1>
        <h3 class="text-center form-subtitle">Isi data dengan lengkap dan benar</h3>
        
        <form action="{{ route('calonmitra.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Data Pribadi -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-container">
                        <h4 class="form-header">DATA PRIBADI</h4>
                        
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label required-field">Nama Lengkap (Sesuai KTP)</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="no_ktp" class="form-label required-field">Nomor KTP</label>
                            <input type="text" class="form-control" id="no_ktp" name="no_ktp" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="no_hp" class="form-label required-field">Nomor HP (WhatsApp)</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="provinsi" class="form-label required-field">Provinsi</label>
                            <select class="form-select" id="provinsi" name="provinsi" required onchange="updateKotaOptions('provinsi', 'kota')">
                                <option selected disabled value="">Pilih Provinsi</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kota" class="form-label required-field">Kota/Kabupaten</label>
                            <select class="form-select" id="kota" name="kota" required>
                                <option selected disabled value="">Pilih Kota</option>
                            <!-- Options will be filled by JavaScript -->
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label required-field">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label required-field">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="alamat_lengkap" class="form-label required-field">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Data Usaha -->
                <div class="col-lg-6">
                    <div class="form-container">
                        <h4 class="form-header">DATA LOKASI USAHA</h4>
                        
                        <div class="same-address-check">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameAddress">
                                <label class="form-check-label" for="sameAddress">
                                    Gunakan alamat yang sama dengan data pribadi
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="provinsi_usaha" class="form-label required-field">Provinsi Usaha</label>
                            <select class="form-select" id="provinsi_usaha" name="provinsi_usaha" required onchange="updateKotaOptions('provinsi_usaha', 'kota_usaha')">
                                <option selected disabled value="">Pilih Provinsi</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kota_usaha" class="form-label required-field">Kota/Kabupaten Usaha</label>
                            <select class="form-select" id="kota_usaha" name="kota_usaha" required>
                                <option selected disabled value="">Pilih Kota</option>
                                <!-- Options will be filled by JavaScript -->
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kecamatan_usaha" class="form-label required-field">Kecamatan Usaha</label>
                            <input type="text" class="form-control" id="kecamatan_usaha" name="kecamatan_usaha" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kelurahan_usaha" class="form-label required-field">Kelurahan Usaha</label>
                            <input type="text" class="form-control" id="kelurahan_usaha" name="kelurahan_usaha" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="alamat_usaha" class="form-label required-field">Alamat Lengkap Usaha</label>
                            <textarea class="form-control" id="alamat_usaha" name="alamat_usaha" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kode_pos" class="form-label required-field">Kode POS</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="titik_koordinat" class="form-label required-field">Titik Koordinat Lokasi Usaha</label>
                            <input type="text" class="form-control" id="titik_koordinat" name="titik_koordinat" placeholder="Contoh: -6.175392, 106.827153" required>
                        </div>
                    </div>
                    
                    <!-- Upload Dokumen -->
                    <div class="form-container mt-4">
                        <h4 class="form-header">UPLOAD DOKUMEN</h4>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ktp" class="form-label required-field">Foto KTP</label>
                                <input type="file" class="form-control" id="ktp" name="ktp" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="pas_photo" class="form-label required-field">Pas Foto</label>
                                <input type="file" class="form-control" id="pas_photo" name="pas_photo" required>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="lokasi_usaha" class="form-label required-field">Foto Lokasi Usaha</label>
                                <input type="file" class="form-control" id="lokasi_usaha" name="lokasi_usaha" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="hidden" name="status" value="calon_mitra">
            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-submit me-2">SUBMIT</button>
                <button type="button" class="btn btn-cancel" onclick="window.history.back();">BATAL</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Fungsi untuk mengisi alamat usaha sama dengan data calon mitra
    document.getElementById('sameAddress').addEventListener('change', function() {
        if (this.checked) {
            // Ambil nilai dari data calon mitra
            const provinsi = document.querySelector('[name="provinsi"]').value;
            const kota = document.querySelector('[name="kota"]').value;
            const kelurahan = document.querySelector('[name="kelurahan"]').value;
            const alamat = document.querySelector('[name="alamat_lengkap"]').value;
            
            // Isi ke data lokasi usaha
            document.querySelector('[name="provinsi_usaha"]').value = provinsi;
            document.querySelector('[name="kota_usaha"]').value = kota;
            document.querySelector('[name="kelurahan_usaha"]').value = kelurahan;
            document.querySelector('[name="alamat_usaha"]').value = alamat;
            
            // Trigger perubahan untuk update dropdown kota
            const event = new Event('change');
            document.querySelector('[name="provinsi_usaha"]').dispatchEvent(event);
        }
    });

    const dataWilayah = {
        "Jawa Barat": ["Bandung", "Bekasi", "Bogor", "Cirebon", "Depok", "Karawang", "Subang", "Sukabumi", "Tasikmalaya"],
        "Jawa Tengah": ["Semarang", "Solo", "Magelang", "Tegal", "Kudus", "Purwokerto", "Salatiga"],
        "Jawa Timur": ["Surabaya", "Malang", "Kediri", "Madiun", "Blitar", "Banyuwangi", "Jember"]
    };

        function updateKotaOptions(provinsiId, kotaId) {
            const provinsi = document.getElementById(provinsiId).value;
            const kotaSelect = document.getElementById(kotaId);
            kotaSelect.innerHTML = '<option selected disabled value="">Pilih Kota</option>';
            
            if (dataWilayah[provinsi]) {
                dataWilayah[provinsi].forEach(kota => {
                    const option = document.createElement("option");
                    option.value = kota;
                    option.textContent = kota;
                    kotaSelect.appendChild(option);
                });
            }
        }

        // Auto-fill alamat usaha jika checkbox dicentang
        document.getElementById('sameAddress').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('provinsi_usaha').value = document.getElementById('provinsi').value;
                document.getElementById('kota_usaha').innerHTML = document.getElementById('kota').innerHTML;
                document.getElementById('kota_usaha').value = document.getElementById('kota').value;
                document.getElementById('kecamatan_usaha').value = document.getElementById('kecamatan').value;
                document.getElementById('kelurahan_usaha').value = document.getElementById('kelurahan').value;
                document.getElementById('alamat_usaha').value = document.getElementById('alamat_lengkap').value;
            }
        });
    </script>
</body>
</html>