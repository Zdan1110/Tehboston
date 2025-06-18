

<!-- File: resources/views/partials/nav.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm py-3"
     style="min-height: 10px;">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 text-primary d-flex align-items-center" href="/">
    <img src="{{ asset('gambar/logo.png') }}" alt="Logo" style="height: 70px; width: auto; margin-right: 10px;">
    <span><i class="fas fa-leaf me-1"></i>Teh <span class="text-warning">Boston</span></span>
    </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profilee') ? 'active' : '' }}" href="/profilee">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kemitraann') ? 'active' : '' }}" href="/kemitraann">Kemitraan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('cabangg') ? 'active' : '' }}" href="/cabangg">Cabang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kontaks') ? 'active' : '' }}" href="/kontaks">Kontak</a>
                </li>
                <li class="nav-item dropdown ms-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <div class="avatar bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <span class="ms-2">
                            <strong>{{ Session::get('user')['username'] ?? 'Guest' }}</strong>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2">
                        <li><a class="dropdown-item d-flex align-items-center py-2" href="/profiles"><i class="fas fa-user me-2"></i>Data Diri</a></li>
                        <li><a class="dropdown-item d-flex align-items-center py-2" href="/franchisee"><i class="fas fa-store me-2"></i>Franchisee</a></li>
                        <li><a class="dropdown-item d-flex align-items-center py-2" href="/login"><i class="fas fa-cash-register me-2"></i>Kasir</a></li>
                        <li><a class="dropdown-item d-flex align-items-center py-2" href="/status"><i class="fas fa-clipboard-list me-2"></i>Status Pendaftaran</a></li>
                        <li><hr class="dropdown-divider my-2"></li>
                        <li><a class="dropdown-item d-flex align-items-center py-2" href="/settingakun"><i class="fas fa-cog me-2"></i>Account Setting</a></li>
                        <li><hr class="dropdown-divider my-2"></li>
                        <li><a class="dropdown-item d-flex align-items-center py-2" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>