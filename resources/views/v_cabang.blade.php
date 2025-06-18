@extends('layouts.app')

@section('title', 'Home - Teh Boston')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="fade-in">Cabang Teh Boston</h1>
            <p class="fade-in">Temukan lokasi cabang terdekat dan nikmati minuman teh berkualitas kami</p>
        </div>
    </header>

    <div class="branch-content">
        <h2 class="section-title fade-in">Cabang Kami</h2>
        
        <div class="content-wrapper">
            <div class="map-container fade-in">
                <div id="map"></div>
            </div>
            
            <div class="branches-list">
                <div class="branch-card active" data-lat="-6.568248" data-lng="107.762785">
                    <h3><i class="fas fa-map-marker-alt"></i> Depan PTPN</h3>
                    <p>Jl. Raya Subang No.1, Subang</p>
                    <div class="distance">0 km</div>
                </div>
                
                <div class="branch-card" data-lat="-6.560306" data-lng="107.763882">
                    <h3><i class="fas fa-map-marker-alt"></i> Jl. Pejuan 45</h3>
                    <p>Jl. Pejuang 45, Subang Kota</p>
                    <div class="distance">1.2 km</div>
                </div>
                
                <div class="branch-card" data-lat="-6.454361" data-lng="107.809062">
                    <h3><i class="fas fa-map-marker-alt"></i> Pagaden</h3>
                    <p>Jl. Raya Pagaden, Subang</p>
                    <div class="distance">12.8 km</div>
                </div>
                
                <div class="branch-card" data-lat="-6.525581" data-lng="107.677356">
                    <h3><i class="fas fa-map-marker-alt"></i> Kalijati</h3>
                    <p>Jl. Raya Kalijati, Subang</p>
                    <div class="distance">9.3 km</div>
                </div>
                
                <div class="branch-card" data-lat="-6.558708" data-lng="107.746741">
                    <h3><i class="fas fa-map-marker-alt"></i> Dangdeur</h3>
                    <p>Jl. Dangdeur, Subang</p>
                    <div class="distance">1.8 km</div>
                </div>
                
                <div class="branch-card" data-lat="-6.558703" data-lng="107.798150">
                    <h3><i class="fas fa-map-marker-alt"></i> Cinangsih</h3>
                    <p>Jl. Cinangsih, Subang</p>
                    <div class="distance">3.5 km</div>
                </div>
                
                <div class="branch-card" data-lat="-6.539116" data-lng="107.774976">
                    <h3><i class="fas fa-map-marker-alt"></i> Sukamelang</h3>
                    <p>Jl. Sukamelang, Subang</p>
                    <div class="distance">3.2 km</div>
                </div>
            </div>
        </div>
        
        <div class="info-section fade-in">
            <h2>Informasi Cabang Teh Boston</h2>
            <div class="info-content">
                <div class="info-text">
                    <p>Teh Boston memiliki 7 cabang strategis di wilayah Subang yang siap melayani Anda. Setiap cabang kami menyediakan berbagai varian minuman teh berkualitas dengan bahan-bahan pilihan.</p>
                    <p>Jam operasional cabang Teh Boston adalah setiap hari dari pukul 09:00 hingga 21:00 WIB. Kami selalu menjaga kebersihan dan kualitas produk di setiap cabang.</p>
                    <p>Semua cabang Teh Boston memiliki standar pelayanan yang sama sehingga Anda akan mendapatkan pengalaman minum teh yang konsisten di mana pun lokasinya.</p>
                </div>
                
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div class="contact-text">
                            <h4>Jam Operasional</h4>
                            <p>Setiap Hari: 09:00 - 21:00 WIB</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div class="contact-text">
                            <h4>Telepon</h4>
                            <p>+62 123 4567 890 (Customer Service)</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>info@tehboston.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-info-circle"></i>
                        <div class="contact-text">
                            <h4>Pemesanan</h4>
                            <p>Pemesanan grosir untuk acara hubungi cabang terdekat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection