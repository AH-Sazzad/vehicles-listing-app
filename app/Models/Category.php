<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name', 'description', 'image', 'slug', 'status'];

    public function vehicles()
    {
        return $this->hasMany(VehiclesDetail::class);
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
