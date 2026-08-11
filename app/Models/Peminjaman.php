<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk menentukan nama tabel di database secara manual
    protected $table = 'peminjamans';

    protected $guarded = ['id'];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'asset_id');
    }
}