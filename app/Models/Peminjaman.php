<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_mahasiswa', 'id_ruangan', 'nama_kegiatan',
        'keperluan', 'tanggal', 'jam_mulai', 'jam_selesai',
        'jumlah_peserta', 'status'
    ];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function ruangan() {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function persetujuan() {
        return $this->hasOne(Persetujuan::class, 'id_peminjaman');
    }

    public function notifikasi() {
        return $this->hasMany(Notifikasi::class, 'id_peminjaman');
    }
}