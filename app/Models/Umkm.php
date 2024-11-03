<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alamat',
        'user_id',
        'deskripsi',
        'entity',
        'assets',
        'area',
        'market_share',
        'sertifikasi',
        'pendanaan',
        'peruntukan',
        'rencana',
    ];

    public function images()
    {
        return $this->hasMany(UmkmImage::class);
    }

    public function locationImages()
    {
        return $this->hasMany(LocationImage::class);
    }

    public function nibImages()
    {
        return $this->hasMany(NIBImage::class);
    }

    public function certificationImages()
    {
        return $this->hasMany(CertificationImage::class);
    }

    public function npwpImages()
    {
        return $this->hasMany(NPWPImage::class);
    }

    public function logoImages()
    {
        return $this->hasMany(LogoImage::class);
    }

    public function ProductImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function LaporanKeuangan()
    {
        return $this->hasMany(LaporanKeuangan::class);
    }
}