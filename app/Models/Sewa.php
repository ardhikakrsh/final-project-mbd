<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sewa extends Model
{
    use HasFactory;
    protected $table = 'sewa';
    protected $fillable = [
        'tanggal_sewa',
        'tanggal_pengembalian',
        'total_harga',
        'status_sewa',
        'kendaraan_id',
        'pelanggan_id',
    ];
    public function formatHarga(): string
    {
        return 'Rp' . number_format($this->attributes['total_harga'], 0, ',', '.');
    }
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    // public function logSewa()
    // {
    //     return $this->hasMany(LogSewa::class, 'sewa_id');
    // }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'sewa_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'sewa_id');
    }
}
