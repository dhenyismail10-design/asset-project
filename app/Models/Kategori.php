<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $guarded = ['id'];

    // Di app/Models/Peminjaman.php
    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id'); // atau 'asset_id'
    }
}