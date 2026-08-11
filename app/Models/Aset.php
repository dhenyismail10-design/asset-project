<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'aset';
    public $timestamps = false; // Mematikan pencarian created_at/updated_at

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kondisi',
        'lokasi'
    ];
}