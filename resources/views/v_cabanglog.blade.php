@extends('layouts.applog')

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

    {{-- Font Awesome (Icons) --}}
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    {{-- Bootstrap Bundle (Optional, if you use other Bootstrap components) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Leaflet JS Library --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi peta dengan tampilan awal. Ini akan disesuaikan nanti.
            const map = L.map('map').setView([-6.568248, 107.762785], 13);
            
            // Tambahkan lapisan peta (tile layer) dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            // Lokasi cabang-cabang Teh Boston
            const branches = [
                {name: "Depan PTPN", address: "Jl. Raya Subang No.1, Subang", lat: -6.568248, lng: 107.762785},
                {name: "Jl. Pejuan 45", address: "Jl. Pejuang 45, Subang Kota", lat: -6.560306, lng: 107.763882},
                {name: "Pagaden", address: "Jl. Raya Pagaden, Subang", lat: -6.454361, lng: 107.809062},
                {name: "Kalijati", address: "Jl. Raya Kalijati, Subang", lat: -6.525581, lng: 107.677356},
                {name: "Dangdeur", address: "Jl. Dangdeur, Subang", lat: -6.558708, lng: 107.746741},
                {name: "Cinangsih", address: "Jl. Cinangsih, Subang", lat: -6.558703, lng: 107.798150},
                {name: "Sukamelang", address: "Jl. Sukamelang, Subang", lat: -6.539116, lng: 107.774976}
            ];
            
            // Tambahkan marker ke peta dan simpan koordinatnya untuk perhitungan batas
            const markers = [];
            const customIcon = L.icon({
                iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                shadowSize: [41, 41]
            });

            const latLngs = []; // Untuk menyimpan semua LatLng marker agar peta bisa menyesuaikan batas
            
            branches.forEach(branch => {
                const marker = L.marker([branch.lat, branch.lng], {icon: customIcon}).addTo(map)
                    .bindPopup(`<b>${branch.name}</b><br>${branch.address}`);
                markers.push(marker);
                latLngs.push([branch.lat, branch.lng]);
            });

            // Sesuaikan peta agar menampilkan semua marker. Ini sangat penting untuk tampilan seluler.
            if (latLngs.length > 0) {
                const bounds = L.latLngBounds(latLngs);
                map.fitBounds(bounds, { padding: [50, 50] }); // Tambahkan padding di sekitar batas
            }
            
            // Interaksi dengan kartu cabang
            const branchCards = document.querySelectorAll('.branch-card');
            
            branchCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Hapus kelas 'active' dari semua kartu
                    branchCards.forEach(c => c.classList.remove('active'));
                    
                    // Tambahkan kelas 'active' ke kartu yang diklik
                    this.classList.add('active');
                    
                    // Dapatkan koordinat dari data-attribute
                    const lat = parseFloat(this.dataset.lat);
                    const lng = parseFloat(this.dataset.lng);
                    
                    // Pusatkan peta pada cabang yang dipilih dan perbesar sedikit
                    map.setView([lat, lng], 15);
                    
                    // Buka popup untuk cabang yang dipilih
                    markers.forEach(marker => {
                        if (marker.getLatLng().lat === lat && marker.getLatLng().lng === lng) {
                            marker.openPopup();
                        }
                    });
                });
            });
            
            // Mensimulasikan lokasi pengguna (dalam aplikasi nyata, ini akan berasal dari Geolocation API)
            // Lokasi awal diset ke "Depan PTPN" di Subang, Jawa Barat, Indonesia.
            const userLocation = L.latLng(-6.568248, 107.762785); 
            
            // Tambahkan marker lokasi pengguna
            const userIcon = L.icon({
                iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon-blue.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                shadowSize: [41, 41]
            });
            
            L.marker(userLocation, {icon: userIcon}).addTo(map)
                .bindPopup('Lokasi Anda Saat Ini (Simulasi)'); // Popup yang lebih deskriptif
            
            // Hitung jarak ke setiap cabang
            branchCards.forEach(card => {
                const cardLat = parseFloat(card.dataset.lat);
                const cardLng = parseFloat(card.dataset.lng);
                
                // Hitung jarak dalam kilometer
                const distance = calculateDistance(
                    userLocation.lat, 
                    userLocation.lng,
                    cardLat,
                    cardLng
                );
                
                // Perbarui elemen jarak
                card.querySelector('.distance').textContent = distance.toFixed(1) + ' km';
            });
            
            // Fungsi untuk menghitung jarak antara dua koordinat (Haversine formula)
            function calculateDistance(lat1, lon1, lat2, lon2) {
                const R = 6371; // Radius bumi dalam km
                const dLat = deg2rad(lat2 - lat1);
                const dLon = deg2rad(lon2 - lon1);
                
                const a = 
                    Math.sin(dLat/2) * Math.sin(dLat/2) +
                    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2);
                    
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
                const distance = R * c; // Jarak dalam km
                
                return distance;
            }
            
            function deg2rad(deg) {
                return deg * (Math.PI/180);
            }

            // Memperbaiki masalah ukuran peta pada perangkat seluler
            // Fungsi ini sangat penting untuk memastikan peta terlihat dengan benar
            function resizeMap() {
                setTimeout(() => {
                    map.invalidateSize(); // Memaksa Leaflet untuk menghitung ulang ukuran containernya
                    
                    // Sesuaikan batas peta kembali setelah resize untuk memastikan semua marker terlihat
                    if (latLngs.length > 0) {
                        const bounds = L.latLngBounds(latLngs);
                        map.fitBounds(bounds, { padding: [50, 50] });
                    }
                }, 100); // Penundaan singkat untuk memastikan dimensi container telah diatur oleh CSS
            }
            
            // Panggilan awal resizeMap untuk memastikan rendering yang benar pada pemuatan pertama
            resizeMap(); 
            // Tambahkan event listener untuk perubahan ukuran jendela dan orientasi perangkat
            window.addEventListener('resize', resizeMap);
            window.addEventListener('orientationchange', resizeMap);

            // Opsional: Dengarkan event 'load' juga, jika 'DOMContentLoaded' terkadang terlalu cepat di beberapa lingkungan
            window.addEventListener('load', resizeMap);
        });
    </script>
@endsection