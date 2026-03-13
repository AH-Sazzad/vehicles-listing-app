@extends('layouts.app')
@section('topbar')
    <div class="topbar d-flex justify-content-between align-items-center">
        <div class="topbar-title">All Vehicles</div>
    <div class="search-wrap">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Search brand, model, year…">
    </div>
    <a href="{{ route('dashboard') }}" class="btn-primary-gold"><i class="bi bi-plus-lg"></i> New Listing</a>
    </div>
@endsection
@section('filterbar')
    <div class="filter-bar">
        <a href="#" class="f-pill active">All</a>
        <a href="#" class="f-pill">New</a>
        <a href="#" class="f-pill">Used</a>
        <a href="#" class="f-pill">Featured</a>
        <select class="f-select">
            <option>All Fuel Types</option>
            <option>Petrol</option>
            <option>Diesel</option>
            <option>Electric</option>
            <option>Hybrid</option>
        </select>
        <select class="f-select">
            <option>Transmission</option>
            <option>Manual</option>
            <option>Automatic</option>
        </select>
        <select class="f-select">
            <option>Body Type</option>
            <option>Sedan</option>
            <option>SUV</option>
            <option>Coupe</option>
            <option>Convertible</option>
            <option>Hatchback</option>
        </select>
        <select class="f-select">
            <option>Any Price</option>
            <option>Under $30k</option>
            <option>$30k – $80k</option>
            <option>$80k – $150k</option>
            <option>Over $150k</option>
        </select>
        <select class="f-select">
            <option>Sort: Featured</option>
            <option>Price ↑</option>
            <option>Price ↓</option>
            <option>Newest</option>
            <option>Most Viewed</option>
        </select>
        <div class="results-count">Total <span> {{ " ".$totalVehicles." "}} </span> vehicles</div>
    </div>
