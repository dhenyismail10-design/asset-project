<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang benar sesuai database
    protected $table = 'peminjamans'; 

    protected $guarded = [];

    // Relasi ke Model Aset
    public function aset()
    {
        return $this->belongsTo(Aset::class, 'asset_id');
    }
}