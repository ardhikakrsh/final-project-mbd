<?php

namespace App\Models;

use App\Enums\RolesType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'location',
        'about_me',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => RolesType::class
    ];

    public function isAdmin(): bool
    {
        return $this->role == RolesType::ADMIN;
    }
    public function isUser(): bool
    {
        return $this->role == RolesType::USER;
    }
    public function isOwner(): bool
    {
        return $this->role == RolesType::OWNER;
    }
    
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'users_id');
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'users_id');
    }
}
