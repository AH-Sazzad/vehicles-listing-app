<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Massage extends Model
{
    protected $table = 'massages_tabel';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'vehicle_id',
        'message',
        'status',
        'timestamp',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(VehiclesDetail::class, 'vehicle_id');
    }
}
