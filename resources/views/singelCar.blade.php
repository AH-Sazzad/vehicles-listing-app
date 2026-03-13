@extends('layouts.app')
@section('topbar')
    <div class="topbar">

        <a href="{{ route('home') }}" class="topbar-back"><i class="bi bi-chevron-left"></i> Back to Listings</a>
        <div class="topbar-title" style="font-size:16px;">{{ $vehicle->title }}</div>
        <a href="{{ route('massages.show', ['user' => $user->id, 'vehicle' => $vehicle->id]) }}" class="btn-outline"><i class="bi bi-chat-dots"></i> Contact Seller</a>
        <a href="{{ route('dashboard') }}" class="btn-gold"><i class="bi bi-pencil"></i>Listing</a>
    </div>
@endsection
@section('content')
    <!-- CONTENT -->
    <div class="content">
        <div class="row g-4">

            <!-- LEFT: Gallery + Description -->
            <div class="col-12 col-xl-7">

                <!-- Main image -->
                <div class="gallery-main">
                    <img src="{{ $vehicle->images->first() ? asset('storage/' . $vehicle->images->first()->image_path) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=900&q=80' }}"
                        alt="{{ $vehicle->title }}" id="mainImage">
                    <div class="gallery-status">
                        <span class="g-badge g-badge-new">{{ ucfirst($vehicle->condition) }}</span>
                        @if ($vehicle->featured)
                            <span class="g-badge g-badge-featured">★ Featured</span>
                        @endif
                    </div>
                    {{-- <div class="gallery-fav"><i class="bi bi-heart"></i></div> --}}
                    <form action="{{ route('favorite.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                    <button type="submit" class="gallery-fav btn btn-outline">
                        <i class="bi bi-heart"></i>
                    </button>
                    </form>
                    <div class="gallery-views"><i class="bi bi-eye-fill"></i> {{ number_format($vehicle->views) }} views
                    </div>
                </div>

                <!-- Thumbnails (vehicle_images table) -->
                <div class="thumb-row">
                    @foreach ($vehicle->images as $index => $image)
                        <div class="thumb {{ $index === 0 ? 'active' : '' }}"
                            onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}', this)">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="">
                        </div>
                    @endforeach
                </div>

                <!-- Description -->
                <div class="info-panel mt-4">
                    <div class="section-label">Description</div>
                    <p class="desc-text">{{ $vehicle->description }}</p>

                    <!-- Full Specs Table -->
                    <div class="section-label mt-3">Full Specifications</div>
                    <table class="table table-dark table-borderless"
                        style="font-size:13px;--bs-table-bg:transparent;--bs-table-striped-bg:rgba(255,255,255,.03);">
                        <tbody>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);width:40%;padding:9px 0;">Brand</td>
                                <td style="font-weight:600;padding:9px 0;">{{ ucfirst($vehicle->brand) }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);padding:9px 0;">Model</td>
                                <td style="font-weight:600;padding:9px 0;">{{ ucfirst($vehicle->model) }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);padding:9px 0;">Year</td>
                                <td style="font-weight:600;padding:9px 0;">{{ ucfirst($vehicle->year) }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);padding:9px 0;">Condition</td>
                                <td style="padding:9px 0;"><span
                                        style="background:var(--gold);color:#090909;padding:2px 9px;border-radius:4px;font-size:10px;font-weight:700;">{{ ucfirst($vehicle->condition) }}</span>
                                </td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);padding:9px 0;">Mileage</td>
                                <td style="font-weight:600;padding:9px 0;">{{ ucfirst($vehicle->mileage) }} km</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);padding:9px 0;">Fuel Type</td>
                                <td style="font-weight:600;padding:9px 0;">{{ ucfirst($vehicle->fuel_type) }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);padding:9px 0;">Transmission</td>
                                <td style="font-weight:600;padding:9px 0;">{{ ucfirst($vehicle->transmission) }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);padding:9px 0;">Body Type</td>
                                <td style="font-weight:600;padding:9px 0;">{{ ucfirst($vehicle->body_type) }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);padding:9px 0;">Color</td>
                                <td style="font-weight:600;padding:9px 0;display:flex;align-items:center;gap:8px;"><span
                                        style="width:14px;height:14px;border-radius:50%;background:#1a1a1a;border:1px solid var(--border);display:inline-block;"></span>
                                    {{ ucfirst($vehicle->color) }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="color:var(--muted);padding:9px 0;">Engine Capacity</td>
                                <td style="font-weight:600;padding:9px 0;">{{ ucfirst($vehicle->engine_capacity) }}</td>
                            </tr>
                            <tr>
                                <td style="color:var(--muted);padding:9px 0;">Location</td>
                                <td style="font-weight:600;padding:9px 0;"><i class="bi bi-geo-alt-fill"
                                        style="color:var(--gold);"></i>{{ ucfirst($vehicle->location) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- RIGHT: Price + Seller + Actions -->
            <div class="col-12 col-xl-5">
                <div class="info-panel" style="position:sticky;top:76px;">
                    <div class="car-brand-label">{{ $vehicle->brand }} · {{ $vehicle->model }} · {{ $vehicle->year }}
                    </div>
                    <div class="car-main-title">{{ $vehicle->title }}</div>
                    <div class="car-slug">{{ $vehicle->slug }}</div>
                    @if ($vehicle->status == 'available')
                        <div class="status-pill"><i class="bi bi-check-circle-fill"></i> {{ ucfirst($vehicle->status) }}
                        </div>
                    @else
                        <div class="status-pill-red"><i class="bi bi-check-circle-fill"></i>
                            {{ ucfirst($vehicle->status) }}</div>
                    @endif
                    <div class="price-display">{{ $vehicle->price }} <small>
                            @if ($vehicle->negotiable)
                                <span class="negotiable-label">/ Negotiable</span>
                            @else
                                <span class="negotiable-label">/ Fixed Price</span>
                            @endif

                        </small></div>

                    <!-- Quick spec grid (all DB fields) -->
                    <div class="spec-grid">
                        <div class="spec-block">
                            <i class="bi bi-calendar3"></i>
                            <div>
                                <div class="sb-label">Year</div>
                                <div class="sb-value">{{ $vehicle->year }}</div>
                            </div>
                        </div>
                        <div class="spec-block">
                            <i class="bi bi-speedometer2"></i>
                            <div>
                                <div class="sb-label">Mileage</div>
                                <div class="sb-value">{{ $vehicle->mileage }} mi</div>
                            </div>
                        </div>
                        <div class="spec-block">
                            <i class="bi bi-fuel-pump-fill"></i>
                            <div>
                                <div class="sb-label">Fuel Type</div>
                                <div class="sb-value">{{ ucfirst($vehicle->fuel_type) }}</div>
                            </div>
                        </div>
                        <div class="spec-block">
                            <i class="bi bi-gear-wide-connected"></i>
                            <div>
                                <div class="sb-label">Transmission</div>
                                <div class="sb-value">{{ ucfirst($vehicle->transmission) }}</div>
                            </div>
                        </div>
                        <div class="spec-block">
                            <i class="bi bi-car-front"></i>
                            <div>
                                <div class="sb-label">Body Type</div>
                                <div class="sb-value">{{ ucfirst($vehicle->body_type) }}</div>
                            </div>
                        </div>
                        <div class="spec-block">
                            <i class="bi bi-palette2"></i>
                            <div>
                                <div class="sb-label">Color</div>
                                <div class="sb-value">{{ ucfirst($vehicle->color) }}</div>
                            </div>
                        </div>
                        <div class="spec-block">
                            <i class="bi bi-cpu"></i>
                            <div>
                                <div class="sb-label">Engine</div>
                                <div class="sb-value">{{ $vehicle->engine_capacity }}</div>
                            </div>
                        </div>
                        <div class="spec-block">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <div class="sb-label">Location</div>
                                <div class="sb-value">{{ ucfirst($vehicle->location) }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Seller -->
                    <div class="section-label">Listed By</div>
                    <div class="seller-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="seller-av">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <div>
                                <div class="seller-name">{{ $user->name }}</div>
                                <div class="seller-role">{{ $user->role }}</div>
                            </div>
                        </div>
                        <div class="seller-location"><i class="bi bi-geo-alt"></i>
                            @if ($user->location)
                                {{ $user->location }}@else{{ 'N/A' }}
                            @endif &nbsp;·&nbsp; <i class="bi bi-email"></i> {{ $user->email }}
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="action-stack">
                        <a href="{{ route('massages.show', ['user' => $user->id, 'vehicle' => $vehicle->id]) }}" class="btn-full btn-full-gold"><i class="bi bi-chat-dots-fill"></i>
                            Message Seller</a>
                        <a href="#" class="btn-full btn-full-outline"><i class="bi bi-telephone-fill"></i> Call
                            Dealer</a>
                        <a href="#" class="btn-full btn-full-outline"><i class="bi bi-calendar-check"></i> Book
                            Test Drive</a>
                        <form action="{{ route('favorite.store') }}" method="POST" style="margin:0;">
                            @csrf
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                            <button type="submit" class="btn-full btn-full-outline-red" style="width:100%;">
                                <i class="bi bi-heart"></i> Save to Favorites
                            </button>
                        </form>
                    </div>

                    <!-- Meta -->
                    <div
                        style="margin-top:16px;padding-top:14px;border-top:1px solid var(--border);display:flex;gap:20px;">
                        <span style="font-size:11px;color:var(--muted);display:flex;align-items:center;gap:4px;"><i
                                class="bi bi-eye"></i> {{ $vehicle->views }} views</span>
                        <span style="font-size:11px;color:var(--muted);display:flex;align-items:center;gap:4px;"><i
                                class="bi bi-clock"></i> {{ $vehicle->created_at->diffForHumans() }}</span>
                        <span style="font-size:11px;color:var(--muted);display:flex;align-items:center;gap:4px;"><i
                                class="bi bi-tag"></i> ID #{{ $vehicle->id }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SIMILAR VEHICLES -->
        <div class="similar-section">
            <div class="section-heading">Similar Vehicles</div>
            @if ($similarVehicles->count() > 0)
                <div class="row g-3">
                    @foreach ($similarVehicles as $similarVehicle)
                        <div class="col-12 col-md-6 col-xl-4">
                            <a href="{{ route('singelCar', $similarVehicle->slug) }}"
                                style="text-decoration:none;color:inherit;">
                                <div class="mini-card">
                                    <div class="mini-img" style="height:110px;">
                                        <img src="{{ $similarVehicle->images->first() ? asset('storage/' . $similarVehicle->images->first()->image_path) : 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=300&q=70' }}"
                                            alt="{{ $similarVehicle->title }}">
                                    </div>
                                    <div class="mini-body">
                                        <div class="mini-brand">{{ $similarVehicle->brand }}</div>
                                        <div class="mini-title">{{ $similarVehicle->title }}</div>
                                        <div class="mini-specs">
                                            <span><i class="bi bi-calendar3"></i> {{ $similarVehicle->year }}</span>
                                            <span><i class="bi bi-speedometer2"></i> {{ $similarVehicle->mileage }}
                                                mi</span>
                                            <span><i class="bi bi-fuel-pump"></i>
                                                {{ ucfirst($similarVehicle->fuel_type) }}</span>
                                        </div>
                                        <div class="mini-price">${{ number_format($similarVehicle->price) }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach



                </div>
            @else
                <div class="alert alert-warning">No similar vehicles found.</div>
            @endif
        </div>
    @endsection

    <script>
        function changeMainImage(imageSrc, thumbElement) {
            document.getElementById('mainImage').src = imageSrc;
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            thumbElement.classList.add('active');
        }
    </script>
