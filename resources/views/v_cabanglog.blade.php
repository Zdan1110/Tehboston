@extends('layouts.applog')

@section('title', 'Home - Teh Boston')

@section('content')
    <style>
        /* ====================== BRANCH PAGE STYLES (INTERNAL) ====================== */
        .branch-content {
            max-width: 1200px;
            margin: 0 auto 50px;
            padding: 0 20px;
        }

        /* Section Title */
        .branch-content .section-title {
            position: relative;
            margin-bottom: 40px;
            font-weight: 700;
            color: var(--primary-dark);
            text-align: center;
            font-size: 2.2rem;
            animation: fadeInUp 0.6s ease forwards;
        }

        .branch-content .section-title::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background: var(--secondary);
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 10px;
        }

        /* Map & Branches Layout */
        .content-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 50px;
        }

        .map-container {
            flex: 2;
            min-width: 400px;
            height: 500px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeInUp 0.8s ease forwards;
            position: relative;
            transition: var(--transition);
        }

        .map-container:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-5px);
        }

        #map {
            height: 100%;
            width: 100%;
            z-index: 1;
            border-radius: 12px;
        }

        .branches-list {
            flex: 1;
            min-width: 300px;
            max-height: 500px;
            overflow-y: auto;
            padding-right: 10px;
            animation: fadeInUp 1s ease forwards;
        }

        /* Custom scrollbar */
        .branches-list::-webkit-scrollbar {
            width: 8px;
        }

        .branches-list::-webkit-scrollbar-track {
            background: var(--light);
            border-radius: 10px;
        }

        .branches-list::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
            transition: var(--transition);
        }

        .branches-list::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* Branch Cards */
        .branch-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            cursor: pointer;
            border-left: 4px solid transparent;
            position: relative;
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
            /* Tambahan untuk pemusatan */
            margin-left: auto;
            margin-right: auto;
            max-width: 500px;
        }

        .branch-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-left: 4px solid var(--secondary);
        }

        .branch-card.active {
            background: var(--light);
            border-left: 4px solid var(--primary);
            transform: translateY(-3px);
        }

        .branch-card h3 {
            color: var(--primary);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            font-size: 1.25rem;
        }

        .branch-card h3 i {
            margin-right: 8px;
            font-size: 1rem;
        }

        .branch-card:hover h3 i {
            transform: scale(1.2);
        }

        .branch-card p {
            grid-area: address;
            padding-left: 0;
            margin-top: 5px;
            margin-bottom: 0;
            padding-top: 5px;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .branch-card:hover p {
            color: var(--primary-dark);
        }

        .branch-card .distance {
            background: var(--accent);
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            position: absolute;
            top: 20px;
            right: 20px;
            font-weight: 500;
            transition: var(--transition);
        }

        .branch-card:hover .distance {
            background: var(--secondary);
            color: white;
        }

        /* Branch card animations */
        .branch-card:nth-child(1) { animation-delay: 0.1s; }
        .branch-card:nth-child(2) { animation-delay: 0.2s; }
        .branch-card:nth-child(3) { animation-delay: 0.3s; }
        .branch-card:nth-child(4) { animation-delay: 0.4s; }
        .branch-card:nth-child(5) { animation-delay: 0.5s; }
        .branch-card:nth-child(6) { animation-delay: 0.6s; }
        .branch-card:nth-child(7) { animation-delay: 0.7s; }
        
        /* Info Section */
        .info-section {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: var(--shadow);
            margin-top: 30px;
            animation: fadeInUp 1.2s ease forwards;
            transition: var(--transition);
        }

        .info-section:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .info-section h2 {
            color: var(--primary);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--accent);
            font-size: 1.8rem;
            position: relative;
        }

        .info-section h2::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: var(--secondary);
            bottom: 0;
            left: 0;
            border-radius: 10px;
        }

        .info-content {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .info-text {
            flex: 1;
            min-width: 300px;
        }

        .info-text p {
            margin-bottom: 15px;
            color: #555;
            line-height: 1.8;
            font-size: 1.05rem;
            position: relative;
            padding-left: 20px;
        }

        .info-text p::before {
            content: "•";
            color: var(--secondary);
            position: absolute;
            left: 0;
            top: 0;
            font-size: 1.2rem;
        }

        .contact-info {
            flex: 1;
            min-width: 300px;
            background: var(--light);
            border-radius: 12px;
            padding: 25px;
            transition: var(--transition);
        }

        .contact-info:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .contact-item:hover {
            transform: translateX(5px);
        }

        .contact-item i {
            color: var(--secondary);
            font-size: 1.5rem;
            min-width: 40px;
            margin-top: 5px;
            transition: var(--transition);
        }

        .contact-item:hover i {
            transform: scale(1.2);
            color: var(--primary);
        }

        .contact-text h4 {
            color: var(--primary);
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .contact-text p {
            color: #555;
            font-size: 0.95rem;
        }

        /* ====================== RESPONSIVE STYLES (INTERNAL) ====================== */
        @media (max-width: 992px) {
            .content-wrapper {
                flex-direction: column;
            }
            
            .map-container {
                width: 100%;
                min-width: unset;
                height: 400px;
            }
            
            .branches-list {
                width: 100%;
                max-height: 400px;
                padding-left: 0;
                padding-right: 0;
            }
            
            .branch-content .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .map-container {
                height: 350px;
            }
            
            .info-section {
                padding: 25px;
            }
            
            .branch-card {
                display: grid;
                grid-template-areas:
                    "title distance"
                    "address address";
                grid-template-columns: 1fr auto;
                gap: 5px 15px;
                padding: 15px;
                margin-left: auto; /* Memastikan card di tengah */
                margin-right: auto; /* Memastikan card di tengah */
                max-width: 500px; /* Batasi lebar card untuk tampilan rapi */
            }
            
            .branch-card .distance {
                grid-area: distance;
                position: static;
                margin: 0;
                align-self: center;
                text-align: right;
                padding: 3px 10px;
            }
            
            .branch-card h3 {
                grid-area: title;
                margin-bottom: 0;
                align-items: center;
                font-size: 1.1rem;
            }

            .branch-card p {
                grid-area: address;
                padding-left: 0;
                margin-top: 5px;
                margin-bottom: 0;
                padding-top: 5px;
                border-top: 1px solid rgba(0,0,0,0.05);
            }

            .branch-card h3 i {
                margin-right: 8px;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .map-container {
                height: 300px;
            }
            
            .branch-card {
                gap: 3px 10px;
            }

            .branch-card h3 {
                font-size: 1rem;
            }

            .branch-card .distance {
                font-size: 0.8rem;
                padding: 2px 8px;
            }

            .branch-card p {
                font-size: 0.85rem;
            }
            
            .info-content {
                flex-direction: column;
            }
            
            .contact-info {
                min-width: unset;
            }
            
            .branch-content .section-title {
                font-size: 1.7rem;
            }
        }
    </style>

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