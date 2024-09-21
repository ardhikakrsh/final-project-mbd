<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $fillable = [
        'kondisi',
        'tanggal_pengembalian',
        'masalah',
        'denda',
        'sewa_id',
    ];
    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'sewa_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
    public function formatHarga(): string
    {
        return 'Rp' . number_format($this->attributes['denda'], 0, ',', '.');
    }
    public function formatMasalah(): string
    {
        return $this->attributes['masalah'] == 0 ? 'Tidak ada masalah' : 'Ada masalah';
    }
}
