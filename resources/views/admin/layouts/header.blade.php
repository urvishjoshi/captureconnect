  <!-- Navbar -->
  @section('session','Admin')
  <nav class="main-header navbar navbar-expand navbar-black navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    {{-- <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">

      <!-- Authentication Links -->
      @guest
      @if(isset($url))
      @if($url != 'admin')
      <li class="nav-item">
        <a class="nav-link" href="{{ url("$url/login") }}">{{ __('Login') }}</a>
      </li>
      @endif
      @if (Route::has('register') && $url != 'admin')
      <li class="nav-item">
        <a class="nav-link" href="{{ url("$url/register") }}">{{ __('Register') }}</a>
      </li>
      @endif
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route("login") }}">{{ __('Login') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route("register") }}">{{ __('Register') }}</a>
      </li>
      @endif
      @else
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ ucwords(Auth::user()->name) }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('a.personal.index') }}"> <i class="fa fa-user" style="font-size:15px;"></i>
            <span class=pl-2>My profile</span>
          </a>

          <a class="dropdown-item" href="{{ url("admin/settings") }}"> <i class="material-icons" style="font-size:15px;">settings</i>
            <span class=pl-2>Settings</span>
          </a>

          <a class="dropdown-item" href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>
             <span class=pl-2>Logout</a></span>
  
          <form id="logout-form" action="{{ url("admin/logout") }}" method="POST" style="display: none;">
            @csrf
          </form>



        </div>
      </li>
      @endguest

    </ul>
  </nav>
  <!-- /.navbar -->