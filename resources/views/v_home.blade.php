@extends('layouts.template')

@section('home')

<style>
  .category-nav {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 40px;
  }

  .category-nav a {
    position: relative;
    font-weight: bold;
    text-decoration: none;
    color: #000;
    padding-bottom: 5px;
    transition: all 0.3s ease;
  }

  .category-nav a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 2px;
    width: 0%;
    background-color: rgb(29, 95, 69);
    transition: width 0.3s;
  }

  .category-nav a.active::after {
    width: 100%;
  }

  .category-section {
    display: none;
  }

  .category-section.active {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  /* === Kartu Kategori === */
  .category-card {
    width: 300px; /* atur lebar tetap */
    height: 230px; /* tinggi tetap */
    margin: 15px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease, filter 0.3s ease;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
  }

  .category-card-image {
    height: 220px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
  }

  .category-card img {
    height: 100%;
    width: auto;
    object-fit: contain;
    transition: transform 0.3s ease;
  }

  .category-card-title {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .category-card-title h5 {
    margin: 0;
    font-size: 1rem;
    color: #333;
  }

  /* === Hover Effects dari Gambar === */
  .card:hover .card-background {
    transform: scale(1.15) translateZ(0);
    background-size: 20px;
  }

  .card-grid:hover > .card:not(:hover) {
    transform: scale(0.9);
  }

  .card-grid:hover > .card:not(:hover) .card-background,
  .card-grid:hover > .card:not(:hover) .card-category {
    filter: brightness(0.5) saturate(0) contrast(1.2) ;
  }
</style>

    <!-- end header section -->
<!-- slider section -->
     @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
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
                  <a href="/daftarmitra" class="btn1">Tentang Kami</a>
                </div>
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
                  <a href="/daftarmitra" class="btn1">Daftar Mitra</a>
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
                  Kenapa <br>
                  Kami?
                </h1>
                <p>
                  Teh Boston merupakan salah satu franchise yang berada di kota Subang, teh boston sudah memiliki lebih dari 10 cabang di Subang, mari bergabung dengan kami.
                </p>
                <div class="btn-box">
                  <a href="/daftarmitra" class="btn1">Daftar Mitra</a>
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


   <!-- Carousel indicators -->
   <ol class="carousel-indicators">
      <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
      <li data-target="#customCarousel1" data-slide-to="1"></li>
      <li data-target="#customCarousel1" data-slide-to="2"></li>
    </ol>
  </div>
</section>

<div class="heading_container heading_center fade-up">
        <h2>Produk <span>Kami</span></h2>
        <!-- <p>Kami memiliki produk dengan varian rasa best seller di semua outlet.</p> -->
      </div>

<!-- end slider section -->
  </div>

  <div class="category-nav">
  <a href="#" class="category-link active" data-category="tea">Tea Series</a>
  <a href="#" class="category-link" data-category="yakult">Yakult Series</a>
  <a href="#" class="category-link" data-category="coffee">Coffee Series</a>
  <a href="#" class="category-link" data-category="blend">Blend Series</a>
</div>

<section class="service_section layout_padding fade-up">
  <div class="service_container">
    <div class="container">

      <!-- Tea Series -->
      <div class="card-grid category-section active" id="category-tea">
        @for($i = 1; $i <= 5; $i++)
          <div class="col-md-4 fade-up card" style="margin-bottom: 30px;">
            <div class="category-card card-background">
              <div class="category-card-image">
                <img src="/finexo-html/images/bestsell1.png" alt="Tea Produk {{ $i }}">
              </div>
              <div class="category-card-title card-category">
                <h5>Tea Produk {{ $i }}</h5>
              </div>
            </div>
          </div>
        @endfor
      </div>

      <!-- Yakult Series -->
      <div class="card-grid category-section" id="category-yakult">
        @for($i = 6; $i <= 10; $i++)
          <div class="col-md-4 fade-up card" style="margin-bottom: 30px;">
            <div class="category-card card-background">
              <div class="category-card-image">
                <img src="/finexo-html/images/bestsell1.png" alt="Yakult Produk {{ $i }}">
              </div>
              <div class="category-card-title card-category">
                <h5>Yakult Produk {{ $i }}</h5>
              </div>
            </div>
          </div>
        @endfor
      </div>

      <!-- Coffee Series -->
      <div class="card-grid category-section" id="category-coffee">
        @for($i = 11; $i <= 15; $i++)
          <div class="col-md-4 fade-up card" style="margin-bottom: 30px;">
            <div class="category-card card-background">
              <div class="category-card-image">
                <img src="/finexo-html/images/bestsell1.png" alt="Coffee Produk {{ $i }}">
              </div>
              <div class="category-card-title card-category">
                <h5>Coffee Produk {{ $i }}</h5>
              </div>
            </div>
          </div>
        @endfor
      </div>

      <!-- Blend Series -->
      <div class="card-grid category-section" id="category-blend">
        @for($i = 16; $i <= 20; $i++)
          <div class="col-md-4 fade-up card" style="margin-bottom: 30px;">
            <div class="category-card card-background">
              <div class="category-card-image">
                <img src="/finexo-html/images/bestsell1.png" alt="Blend Produk {{ $i }}">
              </div>
              <div class="category-card-title card-category">
                <h5>Blend Produk {{ $i }}</h5>
              </div>
            </div>
          </div>
        @endfor
      </div>

    </div>
  </div>
</section>
 
  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center psudo_white_primary mb_45">
        <h2>
          Apa Kata <span>Pelanggan?</span>
        </h2>
      </div>
      <div class="carousel-wrap ">
        <div class="owl-carousel client_owl-carousel">
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="images/client1.jpg" alt="" class="box-img">
              </div>
              <div class="detail-box">
                <div class="client_id">
                  <div class="client_info">
                    <h6>
                      Asep
                    </h6>
                    <p>
                      magna aliqua. Ut
                    </p>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis </p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="images/client2.jpg" alt="" class="box-img">
              </div>
              <div class="detail-box">
                <div class="client_id">
                  <div class="client_info">
                    <h6>
                      Zen Court
                    </h6>
                    <p>
                      magna aliqua. Ut
                    </p>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis </p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="images/client1.jpg" alt="" class="box-img">
              </div>
              <div class="detail-box">
                <div class="client_id">
                  <div class="client_info">
                    <h6>
                      LusDen
                    </h6>
                    <p>
                      magna aliqua. Ut
                    </p>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis </p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="images/client2.jpg" alt="" class="box-img">
              </div>
              <div class="detail-box">
                <div class="client_id">
                  <div class="client_info">
                    <h6>
                      Zen Court
                    </h6>
                    <p>
                      magna aliqua. Ut
                    </p>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end client section -->

@include('layouts.footer')


    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
    <script>
      $("#displayNotif").on("click", function () {
        var placementFrom = $("#notify_placement_from option:selected").val();
        var placementAlign = $("#notify_placement_align option:selected").val();
        var state = $("#notify_state option:selected").val();
        var style = $("#notify_style option:selected").val();
        var content = {};

        content.message =
          'Turning standard Bootstrap alerts into "notify" like notifications';
        content.title = "Bootstrap notify";
        if (style == "withicon") {
          content.icon = "fa fa-bell";
        } else {
          content.icon = "none";
        }
        content.url = "index.html";
        content.target = "_blank";

        $.notify(content, {
          type: state,
          placement: {
            from: placementFrom,
            align: placementAlign,
          },
          time: 1000,
        });
      });

  function handleScrollAnimation() {
    const elements = document.querySelectorAll('.fade-up');
    elements.forEach(el => {
      const rect = el.getBoundingClientRect();
      const inView = rect.top < window.innerHeight - 50 && rect.bottom > 0;

      if (inView) {
        el.classList.add('fade-up-visible');
      } else {
        el.classList.remove('fade-up-visible'); // Ini penting agar animasi bisa diulang saat scroll lagi
      }
    });
  }

  window.addEventListener('scroll', handleScrollAnimation);
  window.addEventListener('load', handleScrollAnimation);
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const categoryLinks = document.querySelectorAll('.category-link');
    const categorySections = document.querySelectorAll('.category-section');

    categoryLinks.forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();

        // Hapus kelas aktif dari semua link
        categoryLinks.forEach(link => link.classList.remove('active'));

        // Tambahkan kelas aktif ke link yang diklik
        this.classList.add('active');

        // Ambil kategori dari data attribute
        const category = this.getAttribute('data-category');

        // Tampilkan hanya kategori yang sesuai
        categorySections.forEach(section => {
          if (section.id === 'category-' + category) {
            section.classList.add('active');
          } else {
            section.classList.remove('active');
          }
        });
      });
    });
  });
</script>

</body>

@endsection