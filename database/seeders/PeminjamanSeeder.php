<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\Mahasiswa;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Hash;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        // Buat mahasiswa sampel jika belum ada
        $mahasiswa = Mahasiswa::firstOrCreate(
            ['nim' => '2024001'],
            [
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'no_telepon' => '081234567890',
                'program_studi' => 'Teknik Elektro',
                'fakultas' => 'Teknik',
                'angkatan' => '2024',
                'password' => Hash::make('password123'),
            ]
        );

        $mahasiswa2 = Mahasiswa::firstOrCreate(
            ['nim' => '2024002'],
            [
                'nama_lengkap' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'no_telepon' => '082234567890',
                'program_studi' => 'Teknik Elektro',
                'fakultas' => 'Teknik',
                'angkatan' => '2024',
                'password' => Hash::make('password123'),
            ]
        );

        $mahasiswa3 = Mahasiswa::firstOrCreate(
            ['nim' => '2024003'],
            [
                'nama_lengkap' => 'Ahmad Rahmadi',
                'email' => 'ahmad@example.com',
                'no_telepon' => '083234567890',
                'program_studi' => 'Teknik Elektro',
                'fakultas' => 'Teknik',
                'angkatan' => '2024',
                'password' => Hash::make('password123'),
            ]
        );

        // Buat peminjaman sampel
        $today = now()->toDateString();
        $tomorrow = now()->addDay()->toDateString();
        $nextDay = now()->addDays(2)->toDateString();

        Peminjaman::firstOrCreate(
            [
                'id_mahasiswa' => $mahasiswa->id_mahasiswa,
                'id_ruangan' => 1,
                'tanggal' => $today,
                'jam_mulai' => '09:00:00',
            ],
            [
                'nama_kegiatan' => 'Seminar Teknik Elektro',
                'keperluan' => 'Acara seminar dengan pembicara dari industri',
                'jam_selesai' => '11:00:00',
                'jumlah_peserta' => 50,
                'status' => 'Disetujui',
            ]
        );

        Peminjaman::firstOrCreate(
            [
                'id_mahasiswa' => $mahasiswa2->id_mahasiswa,
                'id_ruangan' => 2,
                'tanggal' => $tomorrow,
                'jam_mulai' => '13:00:00',
            ],
            [
                'nama_kegiatan' => 'Rapat Koordinasi',
                'keperluan' => 'Rapat koordinasi tim proyekmu',
                'jam_selesai' => '14:30:00',
                'jumlah_peserta' => 20,
                'status' => 'Pending',
            ]
        );

        Peminjaman::firstOrCreate(
            [
                'id_mahasiswa' => $mahasiswa3->id_mahasiswa,
                'id_ruangan' => 3,
                'tanggal' => $nextDay,
                'jam_mulai' => '10:00:00',
            ],
            [
                'nama_kegiatan' => 'Workshop Robotika',
                'keperluan' => 'Workshop pembelajaran robotika untuk mahasiswa',
                'jam_selesai' => '12:00:00',
                'jumlah_peserta' => 100,
                'status' => 'Disetujui',
            ]
        );
    }
}
