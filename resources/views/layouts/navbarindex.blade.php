<header class="header_section">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="/">
          <img src="{{ asset('finexo-html/images/LOGOBOSTON.png') }}" alt="Teh Boston Logo" style="height: 100px; max-height: 100%; width: auto;">
      </a>


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
            <a class="nav-link" href="/profile">Profil</a>
          </li>
          <li class="nav-item {{ request()->is('kemitraan') ? 'active' : '' }}">
            <a class="nav-link" href="/kemitraan">Kemitraan</a>
          </li>
          <li class="nav-item {{ request()->is('cabang') ? 'active' : '' }}">
            <a class="nav-link" href="/cabang">Cabang</a>
          </li>
          <li class="nav-item {{ request()->is('team') ? 'active' : '' }}">
            <a class="nav-link" href="/kontak">Contact</a>
          </li>
          <li class="nav-item {{ request()->is('login') ? 'active' : '' }}">
            <a class="nav-link" href="/login">Login</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>
