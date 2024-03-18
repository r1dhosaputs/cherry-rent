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
        Schema::create('kostum', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kostum')->unique();
            $table->string('nama_kostum');
            $table->bigInteger('harga_kostum');
            $table->foreignId('kategori_kostum_id');
            $table->string('ukuran_kostum', 50); // XS S M L XL XXL XXXL
            // ->constrained('kategori_kostum', 'id');
            $table->tinyInteger('status_peminjaman')->default(0); // 0 = sedang dipinjam, 1 = sudah dikembalikan
            $table->text('deskripsi_kostum');
            $table->text('foto_kostum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kostum');
    }
};
