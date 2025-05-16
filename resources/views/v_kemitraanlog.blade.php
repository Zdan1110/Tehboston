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

  <style>
  .custom-card {
    border-radius: 20px;
    overflow: hidden;
    background-color:rgb(90, 188, 142); /* tosca */
    color: white;
  }

  .card-price {
    font-size: 2rem;
    font-weight: bold;
    color: rgb(90, 188, 142);
  }

  .card-title {
    font-size: 1.25rem;
    font-weight: 500;
    color: rgb(90, 188, 142);
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

    <!-- header section strats -->
    @include('layouts.navbar')
    <!-- end header section -->
  </div>

  <!-- about section -->

  <section class="about_section layout_padding"> 
  <div class="container">
    <div class="heading_container heading_center">
     
    <div class="row justify-content-center align-items-center" style="margin: 50px 0;">
  <div class="col-auto">
    <img src="finexo-html/images/yakmel.png" alt="Ikon Mitra" class="ikon-mitra-animasi">
  </div>
  <div class="col text-center">
    <h2 style="font-weight: bold; margin-bottom: 30px;">PROSES GABUNG MITRA</h2>
    <a href="finexo-html/images/alur.png" target="_blank">
      <img src="finexo-html/images/alur.png" alt="Alur Singkat Pendaftaran"
           class="img-alur">
    </a>
  </div>
</div>

</div>


    <section class="about_section layout_padding" style="background-color:rgb(228, 222, 136); border-radius: 10%;">
  <div class="container text-center">
    <h2 class="mb-4" style="color: #006400; font-weight: bold; font-size: 40px; margin-top: 1px;" >Paket Mitra Teh Boston</h2>

    <!-- Tabs Paket -->

    <!-- Booth + Peralatan -->
    <div class="row align-items-center">
      <!-- Booth -->
      <div class="col-md-5 mb-4">
        <div class="position-relative">
          <img src="{{ asset('finexo-html/images/booth.png') }}" alt="Booth Es Teh" class="img-fluid">
          <div class="position-absolute" style="left: 0; bottom: 10px; background-color:rgb(162, 158, 120); padding: 10px 15px; border-radius: 50%;">
            <strong>UKURAN BOOTH</strong><br>
            <span>120x65x221.5 cm</span><br>
            <small>(P × L × T)</small>
          </div>
        </div>
      </div>

      <!-- Peralatan -->
      <div class="col-md-7">
        <h5 class="text-left" style="color: #006400; font-size: 20px">Peralatan dan bahan baku yang didapatkan:</h5>
        <div class="row mt-3">
        @php
        $items = [
        ['img' => 'booth.png', 'label' => 'Meja Counter', 'size' => '75px'],
        ['img' => 'seal.png', 'label' => 'Mesin Seal', 'size' => '120px'],
        ['img' => 'coolerbox.png', 'label' => 'Cooler Box', 'size' => '125px'],
        ['img' => 'dispenser.png', 'label' => 'Tea Barrel', 'size' => '120px'],
        ['img' => 'cup.png', 'label' => '100 Cup', 'size' => '120px'],
        ['img' => 'apron.png', 'label' => 'Apron', 'size' => '120px'],
        ['img' => 'varian rasa.png', 'label' => 'Serbuk Rasa', 'size' => '100px'],
        ];
        @endphp


        @foreach ($items as $item)
        <div class="col-md-2 col-4 text-center">
            <img src="{{ asset('finexo-html/images/' . $item['img']) }}" alt="{{ $item['label'] }}" style="height: {{ $item['size'] }}; object-fit: contain;">
            <p class="mt-2">{{ $item['label'] }}</p>
        </div>
        @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
  <div class="row justify-content-center">

    <!-- Dalam Kota Subang -->
    <div class="col-md-4 mb-4">
      <div class="card shadow custom-card text-center border-0">
        <div class="card-header card-header-tosca" style="color: #008080;">
          Dalam Kota Subang
        </div>
        <div class="card-body">
          <h5 class="card-title">Harga Paket</h5>
          <p class="card-price">Rp 25.000.000</p>
        </div>
      </div>
    </div>

    <!-- Luar Kota Subang -->
    <div class="col-md-4 mb-4">
      <div class="card shadow custom-card text-center border-0">
      <div class="card-header card-header-tosca" style="color: #008080;">

          Luar Kota Subang
        </div>
        <div class="card-body">
          <h5 class="card-title">Harga Paket</h5>
          <p class="card-price">Rp 26.000.000</p>
        </div>
      </div>
    </div>

  </div>

  <!-- Tombol Daftar Sekarang -->
  <div class="row justify-content-center mt-4">
    <div class="col-md-4 text-center">
      <a href="/daftarmitra" class="btn btn-daftar-sekarang">Daftar Sekarang</a>
    </div>
  </div>
</div>

</section>

  </section>

  <!-- end about section -->
  @include('layouts.footer')

  <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- jQery -->
  <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
  <!-- jQery -->
 <!-- jQuery -->
 <script>
  function animateCurrentSlide() {
    // Hapus animasi dari semua detail-box
    document.querySelectorAll('.detail-box').forEach(el => el.classList.remove('animate-up'));

    // Tambahkan animasi ke slide yang aktif
    const activeSlide = document.querySelector('.carousel-item.active .detail-box');
    if (activeSlide) {
      activeSlide.classList.add('animate-up');
    }
  }

  // Saat halaman dimuat
  window.addEventListener('load', animateCurrentSlide);

  // Saat slide selesai berganti
  $('#customCarousel1').on('slid.bs.carousel', function () {
    animateCurrentSlide();
  });
</script>



  <!-- jQery -->
  <script type="text/javascript" src="{{ asset('finexo-html/js/jquery-3.4.1.min.js') }}"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="{{ asset('finexo-html/js/bootstrap.js') }}"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- custom js -->
  <script type="text/javascript" src="{{ asset('finexo-html/js/custom.js') }}"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

  <script>
  function handleScrollAnimation() {
    document.querySelectorAll('.fade-up').forEach(el => {
      const rect = el.getBoundingClientRect();
      const inView = rect.top < window.innerHeight - 50 && rect.bottom > 0;
      if (inView) {
        el.classList.add('fade-up-visible');
      } else {
        el.classList.remove('fade-up-visible'); // Agar bisa muncul ulang saat scroll balik
      }
    });
  }

  // Trigger saat scroll dan saat halaman dimuat
  window.addEventListener('scroll', handleScrollAnimation);
  window.addEventListener('load', handleScrollAnimation);
</script>


  <script>
  window.addEventListener('load', function () {
    const header = document.querySelector('.header_section');
    if (header) {
      header.classList.add('animate-down');
    }
  });

  const header = document.querySelector('.header_section');
  let lastScrollTop = 0;
  let ticking = false;

  // Fungsi untuk memicu animasi ulang
  function triggerHeaderAnimation() {
    header.classList.remove('animate-down');
    void header.offsetWidth; // reflow agar animasi bisa diulang
    header.classList.add('animate-down');
  }

  // Saat halaman dimuat pertama kali
  window.addEventListener('load', triggerHeaderAnimation);

  // Saat di-scroll ke atas
  window.addEventListener('scroll', function () {
    if (!ticking) {
      window.requestAnimationFrame(function () {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll < lastScrollTop && currentScroll > 0) {
          // Scroll ke atas, bukan di paling atas
          triggerHeaderAnimation();
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        ticking = false;
      });

      ticking = true;
    }
  });
</script>

<script>
  function animateCurrentSlide() {
    document.querySelectorAll('.detail-box').forEach(el => el.classList.remove('animate-up'));

    const activeSlide = document.querySelector('.carousel-item.active .detail-box');
    if (activeSlide) {
      void activeSlide.offsetWidth; // reflow untuk reset animasi
      activeSlide.classList.add('animate-up');
    }
  }

  // Saat halaman dimuat
  window.addEventListener('load', animateCurrentSlide);

  // Saat slide berubah
  $('#customCarousel1').on('slid.bs.carousel', function () {
    animateCurrentSlide();
  });

  // Saat scroll ke atas dan slider terlihat
  let lastScrollTopSlider = 0;
  window.addEventListener('scroll', function () {
    const sliderSection = document.querySelector('.slider_section');
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll < lastScrollTopSlider && isInViewport(sliderSection)) {
      animateCurrentSlide();
    }

    lastScrollTopSlider = currentScroll <= 0 ? 0 : currentScroll;
  });

  function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return rect.top < window.innerHeight && rect.bottom > 0;
  }
</script>


</body>

</html>