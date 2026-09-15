<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('kategoris', 'nama_kategori')) {
            Schema::table('kategoris', function (Blueprint $table) {
                $table->string('nama_kategori')->after('id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('kategoris', 'nama_kategori')) {
            Schema::table('kategoris', function (Blueprint $table) {
                $table->dropColumn('nama_kategori');
            });
        }
    }
};
