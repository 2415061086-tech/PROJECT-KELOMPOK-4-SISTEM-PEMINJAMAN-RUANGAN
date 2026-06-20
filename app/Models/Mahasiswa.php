<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $rememberTokenName = false;

    protected $fillable = [
        'nim', 'nama_lengkap', 'email', 'no_telepon',
        'program_studi', 'fakultas', 'angkatan', 'password'
    ];

    protected $hidden = ['password'];

    public function peminjaman() {
        return $this->hasMany(Peminjaman::class, 'id_mahasiswa');
    }

    public function notifikasi() {
        return $this->hasMany(Notifikasi::class, 'id_mahasiswa');
    }
}