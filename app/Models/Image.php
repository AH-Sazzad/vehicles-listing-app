<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VehiclesDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $table = '_image'; // maps to your _image table
    // If your migration literally named it '_image', use:
    // protected $table = '_image';

    protected $fillable = [
        'vehicle_id',
        'image_path',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /* ──────────────────────────────────────
       RELATIONSHIPS
    ────────────────────────────────────── */

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(VehiclesDetail::class, 'vehicle_id');
    }

    /* ──────────────────────────────────────
       ACCESSORS
    ────────────────────────────────────── */

    /** Full public URL for the image */
    public function getUrlAttribute(): string
    {
        return Storage::url($this->image_path);
    }

    /* ──────────────────────────────────────
       HELPER — delete file from disk
    ────────────────────────────────────── */

    public function deleteFile(): void
    {
        Storage::disk('public')->delete($this->image_path);
    }
}