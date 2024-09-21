<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $fillable = [
        'metode_pembayaran',
        'jumlah_pembayaran',
        'bukti_pembayaran',
        'detail_pembayaran',
        'status_pembayaran',
        'sewa_id',
    ];
    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'sewa_id');
    }

    public function formatHarga(): string
    {
        return 'Rp' . number_format($this->attributes['jumlah_pembayaran'], 0, ',', '.');
    }
}
