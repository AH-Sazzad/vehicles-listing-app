<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AutoElite — All Vehicles</title>
  <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/css/sidebaa.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/home.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/singelcar.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/massage.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/favorite.css') }}">
</head>
<body>

<!-- ═══ SIDEBAR ═══ -->
<aside class="sidebar">
  <a href="{{ route('home') }}" class="logo text-decoration-none">
    <div class="logo-name">AutoElite</div>
    <div class="logo-tag">Premium Vehicles</div>
  </a>
  <div class="nav-section">
    <div class="nav-group-label">Marketplace</div>
    <div class="nav-link-item"><a href="{{ route('home') }}"><i class="bi bi-grid-1x2-fill"></i> All Vehicles</a></div>
    
    <div class="nav-link-item"><a href="{{ route('favorite') }}"><i class="bi bi-heart-fill"></i> Favorites</a></div>
    <div class="nav-group-label">Dealer Panel</div>
    <div class="nav-link-item"><a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></div>
    <div class="nav-link-item"><a href="{{ route('my_cars') }}"><i class="bi bi-car-front-fill"></i> My Vehicles</a></div>
    <div class="nav-link-item"><a href="{{ route('massages') }}"><i class="bi bi-chat-dots-fill"></i> Messages </a></div>
    <div class="nav-group-label">Account</div>
    <div class="nav-link-item"><a href="#"><i class="bi bi-person-fill"></i> My Profile</a></div>
    <div class="nav-link-item"><a href="#"><i class="bi bi-gear-fill"></i> Settings</a></div>
    <div class="nav-link-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right"></i> Logout</a></div>
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  <div class="sidebar-footer">
    <div class="av">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
    <div>
      <div class="av-name">{{ auth()->user()->name }}</div>
      <div class="av-role">{{ auth()->user()->role }}</div>
    </div>
  </div>
</aside>

<!-- ═══ MAIN ═══ -->
<div class="main">

  <!-- TOPBAR -->
  
    @yield('topbar')
  

  <!-- FILTER BAR -->
  
    @yield('filterbar')
  

    <!-- CONTENT -->
    
      @yield('content')
    
    {{-- pagination --}}
    @yield('pagination')
</div><!-- /main -->

<script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>