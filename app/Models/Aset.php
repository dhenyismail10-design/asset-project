<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relasi ke model Kategori
     */
    public function kategori()
    {
        // Sesuaikan 'kategori_id' dengan nama foreign key di tabel asets/aset Anda
        return $this->belongsTo(Kategori::class, 'kategori_id'); 
    }
}