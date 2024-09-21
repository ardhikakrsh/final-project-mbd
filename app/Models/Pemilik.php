<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    protected $table = 'pemilik';
    protected $fillable = [
        'nomor_telepon',
        'alamat',
        'users_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'pemilik_id');
    }
}
