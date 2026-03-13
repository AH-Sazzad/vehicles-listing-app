<?php

namespace App\Models;
use App\Models\User;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class VehiclesDetail extends Model
{
    use HasFactory;
    protected $table = 'vehicles_details';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'brand',
        'model',
        'year',
        'price',
        'condition',
        'mileage',
        'fuel_type',
        'transmission',
        'body_type',
        'color',
        'engine_capacity',
        'image',          // single thumbnail / cover path
        'location',
        'featured',
        'views',
        'description',
        'status',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'price'    => 'decimal:2',
        'mileage'  => 'integer',
        'views'    => 'integer',
    ];

    /* ──────────────────────────────────────
       RELATIONSHIPS
    ────────────────────────────────────── */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** All photos from the _image table */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'vehicle_id')
                    ->orderByDesc('is_featured')   // featured first
                    ->orderBy('id');
    }

    /** The single featured / cover photo from _image table */
    public function featuredImage(): HasOne
    {
        return $this->hasOne(Image::class, 'vehicle_id')
                    ->where('featured', true);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /* ──────────────────────────────────────
       ACCESSORS
    ────────────────────────────────────── */

    /** Returns the URL of the cover image (featured from _image, fallback to image column) */
    public function getCoverUrlAttribute(): string
    {
        if ($this->featuredImage) {
            return Storage::url($this->featuredImage->image_path);
        }

        if ($this->image) {
            return Storage::url($this->image);
        }

        return asset('images/no-image.png');   // fallback placeholder
    }

    /** Formatted price */
    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }

    /* ──────────────────────────────────────
       SCOPES
    ────────────────────────────────────── */

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByBrand($query, string $brand)
    {
        return $query->where('brand', $brand);
    }
}