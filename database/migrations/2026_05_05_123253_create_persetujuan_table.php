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
        Schema::create('persetujuan', function (Blueprint $table) {
        $table->id('id_persetujuan');
        $table->unsignedBigInteger('id_peminjaman')->unique();
        $table->unsignedBigInteger('id_admin');
        $table->enum('status', ['Disetujui', 'Ditolak']);
        $table->text('alasan_penolakan')->nullable();
        $table->timestamp('diproses_pada')->nullable();
        $table->timestamps();

        $table->foreign('id_peminjaman')->references('id_peminjaman')->on('peminjaman')->onDelete('cascade');
        $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persetujuan');
    }
};
