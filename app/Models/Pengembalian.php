<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional jika nama tabel adalah 'pengembalians')
    protected $table = 'pengembalians';

    // Kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'peminjaman_id',
        'tanggal_pengembalian',
        'status',
    ];

    /**
     * Relasi many-to-one ke model Peminjaman
     */
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
}