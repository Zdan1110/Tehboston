<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Toko Teh Boston</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f0f9eb 0%, #e6f4f1 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .nota-container {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }
        
        .nota-header {
            background: linear-gradient(135deg, #2c7744 0%, #5a9e6f 100%);
            padding: 25px 30px;
            text-align: center;
            position: relative;
            color: white;
        }
        
        .logo {
            font-size: 3.5rem;
            margin-bottom: 10px;
            color: #e0f7e0;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        .nota-header h1 {
            font-size: 2.2rem;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .nota-header p {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .customer-info {
            padding: 20px 30px;
            background: #f8fafc;
            border-bottom: 2px dashed #e2e8f0;
            display: flex;
            align-items: center;
        }
        
        .customer-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #5a9e6f 0%, #2c7744 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.8rem;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .customer-details {
            flex: 1;
        }
        
        .customer-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c7744;
            margin-bottom: 5px;
        }
        
        .customer-id {
            font-size: 0.9rem;
            color: #718096;
        }
        
        .transaction-info {
            padding: 15px 30px;
            background: #f1f8e9;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            border-bottom: 2px dashed #c5e1a5;
        }
        
        .info-item {
            margin: 8px 0;
            font-size: 0.95rem;
            color: #4a5568;
            display: flex;
            align-items: center;
        }
        
        .info-item i {
            margin-right: 8px;
            color: #5a9e6f;
            width: 20px;
            text-align: center;
        }
        
        .nota-table {
            width: 100%;
            border-collapse: collapse;
            padding: 0 30px;
        }
        
        .nota-table th {
            background: #edf2f7;
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            color: #2d3748;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .nota-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #edf2f7;
            color: #4a5568;
        }
        
        .nota-table tr:last-child td {
            border-bottom: none;
        }
        
        .nota-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        .nota-total {
            padding: 20px 30px;
            text-align: right;
            background: #f1f8e9;
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c7744;
            border-top: 2px dashed #c5e1a5;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .total-label {
            display: flex;
            align-items: center;
        }
        
        .total-label i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .total-amount {
            font-size: 1.5rem;
        }
        
        .payment-method {
            padding: 15px 30px;
            background: #f8fafc;
            border-top: 2px dashed #e2e8f0;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }
        
        .payment-method i {
            margin-right: 10px;
            color: #5a9e6f;
            font-size: 1.2rem;
        }
        
        .nota-footer {
            padding: 20px 30px;
            text-align: center;
            background: #2c7744;
            color: white;
        }
        
        .footer-text {
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.2rem;
            transition: transform 0.3s;
        }
        
        .social-icons a:hover {
            transform: translateY(-3px);
        }
        
        .qr-code {
            margin-top: 15px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            display: inline-block;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .nota-container {
                box-shadow: none;
                border-radius: 0;
                max-width: 100%;
            }
            
            .social-icons {
                display: none;
            }
        }
        
        @media (max-width: 500px) {
            .customer-info {
                flex-direction: column;
                text-align: center;
            }
            
            .customer-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .transaction-info {
                flex-direction: column;
            }
            
            .nota-table {
                font-size: 0.9rem;
            }
            
            .nota-table th, .nota-table td {
                padding: 8px 5px;
            }
            
            .nota-total {
                font-size: 1.1rem;
            }
            
            .total-amount {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="nota-container">
        <div class="nota-header">
            <div class="logo">
                <i class="fas fa-mug-hot"></i>
            </div>
            <h1>TEH BOSTON</h1>
            <p>Jl. Anggrek No. 56, Jakarta Selatan | Telp: (021) 5678-9012</p>
        </div>
        
        <div class="customer-info">
            <div class="customer-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="customer-details">
                <div class="customer-name">Budi Santoso</div>
                <div class="customer-id">ID Pelanggan: BOS-789012</div>
            </div>
        </div>
        
        <div class="transaction-info">
            <div class="info-item">
                <i class="far fa-calendar"></i>
                <span id="tanggal"></span>
            </div>
            <div class="info-item">
                <i class="far fa-clock"></i>
                <span id="waktu"></span>
            </div>
            <div class="info-item">
                <i class="far fa-calendar-check"></i>
                <span id="hari"></span>
            </div>
            <div class="info-item">
                <i class="fas fa-receipt"></i>
                No. Nota: BOS-2023-0620-001
            </div>
        </div>
        
        <table class="nota-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <i class="fas fa-wine-bottle" style="color: #5a9e6f; margin-right: 8px;"></i>
                        Teh Botol Original
                    </td>
                    <td>2</td>
                    <td>Rp 10.000</td>
                    <td>Rp 20.000</td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-cube" style="color: #5a9e6f; margin-right: 8px;"></i>
                        Teh Kotak Lemon
                    </td>
                    <td>3</td>
                    <td>Rp 8.000</td>
                    <td>Rp 24.000</td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-box" style="color: #5a9e6f; margin-right: 8px;"></i>
                        Teh Tarik Kemasan
                    </td>
                    <td>5</td>
                    <td>Rp 5.000</td>
                    <td>Rp 25.000</td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-wine-bottle" style="color: #5a9e6f; margin-right: 8px;"></i>
                        Teh Hijau Botol
                    </td>
                    <td>1</td>
                    <td>Rp 12.000</td>
                    <td>Rp 12.000</td>
                </tr>
            </tbody>
        </table>
        
        <div class="nota-total">
            <div class="total-label">
                <i class="fas fa-money-bill-wave"></i>
                <span>TOTAL PEMBAYARAN:</span>
            </div>
            <div class="total-amount">Rp 81.000</div>
        </div>
        
        
        <div class="nota-footer">
            <p class="footer-text">Terima kasih atas kunjungan Anda!</p>
            <p class="footer-text">Teh Boston - Menyegarkan Sejak 1995</p>
            
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
            
            <div class="qr-code">
                <div style="width: 80px; height: 80px; background: #f0f0f0; display: grid; grid-template-columns: repeat(5, 1fr); grid-gap: 2px; padding: 5px;">
                    <!-- Simple QR Code Representation -->
                    <div style="background: #000;"></div><div style="background: #000;"></div><div style="background: #000;"></div><div style="background: #000;"></div><div style="background: #000;"></div>
                    <div style="background: #000;"></div><div style="background: #fff;"></div><div style="background: #fff;"></div><div style="background: #fff;"></div><div style="background: #000;"></div>
                    <div style="background: #000;"></div><div style="background: #fff;"></div><div style="background: #000;"></div><div style="background: #fff;"></div><div style="background: #000;"></div>
                    <div style="background: #000;"></div><div style="background: #fff;"></div><div style="background: #fff;"></div><div style="background: #fff;"></div><div style="background: #000;"></div>
                    <div style="background: #000;"></div><div style="background: #000;"></div><div style="background: #000;"></div><div style="background: #000;"></div><div style="background: #000;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengisi tanggal, waktu, dan hari
        function isiTanggal() {
            const sekarang = new Date();
            
            // Format tanggal: DD MMMM YYYY
            const optionsTanggal = { 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric' 
            };
            document.getElementById('tanggal').textContent = sekarang.toLocaleDateString('id-ID', optionsTanggal);
            
            // Format waktu: HH:MM:SS
            const jam = sekarang.getHours().toString().padStart(2, '0');
            const menit = sekarang.getMinutes().toString().padStart(2, '0');
            const detik = sekarang.getSeconds().toString().padStart(2, '0');
            document.getElementById('waktu').textContent = `${jam}:${menit}:${detik} WIB`;
            
            // Format hari
            const optionsHari = { weekday: 'long' };
            document.getElementById('hari').textContent = sekarang.toLocaleDateString('id-ID', optionsHari);
        }
        
        // Panggil fungsi saat halaman dimuat
        window.onload = isiTanggal;
    </script>
</body>
</html>