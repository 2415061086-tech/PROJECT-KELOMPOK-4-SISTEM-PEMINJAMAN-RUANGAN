<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Persetujuan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersetujuanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['mahasiswa', 'ruangan', 'persetujuan'])
            ->latest()
            ->get();
        return view('admin.persetujuan.index', compact('peminjaman'));
    }

    public function proses(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        // Simpan persetujuan
        Persetujuan::updateOrCreate(
            ['id_peminjaman' => $peminjaman->id_peminjaman],
            [
                'id_admin'          => Auth::guard('admin')->id(),
                'status'            => $request->status,
                'alasan_penolakan'  => $request->alasan_penolakan,
                'diproses_pada'     => now(),
            ]
        );

        // Update status peminjaman
        $peminjaman->update(['status' => $request->status]);

        // Kirim notifikasi ke mahasiswa
        Notifikasi::create([
            'id_mahasiswa'  => $peminjaman->id_mahasiswa,
            'id_peminjaman' => $peminjaman->id_peminjaman,
            'judul'         => 'Status Peminjaman ' . $request->status,
            'pesan'         => 'Peminjaman ruangan untuk kegiatan "' . $peminjaman->nama_kegiatan . '" telah ' . $request->status . '.' .
                               ($request->alasan_penolakan ? ' Catatan: ' . $request->alasan_penolakan : ''),
            'dikirim_pada'  => now(),
        ]);

        return redirect()->route('admin.peminjaman')->with('success', 'Peminjaman berhasil diproses!');
    }
}