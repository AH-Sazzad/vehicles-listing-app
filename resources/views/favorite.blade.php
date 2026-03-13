@extends('layouts.app')

@section('content')
    <!-- TOPBAR -->
    <div class="topbar-fav">
        <div class="topbar-fav-title">My Favorites <span
                style="font-size:16px;color:var(--gold);font-weight:400;">({{ $favorites->count() }})</span></div>
        <a href="{{ route('home') }}" style="font-size:12px;color:var(--gold);text-decoration:none;"><i
                class="bi bi-plus-lg"></i> Browse More Vehicles</a>
        {{-- <a href="" class="btn-outline"><i class="bi bi-trash3"></i> Clear All</a> --}}
        <form action="favorite/{{ auth()->user()->id }}" method="POST"
            onsubmit="return confirm('Are you sure you want to clear all favorites?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-outline"><i class="bi bi-trash3"></i> Clear All</button>
        </form>
    </div>

    <!-- CONTENT -->
    <div class="content-fav">

        <!-- SUMMARY BAR -->
        <div class="summary-bar">
            <div class="sum-item">
                <div class="sum-icon"><i class="bi bi-heart-fill"></i></div>
                <div>
                    <div class="sum-val">{{ $favorites->count() }}</div>
                    <div class="sum-lbl">Saved Cars</div>
                </div>
            </div>
            <div class="sum-divider"></div>
            <div class="sum-item">
                <div class="sum-icon"><i class="bi bi-currency-dollar"></i></div>
                <div>
                    <div class="sum-val">${{ number_format($totalValue) }}</div>
                    <div class="sum-lbl">Total Value</div>
                </div>
            </div>
            <div class="sum-divider"></div>
            <div class="sum-item">
                <div class="sum-icon"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                    <div class="sum-val">{{ $still_Available }}</div>
                    <div class="sum-lbl">Still Available</div>
                </div>
            </div>
            <div class="sum-divider"></div>
            <div class="sum-cta">
                <a href="{{ route('massages') }}" class="btn-gold-sm"><i class="bi bi-chat-dots"></i> Contact About All</a>
            </div>
        </div>

        <!-- SORT BAR -->
        <div class="sort-bar">
            <span class="sort-label">Filter:</span>
            <a href="#" class="f-pill active">All (4)</a>
            <a href="#" class="f-pill">Available (3)</a>
            <a href="#" class="f-pill">New (2)</a>
            <a href="#" class="f-pill">Electric (1)</a>
            <select class="f-select">
                <option>Sort: Date Saved</option>
                <option>Price ↑</option>
                <option>Price ↓</option>
                <option>Most Viewed</option>
            </select>
        </div>
        @if($favorites->isEmpty())
        <div class="no-fav">
            <div class="alert alert-danger" role="alert">
                You have no favorite vehicles yet. Start browsing and add some to your favorites!
</div>
            <a href="{{ route('home') }}" class="btn-gold">Browse Cars</a>
        </div>
        @else
        @foreach ($favorites as $favorite)
            <a href="/vehicle/{{ $favorite->vehicle->slug }} " class="fav-link text-decoration-none">
                <div class="fav-card mb-3">
                    <div class="fav-img">
                        <img src="{{ $favorite->vehicle->images->first() ? asset('storage/' . $favorite->vehicle->images->first()->image_path) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=600&q=80' }}"
                            alt="{{ $favorite->vehicle->title }}">
                        <span class="fav-badge-cond badge-new">{{ $favorite->vehicle->condition }}</span>
                        <span class="fav-badge-fuel"><i class="bi bi-fuel-pump-fill"></i>
                            {{ $favorite->vehicle->fuel_type }}</span>
                    </div>
                    <div class="fav-body">
                        <div class="fav-brand">{{ $favorite->vehicle->brand }}</div>
                        <div class="fav-title text-light">{{ $favorite->vehicle->title }}</div>
                        <div class="fav-location"><i class="bi bi-geo-alt-fill"></i> {{ $favorite->vehicle->location }}
                        </div>
                        <div class="spec-row">
                            <span class="spec-item"><i class="bi bi-calendar3"></i> {{ $favorite->vehicle->year }}</span>
                            <span class="spec-item"><i class="bi bi-speedometer2"></i> {{ $favorite->vehicle->mileage }}
                                mi</span>
                            <span class="spec-item"><i class="bi bi-gear-wide-connected"></i>
                                {{ $favorite->vehicle->transmission }}</span>
                            <span class="spec-item"><i class="bi bi-palette2"></i> {{ $favorite->vehicle->color }}</span>
                            <span class="spec-item"><i class="bi bi-cpu"></i>
                                {{ $favorite->vehicle->engine_capacity }}</span>
                            <span class="spec-item"><i class="bi bi-car-front"></i>
                                {{ $favorite->vehicle->body_type }}</span>
                        </div>
                        <div class="price-drop"><i class="bi bi-arrow-down-short"></i> Price dropped $4,900 since you saved
                            this</div>
                        <div class="fav-desc">An immaculate 2024 911 Carrera 4S Cabriolet in GT Silver. Features all-wheel
                            drive, the iconic Porsche 3.0L flat-six, and the PDK dual-clutch gearbox. Full factory options
                            included.</div>
                        <div class="fav-footer d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fav-price">${{ $favorite->vehicle->price }}0</div>
                                <div class="fav-meta"><span><i class="bi bi-eye"></i>
                                        {{ $favorite->vehicle->views }}</span> <span><i class="bi bi-check-circle"></i>
                                        Available</span></div>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="saved-tag"><i class="bi bi-heart-fill"></i> Saved 2 days ago</div> --}}
                </div>
            </a>
        @endforeach
        @endif
        <!-- ── FAV CARD 1 ── -->




    </div><!-- /content -->
@endsection
