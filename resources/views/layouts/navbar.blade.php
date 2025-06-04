@php
    use Illuminate\Support\Facades\DB;

    $id_akun = Session::get('user')['id_akun'] ?? null;
    $calonmitra = [];

    if ($id_akun) {
        $calonmitra = DB::table('tb_calonmitra')
                        ->where('id_akun', $id_akun)
                        ->get();
    }
@endphp

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
          <li class="nav-item {{ request()->is('Contact') ? 'active' : '' }}">
            <a class="nav-link" href="/kontaks">Contact</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" role="button">
              <button class="btn nav_search-btn" type="button" id="userIcon">
                <i class="fa fa-user" aria-hidden="true"></i>
              </button>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
              <li>
                <div class="user-box px-3 py-2">
                  <div class="u-text mb-1">
                    <h6 class="mb-1"><strong>{{ Session::get('user')['username'] ?? 'Guest' }}</strong></h6>
                  </div>
                </div>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/profiles">Data Diri</a></li>
              <li><a class="dropdown-item" href="/franchisee">Franchisee</a></li>
              <li><a class="dropdown-item" href="/login">Kasir</a></li>
              <li><a class="dropdown-item" href="/status">Status Pendaftaran</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/settingakun">Account Setting</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>
