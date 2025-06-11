<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Survey Franchise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f0f7f4 0%, #c8e6c9 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px;
    }

    .container {
        width: 100%;
        max-width: 900px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: fadeIn 0.5s ease-out;
        margin: 15px 0;
    }

    .header {
        background: linear-gradient(to right, #2e7d32, #388e3c, #43a047);
        color: white;
        padding: 20px;
        text-align: center;
    }

    .header h1 {
        font-size: 22px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .header p {
        font-size: 14px;
        opacity: 0.9;
        max-width: 100%;
        margin: 0 auto;
    }

    .form-container {
        padding: 25px 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2e7d32;
        font-size: 15px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px 14px;
        border: 2px solid #e1e5eb;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: #4caf50;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        outline: none;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #7a8ca5;
        font-size: 14px;
    }

    .input-icon input {
        padding-left: 40px;
    }

    .size-inputs {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .size-inputs div {
        width: 100%;
    }

    .upload-area {
        border: 2px dashed #c8e6c9;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        background-color: #f1f8e9;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-area i {
        font-size: 36px;
        color: #4caf50;
        margin-bottom: 10px;
    }

    .upload-area h3 {
        color: #2e7d32;
        margin-bottom: 8px;
        font-size: 16px;
    }

    .upload-area p {
        color: #7a8ca5;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .upload-btn {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 8px 18px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s ease;
        font-size: 14px;
    }

    .upload-btn:hover {
        background-color: #388e3c;
    }

    .preview-container {
        margin-top: 15px;
        display: none;
    }

    .preview-container.show {
        display: block;
    }

    .preview-title {
        font-weight: 600;
        margin-bottom: 8px;
        color: #2e7d32;
        font-size: 15px;
    }

    .image-preview {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-top: 8px;
        display: none;
    }

    .image-preview.show {
        display: block;
    }

    .submit-btn {
        background: linear-gradient(to right, #388e3c, #2e7d32);
        color: white;
        border: none;
        padding: 14px 20px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-top: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(56, 142, 60, 0.4);
    }

    .footer {
        text-align: center;
        padding: 15px;
        color: #7a8ca5;
        font-size: 13px;
        border-top: 1px solid #e1e5eb;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Tablet dan Desktop */
    @media (min-width: 768px) {
        .container {
            border-radius: 20px;
            margin: 20px 0;
        }

        .header {
            padding: 25px 40px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 16px;
            max-width: 600px;
        }

        .form-container {
            padding: 35px 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 16px;
        }

        .input-icon i {
            left: 16px;
            font-size: 16px;
        }

        .input-icon input {
            padding-left: 45px;
        }

        .size-inputs {
            flex-direction: row;
            gap: 15px;
        }

        .upload-area {
            padding: 30px;
            border-radius: 12px;
        }

        .upload-area i {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .upload-area h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .upload-area p {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .upload-btn {
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 16px;
        }

        .preview-container {
            margin-top: 20px;
        }

        .preview-title {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .image-preview {
            max-height: 250px;
            border-radius: 10px;
            margin-top: 10px;
        }

        .submit-btn {
            padding: 16px 30px;
            border-radius: 12px;
            font-size: 18px;
            margin-top: 20px;
        }

        .footer {
            padding: 20px;
            font-size: 14px;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-store"></i> Laporan Survey Franchise</h1>
            <p>Form untuk menambahkan laporan hasil survey lokasi franchise baru</p>
        </div>
        
        <div class="form-container">
            <form id="surveyForm">
                <div class="form-group">
                    <label for="franchiseName">Nama Franchise</label>
                    <div class="input-icon">
                        <i class="fas fa-signature"></i>
                        <input type="text" id="franchiseName" placeholder="Masukkan nama franchise" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Ukuran Tanah</label>
                    <div class="size-inputs">
                        <div>
                            <label for="length">Panjang (m)</label>
                            <input type="number" id="length" placeholder="0.0" step="0.1" min="0" required>
                        </div>
                        <div>
                            <label for="width">Lebar (m)</label>
                            <input type="number" id="width" placeholder="0.0" step="0.1" min="0" required>
                        </div>
                        <div>
                            <label for="totalArea">Total Luas (m²)</label>
                            <input type="number" id="totalArea" placeholder="0.0" step="0.1" min="0" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Upload Foto Lokasi</label>
                    <div class="upload-area" id="uploadArea">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h3>Klik atau tarik file ke sini</h3>
                        <p>Format yang didukung: JPG, PNG (Maks. 5MB)</p>
                        <button type="button" class="upload-btn">Pilih File</button>
                        <input type="file" id="fileInput" accept="image/*" style="display: none;">
                    </div>
                    <div class="preview-container" id="previewContainer">
                        <div class="preview-title">Pratinjau Foto</div>
                        <img id="imagePreview" class="image-preview" src="#" alt="Pratinjau Foto Lokasi">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="notes">Catatan Tambahan</label>
                    <textarea id="notes" rows="4" placeholder="Tambahkan catatan mengenai lokasi, kondisi lingkungan, atau hal penting lainnya..."></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Simpan Laporan Survey
                </button>
                <a href="/datasurvey" class="submit-btn">
                <i class="fas fa-home"></i> Kembali ke Home
                </a>

            </form>
        </div>
        
        <div class="footer">
            <p>© 2023 Sistem Laporan Survey Franchise | Semua data yang diinput akan dijaga kerahasiaannya</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menghitung luas tanah secara otomatis
            const lengthInput = document.getElementById('length');
            const widthInput = document.getElementById('width');
            const totalAreaInput = document.getElementById('totalArea');
            
            function calculateArea() {
                const length = parseFloat(lengthInput.value) || 0;
                const width = parseFloat(widthInput.value) || 0;
                totalAreaInput.value = (length * width).toFixed(2);
            }
            
            lengthInput.addEventListener('input', calculateArea);
            widthInput.addEventListener('input', calculateArea);
            
            // Upload foto
            const uploadArea = document.getElementById('uploadArea');
            const fileInput = document.getElementById('fileInput');
            const previewContainer = document.getElementById('previewContainer');
            const imagePreview = document.getElementById('imagePreview');
            
            uploadArea.addEventListener('click', function() {
                fileInput.click();
            });
            
            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    const validImageTypes = ['image/jpeg', 'image/png'];
                    
                    if (!validImageTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Harap unggah file JPG atau PNG.');
                        return;
                    }
                    
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.src = event.target.result;
                        previewContainer.classList.add('show');
                        imagePreview.classList.add('show');
                    }
                    reader.readAsDataURL(file);
                }
            });
            
            // Drag and drop
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.style.borderColor = '#4b6cb7';
                uploadArea.style.backgroundColor = '#e3eaf9';
            });
            
            uploadArea.addEventListener('dragleave', function() {
                uploadArea.style.borderColor = '#d1d8e0';
                uploadArea.style.backgroundColor = '#f8fafc';
            });
            
            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.style.borderColor = '#d1d8e0';
                uploadArea.style.backgroundColor = '#f8fafc';
                
                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;
                    const event = new Event('change');
                    fileInput.dispatchEvent(event);
                }
            });
            
            // Submit form
            const surveyForm = document.getElementById('surveyForm');
            
            surveyForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validasi sederhana
                if (!document.getElementById('franchiseName').value) {
                    alert('Harap masukkan nama franchise');
                    return;
                }
                
                if (!document.getElementById('franchiseType').value) {
                    alert('Harap pilih jenis franchise');
                    return;
                }
                
                if (!fileInput.files.length) {
                    alert('Harap unggah foto lokasi');
                    return;
                }
                
                // Simulasi pengiriman data
                alert('Laporan survey berhasil disimpan!\nData akan diproses lebih lanjut.');
                surveyForm.reset();
                previewContainer.classList.remove('show');
                imagePreview.classList.remove('show');
                totalAreaInput.value = '';
            });
        });
    </script>
</body>
</html>