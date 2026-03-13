@extends('layouts.app')

@section('topbar')
    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div class="dash-topbar">
            <div class="dash-topbar-title">Dealer Dashboard</div>  
        </div>
        <div style="font-size:12px;color:var(--muted);"></div>
    </div>
@endsection
@section('content')
<div class="content">
    <div class="dash-content">
        <!-- STATS -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-car-front-fill"></i></div>
                    <div>
                        <div class="stat-val">{{ $data->count() }}</div>
                        <div class="stat-lbl">Total Listings</div>
                        <div class="stat-change up"><i class="bi bi-arrow-up-short"></i> +12 this month</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-check-circle-fill"></i></div>
                    <div>
                        <div class="stat-val">{{ $total_sold }}</div>
                        <div class="stat-lbl">Sold This Month</div>
                        <div class="stat-change up"><i class="bi bi-arrow-up-short"></i> +8 vs last month</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-eye-fill"></i></div>
                    <div>
                        <div class="stat-val">{{ $total_view }}</div>
                        <div class="stat-lbl">Total Views</div>
                        <div class="stat-change up"><i class="bi bi-arrow-up-short"></i> +2.1K this week</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-chat-dots-fill"></i></div>
                    <div>
                        <div class="stat-val">5</div>
                        <div class="stat-lbl">New Messages</div>
                        <div class="stat-change down"><i class="bi bi-arrow-down-short"></i> 3 pending reply</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">

            <!-- ADD NEW LISTING FORM -->
            <div class="col-12 col-xl-7">
                <div class="sec-head">Add New Listing</div>
                <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="form-panel">

                    <!-- Step 1: Basic Info -->
                    <div class="form-step-header">
                        <div class="step-num">1</div>
                        <div>
                            <div class="step-title">Basic Information</div>
                            <div class="step-desc">Brand, model, year and title</div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="dash-label">Listing Title *</label>
                            <input type="text" name="title" class="dash-input" required
                                placeholder="e.g. BMW M5 Competition xDrive 2024 — Frozen Black">
                        </div>
                        <div class="col-md-6">
                            <label class="dash-label">Brand *</label>
                            <input type="text" name="brand" class="dash-input" required placeholder="e.g. BMW, Porsche, Audi…">
                        </div>
                        <div class="col-md-6">
                            <label class="dash-label">Model *</label>
                            <input type="text" name="model" class="dash-input" required placeholder="e.g. M5 Competition xDrive">
                        </div>
                        <div class="col-md-4">
                            <label class="dash-label">Year *</label>
                            <select name="year" class="dash-select" required>
                                <option value="">Select year</option>
                                <option>2025</option>
                                <option>2024</option>
                                <option>2023</option>
                                <option>2022</option>
                                <option>2021</option>
                                <option>2020</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="dash-label">Category *</label>
                            <select name="category_id" class="dash-select" required>
                                <option value="">Select category</option>
                                @foreach(\App\Models\Category::all() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="dash-label">Condition *</label>
                            <select name="condition" class="dash-select" required>
                                <option value="">Select condition</option>
                                <option value="new">New</option>
                                <option value="used">Used</option>
                            </select>
                        </div>
                    </div>

                    <!-- Step 2: Specs -->
                    <div class="form-step-header">
                        <div class="step-num">2</div>
                        <div>
                            <div class="step-title">Technical Specifications</div>
                            <div class="step-desc">Engine, fuel, transmission and more</div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="dash-label">Price (USD) *</label>
                            <input type="number" name="price" class="dash-input" required placeholder="e.g. 142500" step="0.01">
                        </div>
                        <div class="col-md-6">
                            <label class="dash-label">Mileage (mi)</label>
                            <input type="number" name="mileage" class="dash-input" placeholder="Leave 0 for new vehicles">
                        </div>
                        <div class="col-md-4">
                            <label class="dash-label">Fuel Type *</label>
                            <select name="fuel_type" class="dash-select" required>
                                <option value="">Select fuel type</option>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Plug-in Hybrid">Plug-in Hybrid</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="dash-label">Transmission *</label>
                            <select name="transmission" class="dash-select" required>
                                <option value="">Select</option>
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                                <option value="Semi-Automatic">Semi-Automatic</option>
                                <option value="CVT">CVT</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="dash-label">Body Type</label>
                            <select name="body_type" class="dash-select">
                                <option value="">Select body type</option>
                                <option value="Sedan">Sedan</option>
                                <option value="SUV">SUV / Crossover</option>
                                <option value="Coupe">Coupe</option>
                                <option value="Convertible">Convertible</option>
                                <option value="Hatchback">Hatchback</option>
                                <option value="Wagon">Wagon</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="dash-label">Color</label>
                            <input type="text" name="color" class="dash-input" placeholder="e.g. Frozen Black Metallic">
                        </div>
                        <div class="col-md-6">
                            <label class="dash-label">Engine Capacity</label>
                            <input type="text" name="engine_capacity" class="dash-input" placeholder="e.g. 4.4L Twin-Turbo V8">
                        </div>
                        <div class="col-12">
                            <label class="dash-label">Location *</label>
                            <input type="text" name="location" class="dash-input" required placeholder="e.g. Los Angeles, California">
                        </div>
                    </div>

                    <!-- Step 3: Status & Options -->
                    <div class="form-step-header">
                        <div class="step-num">3</div>
                        <div>
                            <div class="step-title">Status &amp; Visibility</div>
                            <div class="step-desc">Control listing status and promotion</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2 mb-4">
                        <div class="toggle-row">
                            <div class="toggle-info">
                                <p>Mark as Featured</p>
                                <small>Promoted position on search results and homepage</small>
                            </div>
                            <input type="checkbox" name="featured" value="1" style="width:42px;height:22px;">
                        </div>
                        <div class="toggle-row">
                            <div class="toggle-info">
                                <p>Status</p>
                                <small>Toggle between Available and Sold</small>
                            </div>
                            <select name="status" class="dash-select" style="width:auto;" required>
                                <option value="available">Available</option>
                                <option value="sold">Sold</option>
                            </select>
                        </div>
                    </div>

                    <!-- Step 4: Description -->
                    <div class="form-step-header">
                        <div class="step-num">4</div>
                        <div>
                            <div class="step-title">Description</div>
                            <div class="step-desc">Detailed vehicle notes for buyers</div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="dash-label">Vehicle Description</label>
                        <textarea name="description" class="dash-textarea"
                            placeholder="Describe the vehicle condition, features, service history, extras, financing options…"></textarea>
                    </div>

                    <!-- Step 5: Images -->
                    <div class="form-step-header">
                        <div class="step-num">5</div>
                        <div>
                            <div class="step-title">Vehicle Images</div>
                            <div class="step-desc">Stored in vehicle_images table (image_path, is_featured)</div>
                        </div>
                    </div>
                    <div class="upload-zone mb-3" onclick="document.getElementById('images').click()">
                        <i class="bi bi-cloud-arrow-up"></i>
                        <p>Drag &amp; drop images here or <label for="images" style="color:var(--gold);font-weight:600;cursor:pointer;">browse files</label></p>
                        <input type="file" name="images[]" id="images" multiple accept="image/jpeg,image/png,image/jpg,image/webp" style="display:none;" onchange="previewImages(event)">
                        <div class="upload-note">JPG, PNG, WEBP — up to 5MB each · Multiple files allowed</div>
                    </div>
                    <div class="img-preview-row" id="imagePreview"></div>

                    <!-- Submit -->
                    <div class="d-flex gap-3 mt-4 pt-3" style="border-top:1px solid var(--border);">
                        <button type="submit" class="btn-gold"><i class="bi bi-check-lg"></i> Publish Listing</button>
                        <button type="reset" class="btn-ghost"><i class="bi bi-x-lg"></i> Cancel</button>
                    </div>

                </div>
                </form>
            </div>

            <!-- RIGHT: Recent Listings mini + Quick actions -->
            <div class="col-12 col-xl-5">

                <!-- Quick actions -->
                <div class="sec-head">Quick Actions</div>
                <div class="row g-2 mb-4">
                    <div class="col-6">
                        <div style="background:var(--s1);border:1px solid var(--border);border-radius:10px;padding:16px;text-align:center;cursor:pointer;transition:border-color .2s;"
                            onmouseover="this.style.borderColor='var(--gold-border)'"
                            onmouseout="this.style.borderColor='var(--border)'">
                             <i class="bi bi-star-fill" style="font-size:22px;color:var(--gold);"></i>
                            <div style="font-size:13px;font-weight:600;margin-top:6px;">Manage Featured</div>
                            <div style="font-size:11px;color:var(--muted);">7 active</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:var(--s1);border:1px solid var(--border);border-radius:10px;padding:16px;text-align:center;cursor:pointer;transition:border-color .2s;"
                            onmouseover="this.style.borderColor='var(--gold-border)'"
                            onmouseout="this.style.borderColor='var(--border)'">
                            <i class="bi bi-graph-up-arrow" style="font-size:22px;color:var(--gold);"></i>
                            <div style="font-size:13px;font-weight:600;margin-top:6px;">View Analytics</div>
                            <div style="font-size:11px;color:var(--muted);">18.4K views total</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="messages.html" style="text-decoration:none;">
                            <div style="background:var(--s1);border:1px solid var(--border);border-radius:10px;padding:16px;text-align:center;cursor:pointer;transition:border-color .2s;"
                                onmouseover="this.style.borderColor='var(--gold-border)'"
                                onmouseout="this.style.borderColor='var(--border)'">
                                <i class="bi bi-chat-dots-fill" style="font-size:22px;color:var(--gold);"></i>
                                <div style="font-size:13px;font-weight:600;margin-top:6px;color:var(--text);">Messages
                                </div>
                                <div style="font-size:11px;color:var(--red);">5 unread</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <div style="background:var(--s1);border:1px solid var(--border);border-radius:10px;padding:16px;text-align:center;cursor:pointer;transition:border-color .2s;"
                            onmouseover="this.style.borderColor='var(--gold-border)'"
                            onmouseout="this.style.borderColor='var(--border)'">
                            <i class="bi bi-tag-fill" style="font-size:22px;color:var(--gold);"></i>
                            <div style="font-size:13px;font-weight:600;margin-top:6px;">Bulk Edit Prices</div>
                            <div style="font-size:11px;color:var(--muted);">Update multiple</div>
                        </div>
                    </div>
                </div>

                <!-- Recent Listings -->
                <div class="sec-head">My Recent Listings</div>
                <div style="background:var(--s1);border:1px solid var(--border);border-radius:12px;overflow:hidden;">
                  @forelse ($recent_listings as $item)
                    <div style="display:flex;align-items:center;gap:12px;padding:13px 16px;border-bottom:1px solid var(--border);">
                        <div style="width:52px;height:40px;border-radius:6px;overflow:hidden;flex-shrink:0;">
                            <img src="{{ $item->images->first() ? asset('storage/'.$item->images->first()->image_path) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=600&q=80' }}"
                                style="width:100%;height:100%;object-fit:cover;" alt="{{ $item->title }}">
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                {{ $item->title }}</div>
                            <div style="font-size:10px;color:var(--muted);margin-top:2px;"><i class="bi bi-eye"></i> {{ number_format($item->views) }}
                                · <i class="bi bi-geo-alt"></i> {{ $item->location }}</div>
                        </div>
                        <div style="text-align:right;flex-shrink:0;">
                            <div style="font-size:13px;font-weight:700;color:var(--gold);">${{ number_format($item->price) }}</div>
                            <span style="font-size:10px;font-weight:600;background:rgba({{ $item->status == 'available' ? '78,203,161' : '224,85,85' }},.1);color:var(--{{ $item->status == 'available' ? 'green' : 'red' }});border:1px solid rgba({{ $item->status == 'available' ? '78,203,161' : '224,85,85' }},.2);padding:2px 7px;border-radius:10px;">{{ ucfirst($item->status) }}</span>
                        </div>
                        <div style="display:flex;gap:5px;flex-shrink:0;">
                            <div class="lt-btn"><i class="bi bi-pencil"></i></div>
                            <div class="lt-btn del"><i class="bi bi-trash3"></i></div>
                        </div>
                    </div>
                  @empty
                    <div style="padding:40px;text-align:center;color:var(--muted);">
                        <i class="bi bi-inbox" style="font-size:32px;margin-bottom:8px;"></i>
                        <p style="margin:0;">No listings yet</p>
                    </div>
                  @endforelse
                </div><!-- /recent -->

                <div style="text-align:center;margin-top:12px;">
                    <a href="index.html" style="font-size:12px;color:var(--gold);text-decoration:none;">View all 248
                        listings →</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

<script>
function previewImages(event) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    const files = event.target.files;
    
    if (files.length === 0) return;
    
    Array.from(files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'img-thumb-prev';
            div.innerHTML = `
                <img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;" alt="">
                ${index === 0 ? '<span class="star-badge">★ Cover</span>' : ''}
            `;
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}
</script>
