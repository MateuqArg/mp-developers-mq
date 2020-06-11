<div class="overlay"></div>

<div class="utility-nav d-none d-md-block">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <p class="small">
          <span class="material-icons info-icon">email</span> email@example.com | 
          <span class="material-icons info-icon">phone</span> +91-9876543210
        </p>
      </div>

      <div class="col-12 col-md-6 text-right">
        <p class="small">Envio gratis a partir de los $2000</p>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-md navbar-light bg-light main-menu" style="box-shadow:none">
  <div class="container">

    <button type="button" id="sidebarCollapse" class="btn principal-color btn-link d-block d-md-none">
      <span class="material-icons info-icon" style="font-size: 30px;">menu</span>
    </button>

    <a class="navbar-brand" href="{{ url('/') }}">
      <h4 class="font-weight-bold title">Ecommerce</h4>
{{--       <h4 class="font-weight-bold d-block d-sm-none">E</h4>
 --}}    
    </a>

    <ul class="navbar-nav ml-auto d-block d-md-none">
      <li class="nav-item
      {{ (request()->is('/carrito')) ? 'active' : '' }}">
        <a class="btn principal-color btn-link" href="#"><span  style="font-size: 30px;" class="material-icons info-icon">shopping_cart</span> <span  style="font-size: 15px;" class="badge badge-danger">3</span></a>
      </li>
    </ul>

    <div class="collapse navbar-collapse">
      <form class="form-inline my-2 my-lg-0 mx-auto">
        <input class="form-control" type="search" placeholder="Buscar producto, marca o categoria..." aria-label="Search">
        <button class="btn principal-btn my-2 my-sm-0" type="submit">  <span class="material-icons">
            search
          </span>
        </button>
      </form>

      <ul class="navbar-nav">
        <li class="nav-item
        {{ (request()->is('/carrito')) ? 'active' : '' }}">
          <a class="btn principal-color" href="{{ url('/carrito') }}"><span class="material-icons">shopping_cart</span> <span class="badge-cart badge badge-danger">{{ $count_cart }}</span></a>
      @if(!Auth::user())
        </li>
        <li class="nav-item ml-md-3">
          <a class="btn login-btn" type="button" data-toggle="modal" data-target="#register-modal">Registrate</a>
        </li>
        <li class="nav-item ml-md-3">
          <a class="btn login-btn" type="button" data-toggle="modal" data-target="#login-modal">Ingresá</a>
        </li>
      @elseif (Auth::user()->hasRole('admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle nav-dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Roles <span class="info-icon material-icons">keyboard_arrow_down</span>
          </a>
          <div class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
            @if(Str::startsWith(Request::url(), 'http://127.0.0.1:8000/admin'))
              <a class="dropdown-item" href="{{ url('/') }}">Usuario<a>
              <a class="dropdown-item active">Administrador</a>
            @elseif(!Str::startsWith(Request::url(), 'http://127.0.0.1:8000/admin'))
              <a class="dropdown-item active">Usuario</a>
              <a class="dropdown-item" href="{{ url('/admin') }}">Administrador</a>
            @endif
          </div>
        </li>
      @else
        <li class="nav-item ml-md-3">
          <a class="btn login-btn" href="">Usuario</a>
        </li>
      @endif
      @if(Auth::user())
        <li class="nav-item ml-md-3">
          <a class="nav-link" href="{{ url('/logout') }}">Salir</a>
        </li>
      @endif
      </ul>
    </div>

  </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light bg-light sub-menu">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item 
        {{ (request()->is('/')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/') }}">Inicio</a>
        </li>
        <li class="nav-item dropdown
        {{ (request()->is('categorias/*')) ? 'active' : '' }}">
          <a class="nav-link dropdown-toggle nav-dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorias <span class="info-icon material-icons">keyboard_arrow_down</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($categories as $category)
              <a class="dropdown-item" href="{{ url('/categorias/'.$category->slug) }}">{{ $category->name }}</a>
            @endforeach
          </div>
        </li>
        <li class="nav-item
        {{ (request()->is('/ayuda')) ? 'active' : '' }}">
          <a class="nav-link" href="#">Ayuda</a>
        </li>
        <li class="nav-item
        {{ (request()->is('/historial')) ? 'active' : '' }}">
          <a class="nav-link disabled" href="#">Historial</a>
        </li>
        <li class="nav-item
        {{ (request()->is('/pedidos')) ? 'active' : '' }}">
          <a class="nav-link" href="#">Mis pedidos</a>
        </li>
        <li class="nav-item
        {{ (request()->is('/contacto')) ? 'active' : '' }}">
          <a class="nav-link" href="#">Contacto</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="search-bar d-block d-md-none">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <form class="form-inline mb-3 mx-auto">
          <input class="form-control" type="search" placeholder="Buscar producto..." aria-label="Search">
          <button class="btn principal-btn" type="submit">
            <span class="material-icons">
              search
            </span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Sidebar -->
<nav id="sidebar">
  <div class="sidebar-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-10 pl-0">
          <a class="btn principal-btn" href="#">
            <span class="material-icons info-icon">
              account_circle
            </span>
            Ingresá
          </a>
        </div>

        <div class="col-2 text-left">
          <button type="button" id="sidebarCollapseX" class="btn btn-link">
            <span class="material-icons">
              close
            </span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <ul class="list-unstyled components links">
    <li class="active">
      <a href="#"><span class="info-icon material-icons">home</span> Inicio</a>
    </li>
    {{-- <li>
      <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="info-icon material-icons">category</span>
        Categorias
      </a>
      <ul class="collapse list-unstyled" id="pageSubmenu">
        <li>
          <a href="#">Delivery Information</a>
        </li>
        <li>
          <a href="#">Privacy Policy</a>
        </li>
        <li>
          <a href="#">Terms & Conditions</a>
        </li>
      </ul>
    </li> --}}
    <li>
      <a href="#"><span class="info-icon material-icons">help</span> Ayuda</a>
    </li>
    <li>
      <a href="#"><span class="info-icon material-icons">schedule</span> Historial</a>
    </li>
    <li>
      <a href="#"><span class="info-icon material-icons">call</span> Contacto</a>
    </li>
  </ul>

  <h6 class="text-uppercase mb-1">Categorias</h6>
  <ul class="list-unstyled components mb-3">
    @foreach($categories as $category)
    <li>
      <a href="{{ url('/categorias/'.$category->slug) }}">{{ $category->name }}</a>
    </li>
    @endforeach
  </ul>
</nav>

{{-- Modal --}}

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Iniciar sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    Recordarme
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Entrar
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="text-left w-100">
        Si todavia no sos miembro podes registrarte
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal --}}

{{-- Modal --}}

<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registrarte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Repetir contraseña</label>

            <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
              <button type="submit" class="btn btn-primary">
                Crear cuenta
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="text-left w-100">
        Si ya sos miembro podes ingresar
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal --}}