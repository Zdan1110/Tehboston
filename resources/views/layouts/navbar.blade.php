<header class="header_section">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="/">
        <span>Teh Boston</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class=""> </span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
            <a class="nav-link" href="/home">Home</a>
          </li>
          <li class="nav-item {{ request()->is('profilee') ? 'active' : '' }}">
            <a class="nav-link" href="/profilee">Profil</a>
          </li>
          <li class="nav-item {{ request()->is('kemitraann') ? 'active' : '' }}">
            <a class="nav-link" href="/kemitraann">Kemitraan</a>
          </li>
          <li class="nav-item {{ request()->is('Cabang') ? 'active' : '' }}">
            <a class="nav-link" href="/cabangg">Cabang</a>
          </li>
          <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
            <a class="nav-link" href="/kontaks">Contact</a>
          </li>
          <li class="nav-item dropdown">
            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#">
              <button class="btn nav_search-btn" type="button" id="userIcon">
                <i class="fa fa-user" aria-hidden="true"></i>
              </button>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
              <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                  <div class="user-box">
                    <div class="u-text">
                      <h4><strong>{{ Session::get('user')['username'] ?? 'Guest' }}</strong></h4>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/profiles">Data Diri</a>
                  <a class="dropdown-item" href="/franchisee">Franchisee</a>
                  <a class="dropdown-item" href="/login">Kasir</a>
                  <a class="dropdown-item" href="/status">Status  Pendaftaran</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/settingakun">Account Setting</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </li>
              </div>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  @if(session('success') && isset($data))
    <div class="p-4 bg-green-100 rounded mb-4">
        <p>{{ session('success') }}</p>
        <p><strong>ID Calon Mitra:</strong> {{ $data->id_calon }}</p>
        <p><strong>Scan QR untuk cek status:</strong></p>
        <img src="{{ asset('uploads/qrcode/' . $data->qr_code) }}" class="w-48 h-48 my-2" alt="QR Code">
        <a href="{{ asset('uploads/qrcode/' . $data->qr_code) }}" download="{{ $data->id_calon }}.png"
           class="text-teal-700 underline">
            ⬇️ Download QR Code
        </a>
    </div>
@endif
</header>