<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aset', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 20);
            $table->string('nama_barang', 100);
            $table->string('kondisi', 20)->default('Baik')->nullable();
            $table->string('lokasi', 50)->nullable();
            $table->timestamps();

            // Foreign key relasi ke tabel kategori (opsional jika tabel kategori ada)
            // $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};