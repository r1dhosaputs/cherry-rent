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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kostum_id');
            //->constrained(); // Kunci asing untuk menghubungkan dengan tabel kostum
            $table->string('nomor_identitas_peminjam'); // NOMOR NIK/KK
            $table->string('nama_peminjam');
            $table->string('nomor_hp_peminjam'); // kyk 08551356
            $table->string('sosial_media_peminjam'); // kyk ig @ridho
            $table->string('alamat_peminjam'); // Provinsi
            $table->string('alamat_peminjam_2'); // Kota
            $table->string('alamat_peminjam_3'); // Komplek .... misal
            $table->text('data_peminjam');
            $table->string('lama_meminjam');
            $table->dateTime('tanggal_peminjaman');
            $table->dateTime('tanggal_pengembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
