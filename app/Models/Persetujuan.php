<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    protected $table = 'persetujuan';
    protected $primaryKey = 'id_persetujuan';

    protected $fillable = [
        'id_peminjaman', 'id_admin', 'status',
        'alasan_penolakan', 'diproses_pada'
    ];

    public function peminjaman() {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}