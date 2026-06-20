@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-plus-circle"></i> Ajukan Peminjaman Ruangan</h4>

<div class="card shadow-sm">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('peminjaman.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Pilih Ruangan</label>
                    <select name="id_ruangan" class="form-select" required>
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach($ruangan as $r)
                            <option value="{{ $r->id_ruangan }}">
                                {{ $r->nama_ruangan }} ({{ $r->kode_ruangan }}) - Kapasitas: {{ $r->kapasitas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="form-control"
                        placeholder="Rapat, Seminar, dll" value="{{ old('nama_kegiatan') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                        min="{{ date('Y-m-d') }}" value="{{ old('tanggal') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jumlah Peserta</label>
                    <input type="number" name="jumlah_peserta" class="form-control"
                        placeholder="30" min="1" value="{{ old('jumlah_peserta') }}" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-semibold">Keperluan / Keterangan</label>
                    <textarea name="keperluan" class="form-control" rows="3"
                        placeholder="Jelaskan keperluan peminjaman...">{{ old('keperluan') }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send"></i> Kirim Pengajuan
            </button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection