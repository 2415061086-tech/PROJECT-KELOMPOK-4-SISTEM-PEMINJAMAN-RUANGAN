@extends('layouts.admin')

@section('title', 'Persetujuan Peminjaman')

@section('content')
<h4 class="fw-bold mb-4">
    <i class="bi bi-clipboard-check"></i> Persetujuan Peminjaman
</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-danger">
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Ruangan</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Peserta</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <strong>{{ $p->mahasiswa->nama_lengkap }}</strong><br>
                        <small class="text-muted">{{ $p->mahasiswa->nim }}</small>
                    </td>
                    <td>{{ $p->ruangan->nama_ruangan }}<br>
                        <small class="text-muted">{{ $p->ruangan->kode_ruangan }}</small>
                    </td>
                    <td>{{ $p->nama_kegiatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
                    <td>{{ $p->jumlah_peserta }} org</td>
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
                        @if($p->status == 'Pending')
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalProses{{ $p->id_peminjaman }}">
                            <i class="bi bi-check2-square"></i> Proses
                        </button>
                        @else
                        <span class="text-muted small">Sudah diproses</span>
                        @endif
                    </td>
                </tr>

                {{-- Modal Proses --}}
                <div class="modal fade" id="modalProses{{ $p->id_peminjaman }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Proses Peminjaman</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.persetujuan', $p->id_peminjaman) }}">
                                @csrf
                                <div class="modal-body">
                                    <table class="table table-sm table-bordered mb-3">
                                        <tr><th>Mahasiswa</th><td>{{ $p->mahasiswa->nama_lengkap }}</td></tr>
                                        <tr><th>Ruangan</th><td>{{ $p->ruangan->nama_ruangan }}</td></tr>
                                        <tr><th>Kegiatan</th><td>{{ $p->nama_kegiatan }}</td></tr>
                                        <tr><th>Tanggal</th><td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td></tr>
                                        <tr><th>Jam</th><td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td></tr>
                                        <tr><th>Keperluan</th><td>{{ $p->keperluan ?? '-' }}</td></tr>
                                    </table>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Keputusan</label>
                                        <select name="status" class="form-select" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Disetujui">✅ Disetujui</option>
                                            <option value="Ditolak">❌ Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Catatan (opsional)</label>
                                        <textarea name="alasan_penolakan" class="form-control" rows="3"
                                            placeholder="Alasan penolakan atau catatan..."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-send"></i> Kirim Keputusan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">Belum ada pengajuan peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection