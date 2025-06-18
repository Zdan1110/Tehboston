@extends('layouts.app')

@section('title', 'Home - Teh Boston')

@section('content')

<!-- HERO -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content" data-aos="fade-right">
                    <h1 class="hero-title">Minuman Teh Berkualitas dengan Varian Rasa Unik</h1>
                    <p class="hero-subtitle">Teh Boston menawarkan pengalaman minum teh yang berbeda dengan bahan premium dan racikan spesial. Bergabunglah dengan jaringan franchise kami untuk peluang bisnis yang menguntungkan.</p>
                    <div class="d-flex">
                        <a href="#" id="btn-daftar-mitra" class="btn btn-primary me-3">Gabung Mitra</a>
                        <a href="#produk" class="btn btn-primary me-3">Lihat Produk</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="gambar/figur.png" alt="Teh Boston" class="hero-image">
            </div>
        </div>
    </div>
</section>

<!-- PRODUK -->
<section id="produk" class="section py-5">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Produk Series Kami</h2>
        <div class="row g-4">
            @php
                $produkList = [
                    ['img' => 'teaseries.png', 'title' => 'Tea Series', 'desc' => '8 varian minuman teh klasik dan modern dengan rasa autentik.'],
                    ['img' => 'yakultseries.png', 'title' => 'Yakult Series', 'desc' => '8 kombinasi yakult dan buah segar untuk kesegaran maksimal.'],
                    ['img' => 'coffeeseries.png', 'title' => 'Coffee Series', 'desc' => '8 varian kopi dengan sentuhan unik dan cita rasa premium.'],
                    ['img' => 'blend.png', 'title' => 'Blend Series', 'desc' => '8 racikan khusus teh dan bahan premium untuk pengalaman berbeda.'],
                ];
            @endphp

            @foreach ($produkList as $i => $produk)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ 100 * ($i + 1) }}">
                <div class="category-card">
                    <img src="gambar/{{ $produk['img'] }}" class="card-img-top" alt="{{ $produk['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produk['title'] }}</h5>
                        <p class="card-text">{{ $produk['desc'] }}</p>
                        <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#menuModal">Lihat Produk</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Menu -->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="menuModalLabel">Menu Produk</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="gambar/Menu.png" alt="Menu Produk" class="img-fluid rounded shadow mb-4">
                    <a href="gambar/Menu.pdf" class="btn btn-primary" download>
                        <i class="bi bi-download me-2"></i>Download Menu PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONI -->
<section class="testimonial-section py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-4" data-aos="fade-up">Apa Kata Pelanggan Kami</h2>

        <div class="swiper testimonial-swiper" data-aos="fade-up">
            <div class="swiper-wrapper">
                @php
                    $testimonials = [
                        ['nama' => 'Rina', 'bintang' => 5, 'ulasan' => 'Rasa tehnya enak banget! Seger dan ga bikin eneg.'],
                        ['nama' => 'Andi', 'bintang' => 4, 'ulasan' => 'Konsep booth-nya keren dan bersih.'],
                        ['nama' => 'Dewi', 'bintang' => 5, 'ulasan' => 'Paket franchise-nya lengkap dan mudah dijalankan.'],
                        ['nama' => 'Budi', 'bintang' => 3, 'ulasan' => 'Tehnya enak, cuma pelayanannya agak lama.'],
                        ['nama' => 'Sarah', 'bintang' => 5, 'ulasan' => 'Favoritku teh yakult rasa stroberi!'],
                        ['nama' => 'Yoga', 'bintang' => 4, 'ulasan' => 'Harga produk terjangkau, cocok buat mahasiswa.'],
                        ['nama' => 'Ayu', 'bintang' => 5, 'ulasan' => 'Brand lokal yang rasa dan kualitasnya internasional.'],
                        ['nama' => 'Riko', 'bintang' => 4, 'ulasan' => 'Cocok banget buat usaha sampingan. Modalnya kecil.'],
                    ];
                @endphp

                @foreach ($testimonials as $t)
                <div class="swiper-slide">
                    <div class="card shadow-sm p-4 h-100 border-0">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('gambar/user.png') }}" alt="user" width="50" class="me-3 rounded-circle">
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $t['nama'] }}</h6>
                                <div class="text-warning">
                                    @for ($i = 0; $i < $t['bintang']; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for ($i = $t['bintang']; $i < 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="mb-0 fst-italic">{{ $t['ulasan'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btnDaftar = document.getElementById('btn-daftar-mitra');

        btnDaftar?.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Login Dulu!',
                text: 'Anda harus login terlebih dahulu untuk mendaftar sebagai mitra.',
                confirmButtonText: 'Login Sekarang',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/login";
                }
            });
        });

        new Swiper('.testimonial-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            breakpoints: {
                576: { slidesPerView: 2 },
                992: { slidesPerView: 3 }
            }
        });
    });
</script>

@endsection