@endsection
@section('content')

    <div class="row g-4">
        @foreach ($vehicles as $vehicle)
            @if($vehicle['status'] == 'available')
            <div class="col-12 col-md-6 col-xl-4">
            <div class="car-card">
                <div class="card-img-wrap">
                    <img src="{{ $vehicle->images->first() ? asset('storage/'.$vehicle->images->first()->image_path) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=600&q=80' }}" alt="{{ $vehicle->title }}">
                    <span class="badge-condition badge-{{ $vehicle->condition }}">{{ ucfirst($vehicle->condition) }}</span>
                    @if($vehicle->featured)
                    <span class="badge-featured">★ Featured</span>
                    @endif
                    @if($vehicle->fuel_type == 'Electric')
                    <span class="badge-fuel electric"><i class="bi bi-fuel-pump-fill"></i> {{ ucfirst($vehicle->fuel_type) }}</span>
                    @else
                    <span class="badge-fuel"><i class="bi bi-fuel-pump-fill"></i> {{ ucfirst($vehicle->fuel_type) }}</span>
                    @endif
                    <form action="{{ route('favorite.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                        <button type="submit" class="fav-btn btn btn-outline">
                            <i class="bi bi-heart"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body-inner">
                    <div class="car-brand">{{ $vehicle->brand }}</div>
                    <div class="car-title">{{ $vehicle->title }}</div>
                    <div class="car-location"><i class="bi bi-geo-alt-fill"></i> {{ $vehicle->location }}</div>
                    <div class="spec-row">
                        <span class="spec-item"><i class="bi bi-calendar3"></i> {{ $vehicle->year }}</span>
                        <span class="spec-item"><i class="bi bi-speedometer2"></i> {{ $vehicle->mileage }} mi</span>
                        <span class="spec-item"><i class="bi bi-gear-wide-connected"></i> {{ $vehicle->transmission }}</span>
                        <span class="spec-item"><i class="bi bi-palette2"></i> {{ $vehicle->color }}</span>
                        <span class="spec-item"><i class="bi bi-cpu"></i> {{ $vehicle->engine_capacity }}</span>
                    </div>
                    <hr class="card-divider">
                    <div class="card-footer-inner">
                        <div class="price-block">
                            <div class="price">${{ number_format($vehicle->price) }}</div>
                            <div class="price-note"><i class="bi bi-eye"></i> {{ $vehicle->views }} views &nbsp;·&nbsp; {{ ucfirst($vehicle->status) }}</div>
                        </div>
                        <a href="/vehicle/{{ $vehicle->slug }}" class="btn-detail">View Details</a>
                    </div>  
                </div>
            </div>
        </div>
        @else
        <div class="col-12 col-md-6 col-xl-4">
            <div class="car-card" style="opacity:.55;">
                <div class="card-img-wrap">
                    <img src="{{ $vehicle->images->first() ? asset('storage/'.$vehicle->images->first()->image_path) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=600&q=80' }}" alt="{{ $vehicle->title }}">
                    <span class="badge-condition badge-sold">Sold</span>
                    @if($vehicle->featured)
                    <span class="badge-featured">★ Featured</span>
                    @endif
                    @if($vehicle->fuel_type == 'Electric')
                    <span class="badge-fuel electric"><i class="bi bi-fuel-pump-fill"></i> {{ ucfirst($vehicle->fuel_type) }}</span>
                    @else
                    <span class="badge-fuel"><i class="bi bi-fuel-pump-fill"></i> {{ ucfirst($vehicle->fuel_type) }}</span>
                    @endif
                    <div class="fav-btn"><i class="bi bi-heart"></i></div>
                </div>
                <div class="card-body-inner">
                    <div class="car-brand">{{ $vehicle->brand }}</div>
                    <div class="car-title">{{ $vehicle->title }}</div>
                    <div class="car-location"><i class="bi bi-geo-alt-fill"></i> {{ $vehicle->location }}</div>
                    <div class="spec-row">
                        <span class="spec-item"><i class="bi bi-calendar3"></i> {{ $vehicle->year }}</span>
                        <span class="spec-item"><i class="bi bi-speedometer2"></i> {{ $vehicle->mileage }} mi</span>
                        <span class="spec-item"><i class="bi bi-gear-wide-connected"></i> {{ $vehicle->transmission }}</span>
                        <span class="spec-item"><i class="bi bi-palette2"></i> {{ $vehicle->color }}</span>
                        <span class="spec-item"><i class="bi bi-cpu"></i> {{ $vehicle->engine_capacity }}</span>
                    </div>
                    <hr class="card-divider">
                     <div class="card-footer-inner">
                        <div class="price-block">
                            <div class="price">${{ number_format($vehicle->price) }}</div>
                             <div class="price-note" style="color:var(--red);"><i class="bi bi-x-circle-fill"></i> Sold — No longer available</div>
                        </div>
                        <a href="#" class="btn-detail">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach

        

      
        

    </div>
@endsection
@section('pagination')
    <!-- PAGINATION -->
    @if($vehicles->hasPages())
    <div class="pag-wrap">
        {{-- Previous Page Link --}}
        @if ($vehicles->onFirstPage())
            <span class="pg" style="opacity:0.5;cursor:not-allowed;"><i class="bi bi-chevron-left"></i></span>
        @else
            <a href="{{ $vehicles->previousPageUrl() }}" class="pg"><i class="bi bi-chevron-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($vehicles->getUrlRange(1, $vehicles->lastPage()) as $page => $url)
            @if ($page == $vehicles->currentPage())
                <a href="{{ $url }}" class="pg active">{{ $page }}</a>
            @else
                <a href="{{ $url }}" class="pg">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($vehicles->hasMorePages())
            <a href="{{ $vehicles->nextPageUrl() }}" class="pg"><i class="bi bi-chevron-right"></i></a>
        @else
            <span class="pg" style="opacity:0.5;cursor:not-allowed;"><i class="bi bi-chevron-right"></i></span>
        @endif
    </div>
    @endif
@endsection
