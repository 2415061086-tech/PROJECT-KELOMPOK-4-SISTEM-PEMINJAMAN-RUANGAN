<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['ruangan', 'persetujuan'])
            ->where('id_mahasiswa', Auth::guard('mahasiswa')->id())
            ->latest()
            ->get();
        return view('mahasiswa.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $ruangan = Ruangan::where('status', 'Tersedia')->get();
        return view('mahasiswa.peminjaman.create', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan'     => 'required',
            'nama_kegiatan'  => 'required',
            'tanggal'        => 'required|date|after_or_equal:today',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required|after:jam_mulai',
            'jumlah_peserta' => 'required|integer|min:1',
        ]);

        Peminjaman::create([
            'id_mahasiswa'   => Auth::guard('mahasiswa')->id(),
            'id_ruangan'     => $request->id_ruangan,
            'nama_kegiatan'  => $request->nama_kegiatan,
            'keperluan'      => $request->keperluan,
            'tanggal'        => $request->tanggal,
            'jam_mulai'      => $request->jam_mulai,
            'jam_selesai'    => $request->jam_selesai,
            'jumlah_peserta' => $request->jumlah_peserta,
            'status'         => 'Pending',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['ruangan', 'persetujuan.admin'])
            ->where('id_mahasiswa', Auth::guard('mahasiswa')->id())
            ->findOrFail($id);
        return view('mahasiswa.peminjaman.show', compact('peminjaman'));
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::where('id_mahasiswa', Auth::guard('mahasiswa')->id())
            ->where('status', 'Pending')
            ->findOrFail($id);
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman dibatalkan!');
    }
}