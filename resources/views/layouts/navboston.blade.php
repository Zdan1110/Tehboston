
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="/">
            <span>
              Teh Boston
            </span>
            <div class="ml-auto">
                @if(Session::has('user'))
                    <p class="d-inline">Halo, {{ Session::get('user')['username'] }}!</p>
                    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endif
            </div>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/profile">Profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="service.html">Kemitraan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="why.html">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="team.html">Contact</a>
              </li>
              <form class="form-inline">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
            </ul>
          </div>
        </nav>
      </div>


      </body>
</html>