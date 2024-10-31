<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'image',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
