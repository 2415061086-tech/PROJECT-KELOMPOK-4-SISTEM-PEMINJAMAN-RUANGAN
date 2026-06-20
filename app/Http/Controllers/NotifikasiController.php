<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::with('peminjaman')
            ->where('id_mahasiswa', Auth::guard('mahasiswa')->id())
            ->latest('dikirim_pada')
            ->get();

        // Tandai semua sudah dibaca
        Notifikasi::where('id_mahasiswa', Auth::guard('mahasiswa')->id())
            ->where('sudah_dibaca', false)
            ->update(['sudah_dibaca' => true]);

        return view('mahasiswa.notifikasi', compact('notifikasi'));
    }
}