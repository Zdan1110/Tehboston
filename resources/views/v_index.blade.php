<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('finexo-html/images/favicon.png') }}" type="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }} " />
  <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />


  <title> Teh Boston </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('finexo-html/css/bootstrap.css') }}" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="{{ asset('finexo-html/css/font-awesome.min.css') }}" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('finexo-html/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('finexo-html/css/responsive.css') }}" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">

    <div class="hero_bg_box">
      <div class="bg_img_box">
      <Image src="/finexo-html/images/hero-bg1.png" alt=""/>
      </div>
    </div>

    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="/">
            <span>
              Teh Boston
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/profile">Profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/kemitraan">Kemitraan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/cabang">Cabang</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/kontak">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <div id="popup" class="popup">
                  <h6>Anda harus login terlebih dahulu untuk mendaftar sebagai mitra.</h6>
                  <button onclick="closePopup()">Tutup</button>
                  <button onclick="location.href='/login'">Login</button>
                </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
<section class="slider_section">
  <div id="customCarousel1" class="carousel slide" data-ride="carousel" data-interval="5000">
    <div class="carousel-inner">
      
      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="container">
          <div class="row">
            
            <div class="col-md-6">
              <div class="detail-box">
              <h1>
                  Tentang <br>
                  Kami
                </h1>
                <p>
                  Teh Boston menjual produk minuman dengan olahan utama yaitu teh yang berasal dari 
                  teh berkualitas yang diolah oleh profesional menjadi minuman segar yang dapat menghilangkan haus dan panas, 
                  ditambah dengan varian rasa yang melimpah dan menyegarkan. 
                </p>
                <div class="btn-box">
                  <button onclick="showPopup()" class="btn1">Daftar Mitra</button>
                </div>

                <div id="overlay" onclick="closePopup()"></div>
              </div>
            </div>
            <div class="col-md-6">
              <!-- Bisa ditambahkan gambar atau dibiarkan kosong -->
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="detail-box">
              <h1>
                  Mari <br>
                  Daftar Mitra
                </h1>
                <p>
                  Teh Boston merupakan salah satu franchise minuman yang sudah berada di kota Subang sejak tahun 2023, teh boston sudah memiliki 
                  lebih dari 3 cabang dan 7 franchise yang tersebar luas di Subang, 
                  sebagian besar pendaftar merasa puas dengan franchise kami mari bergabung dengan kami.
                </p>
                <div class="btn-box">
                  <button onclick="showPopup()" class="btn1">Daftar Mitra</button>
                </div>

                <div id="overlay" onclick="closePopup()"></div>
                <div id="popup" class="popup">
                  <h6>Anda harus login terlebih dahulu untuk mendaftar sebagai mitra.</h6>
                  <button onclick="closePopup()">Tutup</button>
                  <button onclick="location.href='/login'">Login</button>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <!-- Kosong -->
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="detail-box">
                <h1>
                  Teh <br>
                  Boston
                </h1>
                <p>
                  Teh Boston merupakan salah satu franchise yang berada di kota Subang, teh boston sudah memiliki lebih dari 10 cabang di Subang, mari bergabung dengan kami.
                </p>
                <div class="btn-box">
                  <button onclick="showPopup()" class="btn1">Daftar Mitra</button>
                </div>

                <div id="overlay" onclick="closePopup()"></div>
                <div id="popup" class="popup">
                  <h6>Anda harus login terlebih dahulu untuk mendaftar sebagai mitra.</h6>
                  <button onclick="closePopup()">Tutup</button>
                  <button onclick="location.href='/login'">Login</button>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <!-- Kosong -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Carousel indicators -->
    <ol class="carousel-indicators">
      <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
      <li data-target="#customCarousel1" data-slide-to="1"></li>
      <li data-target="#customCarousel1" data-slide-to="2"></li>
    </ol>
  </div>
</section>
<!-- end slider section -->
  </div>


  <section class="service_section layout_padding fade-up">
  <div class="service_container">
    <div class="container ">
      <div class="heading_container heading_center fade-up">
        <h2>
          Best <span>Seller</span>
        </h2>
        <p>
          Kami memiliki produk dengan varian rasa best seller di semua outlet.
        </p>
      </div>
      <div class="row">
        <div class="col-md-4 fade-up">
          <div class="box ">
            <div class="img-box">
              <img src="/finexo-html/images/bestsell1.jpg" alt="" width="100%" />
            </div>
            <div class="detail-box">
              <h5>Yakult Lecy</h5>
            </div>
          </div>
        </div>
        <div class="col-md-4 fade-up">
          <div class="box ">
            <div class="img-box">
              <img src="/finexo-html/images/bestsell1.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>Yakult Strawberry</h5>
            </div>
          </div>
        </div>
        <div class="col-md-4 fade-up">
          <div class="box ">
            <div class="img-box">
              <img src="/finexo-html/images/bestsell1.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>Yakult Melon</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-box fade-up">
        <a href="/menu">Varian Lainnya</a>
      </div>
    </div>
  </div>
</section>

<section class="client_section layout_padding fade-up">
  <div class="container">
    <div class="heading_container heading_center psudo_white_primary mb_45 fade-up">
      <h2>Apa Kata <span>Pelanggan?</span></h2>
    </div>
    <div class="carousel-wrap">
      <div class="owl-carousel client_owl-carousel">
        @foreach ([1,2,3,4] as $i)
        <div class="item fade-up">
          <div class="box">
            <div class="img-box">
              <img src="/images/client{{ $i % 2 == 0 ? '2' : '1' }}.jpg" alt="" class="box-img">
            </div>
            <div class="detail-box">
              <div class="client_id">
                <div class="client_info">
                  <h6>{{ $i % 2 == 0 ? 'Zen Court' : 'Asep' }}</h6>
                  <p>magna aliqua. Ut</p>
                </div>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
              </p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>




@include('layouts.footerindex')

  <script>
        function showPopup() {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        
    </script>

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