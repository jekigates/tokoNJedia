<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'dob',
        'gender',
        'image',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function merchant()
    {
        return $this->hasOne(Merchant::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'locationable_id', 'id');
    }

    public function getImage()
    {
        return ($this->image == null) ? 'img/logo/user.png' : $this->image;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transaction_headers()
    {
        return $this->hasMany(TransactionHeader::class);
    }
}
