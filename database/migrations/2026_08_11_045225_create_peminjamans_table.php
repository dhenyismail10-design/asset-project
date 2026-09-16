<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            // Disesuaikan ke aset_id dan tabel 'asets' (pilihan aman tanpa foreign constraint ketat)
            $table->unsignedBigInteger('aset_id');
            $table->string('peminjam');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('kondisi_awal', ['Baik', 'Rusak Ringan']);
            $table->string('bukti_pinjam')->nullable();
            $table->text('keperluan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};