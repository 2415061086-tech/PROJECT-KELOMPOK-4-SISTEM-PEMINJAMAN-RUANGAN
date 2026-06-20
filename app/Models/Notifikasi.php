<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';

    protected $fillable = [
        'id_mahasiswa', 'id_peminjaman',
        'judul', 'pesan', 'sudah_dibaca', 'dikirim_pada'
    ];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function peminjaman() {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
}