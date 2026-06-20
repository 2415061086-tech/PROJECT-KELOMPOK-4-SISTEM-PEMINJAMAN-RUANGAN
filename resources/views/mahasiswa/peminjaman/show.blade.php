@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-eye"></i> Detail Peminjaman</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th width="200">Ruangan</th><td>{{ $peminjaman->ruangan->nama_ruangan }} ({{ $peminjaman->ruangan->kode_ruangan }})</td></tr>
            <tr><th>Nama Kegiatan</th><td>{{ $peminjaman->nama_kegiatan }}</td></tr>
            <tr><th>Keperluan</th><td>{{ $peminjaman->keperluan ?? '-' }}</td></tr>
            <tr><th>Tanggal</th><td>{{ \Carbon\Carbon::parse($peminjaman->tanggal)->format('d/m/Y') }}</td></tr>
            <tr><th>Jam</th><td>{{ $peminjaman->jam_mulai }} - {{ $peminjaman->jam_selesai }}</td></tr>
            <tr><th>Jumlah Peserta</th><td>{{ $peminjaman->jumlah_peserta }} orang</td></tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($peminjaman->status == 'Pending')
                        <span class="badge bg-warning text-dark fs-6">Pending</span>
                    @elseif($peminjaman->status == 'Disetujui')
                        <span class="badge bg-success fs-6">Disetujui</span>
                    @elseif($peminjaman->status == 'Ditolak')
                        <span class="badge bg-danger fs-6">Ditolak</span>
                    @else
                        <span class="badge bg-secondary fs-6">Dibatalkan</span>
                    @endif
                </td>
            </tr>
            @if($peminjaman->persetujuan)
            <tr><th>Diproses Oleh</th><td>{{ $peminjaman->persetujuan->admin->nama }}</td></tr>
            <tr><th>Catatan Admin</th><td>{{ $peminjaman->persetujuan->alasan_penolakan ?? '-' }}</td></tr>
            @endif
        </table>

        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection