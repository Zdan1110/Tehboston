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
        /* Animasi masuk dari bawah */
        @keyframes fadeInUp {
          from {
            opacity: 0;
            transform: translateY(20px);
          }
          to {
            opacity: 1;
            transform: translateY(0);
          }
        }

        .fade-up {
          opacity: 0;
          transform: translateY(20px);
          animation: fadeInUp 1s forwards;
        }

        .fade-up-visible {
          opacity: 1;
          transform: translateY(0);
        }

        .container {
            text-align: left;
            padding: 20px;
        }

        .heading {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        h3 {
            font-size: 1.5rem;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }
            .heading {
            text-align: center;
            color:rgb(53, 57, 35);
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

        .heading {
    font-size: 2rem;
    text-align: center;
    color: rgb(53, 57, 35);
    margin-bottom: 20px;
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
    @include('layouts.navbarindex')
    <!-- end header section -->
  </div>

<div class="container">
  <h2 class="heading fw-bold fade-up">VISI MISI</h2>

  <h3 class="fade-up">VISI</h3>
  <p class="fade-up">"MENJADI SALAH SATU PRODUK MINUMAN TEH TERBAIK DAN MEMILIKI BANYAK SERTIFIKAT PENGHARGAAN DI INDONESIA"</p>

  <h3 class="fade-up">MISI</h3>
  <div class="mission-item fade-up"><i class="fas fa-chart-line"></i> Mendukung Orang Yang Punya Keinginan Untuk Usaha</div>
  <div class="mission-item fade-up"><i class="fas fa-leaf"></i> Membuat Olahan Daun Teh Berkualitas Dengan Konsisten</div>
  <div class="mission-item fade-up"><i class="fas fa-coins"></i> Menjadikan Wadah Untuk Menopang Ekonomi Masyarakat</div>
</div>




  <!-- about section -->

  <section class="about_section layout_padding"> 
  <div class="container">
    <div class="heading_container heading_center">
     
    </div>
  </div>


      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <h3>
              Sejarah Teh Boston
            </h3>
            <p>
              Teh Boston adalah brand minuman teh yang berdiri sejak tahun 2023 di Subang. 
              Dalam waktu satu tahun, kami telah membuka lebih dari 10 cabang dan dipercaya oleh banyak 
              pelanggan karena kualitas rasa dan pelayanan kami.
            </p>
            <p>
            Kami menggunakan teh berkualitas tinggi yang diolah secara profesional, menghadirkan rasa yang segar dan menyegarkan. 
              Teh Boston memiliki beragam varian rasa, kemasan modern, harga terjangkau, dan selalu menjaga kebersihan serta 
              kepuasan pelanggan.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->
  @include('layouts.footerindex')

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

  function handleScrollAnimation() {
  document.querySelectorAll('.fade-up').forEach(el => {
    const rect = el.getBoundingClientRect();
    const inView = rect.top < window.innerHeight - 50 && rect.bottom > 0;
    if (inView) {
      el.classList.add('fade-up-visible');
    } else {
      el.classList.remove('fade-up-visible'); // Bisa membuat elemen muncul lagi saat scroll balik
    }
  });
}

// Trigger saat scroll dan saat halaman dimuat
window.addEventListener('scroll', handleScrollAnimation);
window.addEventListener('load', handleScrollAnimation);

</script>


</body>

</html>