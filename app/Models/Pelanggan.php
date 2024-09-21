<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $fillable = [
        'NIK',
        'nomor_telepon',
        'alamat',
        'users_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'pelanggan_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'pelanggan_id');
    }
}
