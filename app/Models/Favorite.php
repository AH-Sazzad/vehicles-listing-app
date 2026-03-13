<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'vehicle_id',
    ];
    public function vehicle()
    {
        return $this->belongsTo(VehiclesDetail::class, 'vehicle_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
