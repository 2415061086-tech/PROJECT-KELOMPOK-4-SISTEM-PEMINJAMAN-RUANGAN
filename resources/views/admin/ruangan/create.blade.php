@extends('layouts.admin')

@section('title', 'Tambah Ruangan')

@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-plus-circle"></i> Tambah Ruangan</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.ruangan.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kode Ruangan</label>
                    <input type="text" name="kode_ruangan" class="form-control" placeholder="GD-A-101" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="form-control" placeholder="Ruang Seminar A" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Gedung</label>
                    <input type="text" name="gedung" class="form-control" placeholder="Gedung A">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Lantai</label>
                    <input type="text" name="lantai" class="form-control" placeholder="1">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kapasitas (orang)</label>
                    <input type="number" name="kapasitas" class="form-control" placeholder="30" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-semibold">Fasilitas</label>
                    <textarea name="fasilitas" class="form-control" rows="3" placeholder="Proyektor, AC, Whiteboard"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="{{ route('admin.ruangan.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection