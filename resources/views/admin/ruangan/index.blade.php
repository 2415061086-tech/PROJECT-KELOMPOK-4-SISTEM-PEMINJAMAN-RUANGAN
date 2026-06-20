@extends('layouts.admin')

@section('title', 'Kelola Ruangan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-building"></i> Kelola Ruangan</h4>
    <a href="{{ route('admin.ruangan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Ruangan
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Ruangan</th>
                    <th>Gedung</th>
                    <th>Lantai</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruangan as $i => $r)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><span class="badge bg-secondary">{{ $r->kode_ruangan }}</span></td>
                    <td>{{ $r->nama_ruangan }}</td>
                    <td>{{ $r->gedung ?? '-' }}</td>
                    <td>{{ $r->lantai ?? '-' }}</td>
                    <td>{{ $r->kapasitas }} orang</td>
                    <td>
                        @if($r->status == 'Tersedia')
                            <span class="badge bg-success">Tersedia</span>
                        @elseif($r->status == 'Tidak Tersedia')
                            <span class="badge bg-danger">Tidak Tersedia</span>
                        @else
                            <span class="badge bg-warning text-dark">Maintenance</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.ruangan.edit', $r->id_ruangan) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.ruangan.destroy', $r->id_ruangan) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Hapus ruangan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada ruangan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection