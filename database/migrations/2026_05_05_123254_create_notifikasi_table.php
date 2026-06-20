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
        Schema::create('notifikasi', function (Blueprint $table) {
        $table->id('id_notifikasi');
        $table->unsignedBigInteger('id_mahasiswa');
        $table->unsignedBigInteger('id_peminjaman');
        $table->string('judul', 150)->nullable();
        $table->text('pesan')->nullable();
        $table->boolean('sudah_dibaca')->default(false);
        $table->timestamp('dikirim_pada')->nullable();
        $table->timestamps();

        $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
        $table->foreign('id_peminjaman')->references('id_peminjaman')->on('peminjaman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
