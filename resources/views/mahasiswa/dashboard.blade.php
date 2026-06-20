@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h4 class="fw-bold mb-4">
    <i class="bi bi-house"></i> Halo, {{ Auth::guard('mahasiswa')->user()->nama_lengkap }}! 👋
</h4>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card bg-warning text-dark shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold">{{ $totalPending }}</div>
                    <div>Pending</div>
                </div>
                <i class="bi bi-hourglass-split fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold">{{ $totalDisetujui }}</div>
                    <div>Disetujui</div>
                </div>
                <i class="bi bi-check-circle fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold">{{ $totalDitolak }}</div>
                    <div>Ditolak</div>
                </div>
                <i class="bi bi-x-circle fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-clock-history"></i> Peminjaman Terbaru Saya
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ruangan</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamanTerbaru as $p)
                <tr>
                    <td>{{ $p->ruangan->nama_ruangan }}</td>
                    <td>{{ $p->nama_kegiatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td>
                        @if($p->status == 'Pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($p->status == 'Disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($p->status == 'Ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-secondary">Dibatalkan</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('peminjaman.show', $p->id_peminjaman) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajukan Peminjaman Baru
        </a>
    </div>
</div>


@endsection