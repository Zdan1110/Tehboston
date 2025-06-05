<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('finexo-html/images/favicon.png') }}" type="">

  <!-- External Fonts & Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- Project CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

  <!-- Finexo template CSS -->
  <link rel="stylesheet" href="{{ asset('finexo-html/css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('finexo-html/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('finexo-html/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('finexo-html/css/responsive.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  
  <style>
    .container {
      text-align: left;
      padding: 20px;
    }

    .heading {
      font-size: 2rem;
      text-align: center;
      color: rgb(53, 57, 35);
      margin-bottom: 20px;
    }

    .mission-item {
      display: flex;
      align-items: center;
      margin: 50px 0;
    }

    .mission-item i {
      margin-right: 10px;
      font-size: 54px;
    }

    #map {
      height: 450px;
      width: 100%;
    }

    .card-map {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      margin: 30px auto;
      max-width: 90%;
      opacity: 0;
      transform: translateY(50px);
      transition: opacity 1s ease, transform 1s ease;
    }

    .card-map.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .card-body-map {
      padding: 0;
    }
  </style>

  <title>Teh Boston</title>
</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="images/hero-bg.png" alt="">
      </div>
    </div>

    <!-- Header -->
    @include('layouts.navbarindex')

    <!-- Map Card -->
    <div class="container" >
      <div class="card card-map" id="mapCard">
        <div class="card-header text-white bg-success text-center " style="background-color:#fff999">
          <h5 class="mb-0" >Peta Titik di Kabupaten Subang</h5>
        </div>
        <div class="card-body card-body-map">
          <div id="map"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Daftar Lokasi -->
  <div class="row mt-4 container mx-auto">
  @foreach([
      ['Depan PTPN', 'Jl. Raya Subang No.1, Subang', -6.568248086136461, 107.76278536215128],
      ['Jl. Pejuan 45', 'Jl. Pejuang 45, Subang Kota', -6.5603068906337185, 107.76388261778222],
      ['Pagaden', 'Jl. Raya Pagaden, Subang', -6.454361043697384, 107.80906243523869],
      ['Kalijati', 'Jl. Raya Kalijati, Subang', -6.525581845161832, 107.67735680437562],
      ['Dangdeur', 'Jl. Dangdeur, Subang', -6.558708371279702, 107.74674192399566],
      ['Cinangsih', 'Jl. Cinangsih, Subang', -6.558703294896193, 107.79815015807498],
      ['Sukamelang', 'Jl. Sukamelang, Subang', -6.539116265035688, 107.77497667867493]
  ] as $lokasi)
  <div class="col-md-4 col-sm-6 mb-3">
    <div class="card shadow-sm h-100 location-card" style="cursor: pointer;"
         data-lat="{{ $lokasi[2] }}"
         data-lng="{{ $lokasi[3] }}"
         data-nama="{{ $lokasi[0] }}">
      <div class="card-body">
        <h5 class="card-title text-success">
          <i class="fas fa-map-marker-alt me-2"></i>{{ $lokasi[0] }}
        </h5>
        <p class="card-text">{{ $lokasi[1] }}</p>
      </div>
    </div>
  </div>
  @endforeach
</div>

@include('layouts.footerindex')

  <!-- jQuery -->
  <script type="text/javascript" src="{{ asset('finexo-html/js/jquery-3.4.1.min.js') }}"></script>
  <!-- Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <!-- Bootstrap -->
  <script type="text/javascript" src="{{ asset('finexo-html/js/bootstrap.js') }}"></script>
  <!-- Owl Carousel -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- Custom -->
  <script type="text/javascript" src="{{ asset('finexo-html/js/custom.js') }}"></script>
  <!-- Leaflet -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <!-- Intersection Observer Animation -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const cardMap = document.getElementById("mapCard");

      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
            observer.unobserve(entry.target); // hanya sekali
          }
        });
      }, { threshold: 0.1 });

      observer.observe(cardMap);
    });
  </script>

<script>
  // Klik pada card => arahkan peta ke titik
  document.querySelectorAll('.location-card').forEach(card => {
    card.addEventListener('click', function () {
      const lat = parseFloat(this.dataset.lat);
      const lng = parseFloat(this.dataset.lng);
      const nama = this.dataset.nama;

      map.setView([lat, lng], 15); // zoom 15
      L.popup()
        .setLatLng([lat, lng])
        .setContent(`<b>${nama}</b>`)
        .openOn(map);
    });
  });
</script>


  <!-- Inisialisasi Peta -->
  <script>
    var map = L.map('map').setView([-6.5592, 107.7608], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var locations = [
      { name: "Depan PTPN", coords: [-6.568248086136461, 107.76278536215128] },
      { name: "Jl. Pejuan 45", coords: [-6.5603068906337185, 107.76388261778222] },
      { name: "Pagaden", coords: [-6.454361043697384, 107.80906243523869] },
      { name: "Kalijati", coords: [-6.525581845161832, 107.67735680437562] },
      { name: "Dangdeur", coords: [-6.558708371279702, 107.74674192399566] },
      { name: "Cinagsi", coords: [-6.558703294896193, 107.79815015807498] },
      { name: "Sukamelang", coords: [-6.539116265035688, 107.77497667867493] }
    ];

    locations.forEach(function(location) {
      L.marker(location.coords)
        .addTo(map)
        .bindPopup(location.name);
    });
  </script>

</body>
</html>
