<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kosmetiskā laboratorija: @yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* Noņem underline, noklusējuma krāsa balta ar caurspīdību */

    .navbar-brand {
      /* Rozā krāsa */
      color: #ff69b4 !important;
      /* Roboto fonts */
      font-family: 'Roboto', sans-serif;
      font-weight: 700;    /* treknāks variants, lai izceltos */
      font-size: 1.5rem;
    }

    .btn-pink {
    background-color: #e83e8c;
    color: #fff;
    border-color: #e83e8c;
  }
  .btn-pink:hover {
    background-color: #d63384;
    border-color: #d63384;
  }

    .navbar-nav .nav-link,
    .navbar-nav .dropdown-item {
      color: rgba(255,255,255,0.75) !important;
      text-decoration: none !important;
    }
    /* Hover stāvoklis */
    .navbar-nav .nav-link:hover,
    .navbar-nav .dropdown-item:hover {
      color: #fff !important;
      background-color: rgba(255,255,255,0.1) !important;
      border-radius: 0.25rem;
    }
    /* Aktīvais stāvoklis */
    .navbar-nav .nav-link.active,
    .navbar-nav .dropdown-item.active {
      color: #fff !important;
      background-color: rgba(255,255,255,0.2) !important;
    }
  </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="{{ route('index') }}">
      <i class="bi bi-house-fill me-2"></i> {{ __('Kosmētiskā laboratorija') }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
            aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        {{-- Visi produkti --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">
            {{ __('Visi produkti')}}
          </a>
        </li>
        

        {{-- Produktu kategorijas dropdown --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle @if(Route::is('categories.*') || Route::is('category')) active @endif"
             href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             {{ __('Produktu kategorijas')}}
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="categoriesDropdown">
            {{--  Visas kategorijas  --}}
            <li>
              <a class="dropdown-item @if(Route::currentRouteNamed('categories.index')) active @endif"
                 href="{{ route('categories') }}">
                 {{ __('Visas kategorijas')}}
              </a>
            </li>
        
            {{-- Dinamiskie ieraksti no DB --}}
            @foreach($categories as $cat)
  <li>
    <a class="dropdown-item
         @if(request()->routeIs('category') && request()->route('category') === $cat->code) active @endif"
       href="{{ route('category', $cat->code) }}">
       {{ __($cat->name) }}
    </a>
  </li>
@endforeach

          </ul>
        </li>
        
        {{-- Grozs --}}
        <li class="nav-item">
          <a class="nav-link @if(Route::currentRouteNamed('basket')) active @endif"
             href="{{ route('basket') }}">
            {{ __('Grozs')}}
          </a>
        </li>

      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Ieiet')}}</a>
          </li>
        @endguest

        @auth
        @if(Auth::user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">{{ __('Administratora panelis')}}</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('person.orders.index') }}">{{ __('Mani pasūtījumi')}}</a>
        </li>

        @endif
         
          <li class="nav-item">
            <a class="nav-link" href="{{ route('get-logout') }}">{{ __('Iziet')}}</a>
          </li>
        @endauth
      </ul>
      <ul class="navbar-nav ms-3">
        <li class="nav-item">
          <a class="nav-link text-white px-2" href="{{ route('lang.switch', ['locale' => 'lv']) }}">Latviešu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white px-2" href="{{ route('lang.switch', ['locale' => 'en']) }}">English</a>
        </li>
      </ul>
      


    

      <form class="d-flex ms-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Meklēt">
        <button class="btn btn-outline-light" type="submit">{{ __('Meklēt')}}</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-4">
  @if(session()->has('success'))
    <div class="alert alert-success text-center mx-auto w-50">
      {{ session('success') }}
    </div>
  @endif
  @if(session()->has('warning'))
    <div class="alert alert-warning text-center mx-auto w-50">
      {{ session('warning') }}
    </div>
  @endif

  @yield('content')
</div>
<footer class="bg-dark text-white py-3">
  <div class="container d-flex justify-content-between align-items-center flex-wrap" style="font-size: 0.85rem;">

      <!-- Kontaktinformācija centrā ar rozā virsrakstu -->
      <div class="text-center mx-auto">
          <p class="mb-1" style="color: #e83e8c; font-size: 1.1rem; font-weight: bold;">Kosmētiskā laboratorija</p>
          <p class="mb-1">Rīga, Lāčplēša iela 101, LV-1103</p>
          <p class="mb-1">Tālrunis: <a href="tel:+37128988975" class="text-white text-decoration-none">+371 28988975</a></p>
          <p class="mb-0">E-pasts: <a href="mailto:kosmetika@gmail.com" class="text-white text-decoration-none">kosmetika@gmail.com</a></p>
      </div>

      <!-- Instagram ikona pa labi, vertikāli vidū -->
      <div class="d-flex flex-column align-items-center ms-3">
          <a href="https://www.instagram.com/formulators_hub_kenya/" target="_blank" rel="noopener noreferrer" class="text-white fs-4">
              <i class="fab fa-instagram"></i>
          </a>
          <small style="font-size: 0.75rem;">Seko mums</small>
      </div>

  </div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
