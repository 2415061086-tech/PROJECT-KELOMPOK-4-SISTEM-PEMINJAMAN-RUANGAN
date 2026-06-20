@extends('layouts.admin')

@section('title', 'Edit Ruangan')

@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-pencil"></i> Edit Ruangan</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.ruangan.update', $ruangan->id_ruangan) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kode Ruangan</label>
                    <input type="text" name="kode_ruangan" class="form-control" value="{{ $ruangan->kode_ruangan }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="form-control" value="{{ $ruangan->nama_ruangan }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Gedung</label>
                    <input type="text" name="gedung" class="form-control" value="{{ $ruangan->gedung }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Lantai</label>
                    <input type="text" name="lantai" class="form-control" value="{{ $ruangan->lantai }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kapasitas (orang)</label>
                    <input type="number" name="kapasitas" class="form-control" value="{{ $ruangan->kapasitas }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="Tersedia" {{ $ruangan->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Tidak Tersedia" {{ $ruangan->status == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                        <option value="Maintenance" {{ $ruangan->status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-semibold">Fasilitas</label>
                    <textarea name="fasilitas" class="form-control" rows="3">{{ $ruangan->fasilitas }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-warning">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="{{ route('admin.ruangan.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection