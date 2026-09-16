<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asets', function (Blueprint $table) {
    $table->id();
    $table->string('kode_barang')->nullable();
    $table->string('nama_aset');
    $table->string('kondisi')->default('Baik');
    $table->string('lokasi')->nullable();
    $table->unsignedBigInteger('kategori_id')->nullable();
    $table->unsignedBigInteger('lokasi_id')->nullable();
    $table->integer('jumlah')->default(1);
    $table->string('status')->default('Tersedia');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};