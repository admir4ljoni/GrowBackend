<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'periode',
        'umkm_id',
        'quarter',
        'omzet',
        'net_profit',
        'created_at',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
