<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Kendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraan';
    protected $fillable = [
        'nama',
        'foto',
        'merk',
        'plat',
        'warna',
        'kondisi',
        'harga',
        'tipe_kendaraan_id',
        'pemilik_id',
    ];

    public static function formatHarga(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => 'Rp' . number_format($attributes['harga'], 0, ',', '.'),
        );
    }

    public function jenisKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'tipe_kendaraan_id');
    }
    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'tipe_kendaraan_id');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'pemilik_id');
    }

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'kendaraan_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'kendaraan_id');
    }
}
