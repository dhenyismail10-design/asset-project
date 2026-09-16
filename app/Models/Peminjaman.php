<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';
    protected $guarded = ['id'];

    // Relasi ke Model Aset
    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id');
    }
}