<nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config("app.name", "Laravel") }}
    </a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav">
          <li><a href="/blogs" class="nav-link mr-auto">Blog</a></li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
        <li><a href="/dashboard" class="nav-link">Dashboard</a></li>
        <li class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
          </button>
          <span class="caret"></span>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
              >
                Logout
              </a>
              <form
                id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display: none;"
              >
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>