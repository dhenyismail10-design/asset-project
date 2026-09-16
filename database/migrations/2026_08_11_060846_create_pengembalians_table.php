<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')
                  ->constrained('peminjamans') // Menghubungkan ke tabel peminjamans
                  ->onDelete('cascade');
            $table->date('tanggal_pengembalian');
            $table->string('status')->default('Dikembalikan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};