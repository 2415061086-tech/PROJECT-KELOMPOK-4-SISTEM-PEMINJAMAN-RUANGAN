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
        $table->id('id_peminjaman');
        $table->unsignedBigInteger('id_mahasiswa');
        $table->unsignedBigInteger('id_ruangan');
        $table->string('nama_kegiatan', 150);
        $table->text('keperluan')->nullable();
        $table->date('tanggal');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->integer('jumlah_peserta')->nullable();
        $table->enum('status', ['Pending', 'Disetujui', 'Ditolak', 'Dibatalkan'])->default('Pending');
        $table->timestamps();

        $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
        $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
