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
        Schema::create('mahasiswa', function (Blueprint $table) {
        $table->id('id_mahasiswa');
        $table->string('nim', 20)->unique();
        $table->string('nama_lengkap', 100);
        $table->string('email', 100)->unique();
        $table->string('no_telepon', 15)->nullable();
        $table->string('program_studi', 100)->nullable();
        $table->string('fakultas', 100)->nullable();
        $table->year('angkatan')->nullable();
        $table->string('password', 255);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
