@extends('layouts.app')

@section('title', 'Peminjaman Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-calendar-check"></i> Peminjaman Saya</h4>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Ajukan Baru
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Ruangan</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->ruangan->nama_ruangan }}</td>
                    <td>{{ $p->nama_kegiatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
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
                        @if($p->status == 'Pending')
                        <form action="{{ route('peminjaman.destroy', $p->id_peminjaman) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Batalkan peminjaman ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada pengajuan peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection