<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $table = 'asets'; // Menyesuaikan nama tabel di HeidiSQL
    protected $guarded = [];

    /**
     * Relasi ke Model Kategori
     */
    // Di app/Models/Aset.php
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}