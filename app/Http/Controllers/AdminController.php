<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Peminjaman;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalRuangan'     => Ruangan::count(),
            'totalPending'     => Peminjaman::where('status', 'Pending')->count(),
            'totalDisetujui'   => Peminjaman::where('status', 'Disetujui')->count(),
            'totalDitolak'     => Peminjaman::where('status', 'Ditolak')->count(),
            'peminjamanTerbaru' => Peminjaman::with(['mahasiswa', 'ruangan'])
                                    ->latest()->take(5)->get(),
        ]);
    }
}