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
        Schema::create('ruangan', function (Blueprint $table) {
        $table->id('id_ruangan');
        $table->string('kode_ruangan', 20)->unique();
        $table->string('nama_ruangan', 100);
        $table->string('gedung', 50)->nullable();
        $table->string('lantai', 10)->nullable();
        $table->integer('kapasitas')->nullable();
        $table->text('fasilitas')->nullable();
        $table->enum('status', ['Tersedia', 'Tidak Tersedia', 'Maintenance'])->default('Tersedia');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};
