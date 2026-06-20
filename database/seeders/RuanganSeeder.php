<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $ruangan = [
            ['kode_ruangan' => 'GD-A-101', 'nama_ruangan' => 'Ruang Seminar A', 'gedung' => 'Gedung A', 'lantai' => '1', 'kapasitas' => 50, 'status' => 'Tersedia', 'fasilitas' => 'Proyektor, AC, Whiteboard'],
            ['kode_ruangan' => 'GD-A-102', 'nama_ruangan' => 'Ruang Rapat A', 'gedung' => 'Gedung A', 'lantai' => '1', 'kapasitas' => 20, 'status' => 'Tersedia', 'fasilitas' => 'AC, Whiteboard'],
            ['kode_ruangan' => 'GD-B-201', 'nama_ruangan' => 'Aula Utama', 'gedung' => 'Gedung B', 'lantai' => '2', 'kapasitas' => 200, 'status' => 'Tersedia', 'fasilitas' => 'Sound System, Proyektor, AC'],
            ['kode_ruangan' => 'GD-B-202', 'nama_ruangan' => 'Lab Komputer', 'gedung' => 'Gedung B', 'lantai' => '2', 'kapasitas' => 30, 'status' => 'Maintenance', 'fasilitas' => 'Komputer, AC'],
        ];

        foreach ($ruangan as $r) {
            Ruangan::firstOrCreate(
                ['kode_ruangan' => $r['kode_ruangan']],
                $r
            );
        }
    }
}