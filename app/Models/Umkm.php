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
    ];

    public function images()
    {
        return $this->hasMany(UmkmImage::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
