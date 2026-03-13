<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Category;
use App\Models\Massage;
use App\Models\VehiclesDetail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function vehicles()
    {
        return $this->hasMany(VehiclesDetail::class);
    }
    public function sentMassages()
    {
        return $this->hasMany(Massage::class, 'sender_id');
    }
    public function receivedMassages(){
        return $this->hasMany(Massage::class, 'receiver_id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
