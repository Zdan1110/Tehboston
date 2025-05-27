<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Mitra Teh Boston</title>
    <link rel="stylesheet" href="{{ asset('finexo-html/css/form.css') }}">
</head>
<body style="background-color:rgb(248, 250, 249);">
    <div class="container mt-4 text-center">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s" alt="Logo Teh Boston" class="mb-3" style="max-width: 150px; display: block; margin: 0 auto;">
        <h2 class="text-center">Formulir Pendaftaran Mitra Teh Boston</h2>
        <h3 class="text-center">Data Calon Mitra</h3>

        <form action="{{ route('calonmitra.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap (Sesuai KTP) *" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="no_ktp" placeholder="No KTP *" required>
                    </div>
                    <div class="mb-3">
                        <select class="form-control" name="provinsi" id="provinsi" required onchange="updateKotaOptions('provinsi', 'kota')">
                            <option selected disabled>Pilih Provinsi *</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-control" name="kota" id="kota" required>
                            <option selected disabled>Pilih Kota *</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="kelurahan" placeholder="Kelurahan *" required>
                    </div>
                    <div class="mb-3">
                        <label for="ktp" class="form-label">Upload KTP *</label>
                        <input type="file" class="form-control" id="ktp" name="ktp" required>
                    </div>
                </div>
                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="no_hp" placeholder="No HP (Whatsapp) *" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="alamat_lengkap" placeholder="Alamat Lengkap *" required>
                    </div>
                    <div class="mb-3">
                        <label for="pas_photo" class="form-label">Pas Photo *</label>
                        <input type="file" class="form-control" id="pas_photo" name="pas_photo" required>
                    </div>
                </div>
            </div>

            <div class="my-5"></div>

            <!-- Data Lokasi Usaha -->
            <h3 class="text-center mt-4">Data Lokasi Usaha</h3>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="sameAddress">
                <label class="form-check-label" for="sameAddress">
                    Alamat / Provinsi, Kota, Kecamatan, Kelurahan sama dengan Data Calon Mitra
                </label>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <select class="form-control" name="provinsi_usaha" id="provinsi_usaha" required onchange="updateKotaOptions('provinsi_usaha', 'kota_usaha')">
                            <option selected disabled>Pilih Provinsi *</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-control" name="kota_usaha" id="kota_usaha" required>
                            <option selected disabled>Pilih Kota *</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="kelurahan_usaha" placeholder="Kelurahan *" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="kecamatan_usaha" placeholder="Kecamatan *" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="alamat_usaha" placeholder="Alamat Lengkap Lokasi Usaha *" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="kode_pos" placeholder="Kode POS *" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="titik_koordinat" placeholder="Titik Koordinat Lokasi Usaha *" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi_usaha" class="form-label">Upload Lokasi *</label>
                        <input type="file" class="form-control" id="lokasi_usaha" name="lokasi_usaha" required>
                    </div>
                </div>
            </div>

            <input type="hidden" name="status" value="calon_mitra">

            <div class="text-center mt-4 d-flex justify-content-center gap-3">
                <button type="submit" class="btn btn-danger btn-lg w-25">SUBMIT</button>
                <button type="button" class="btn btn-danger btn-lg w-25" onclick="window.history.back();">BATAL</button>
            </div>
        </form>
    </div>

    <script>
        const dataWilayah = {
            "Jawa Barat": ["Bandung", "Bekasi", "Bogor", "Cirebon", "Depok", "Karawang", "Subang", "Sukabumi", "Tasikmalaya"],
            "Jawa Tengah": ["Semarang", "Solo", "Magelang", "Tegal", "Kudus", "Purwokerto", "Salatiga"],
            "Jawa Timur": ["Surabaya", "Malang", "Kediri", "Madiun", "Blitar", "Banyuwangi", "Jember"]
        };

        function updateKotaOptions(provinsiId, kotaId) {
            const provinsi = document.getElementById(provinsiId).value;
            const kotaSelect = document.getElementById(kotaId);
            kotaSelect.innerHTML = '<option selected disabled>Pilih Kota *</option>';
            if (dataWilayah[provinsi]) {
                dataWilayah[provinsi].forEach(kota => {
                    const option = document.createElement("option");
                    option.value = kota;
                    option.textContent = kota;
                    kotaSelect.appendChild(option);
                });
            }
        }
    </script>
</body>
</html>
