<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'id_ruangan';

    protected $fillable = [
        'kode_ruangan', 'nama_ruangan', 'gedung',
        'lantai', 'kapasitas', 'fasilitas', 'status'
    ];

    public function peminjaman() {
        return $this->hasMany(Peminjaman::class, 'id_ruangan');
    }
}