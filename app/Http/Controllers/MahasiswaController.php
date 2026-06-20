<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $id = Auth::guard('mahasiswa')->id();

        return view('mahasiswa.dashboard', [
            'totalPending'     => Peminjaman::where('id_mahasiswa', $id)->where('status', 'Pending')->count(),
            'totalDisetujui'   => Peminjaman::where('id_mahasiswa', $id)->where('status', 'Disetujui')->count(),
            'totalDitolak'     => Peminjaman::where('id_mahasiswa', $id)->where('status', 'Ditolak')->count(),
            'peminjamanTerbaru' => Peminjaman::with('ruangan')
                                    ->where('id_mahasiswa', $id)
                                    ->latest()->take(5)->get(),
        ]);
    }
}