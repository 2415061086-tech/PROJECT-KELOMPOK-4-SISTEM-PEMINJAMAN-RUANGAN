@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-bell"></i> Notifikasi</h4>

@forelse($notifikasi as $n)
<div class="card shadow-sm mb-3 {{ $n->sudah_dibaca ? '' : 'border-primary' }}">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h6 class="fw-bold {{ $n->sudah_dibaca ? 'text-muted' : 'text-primary' }}">
                @if(!$n->sudah_dibaca)
                    <span class="badge bg-primary me-1">Baru</span>
                @endif
                {{ $n->judul }}
            </h6>
            <small class="text-muted">
                {{ \Carbon\Carbon::parse($n->dikirim_pada)->format('d/m/Y H:i') }}
            </small>
        </div>
        <p class="mb-1">{{ $n->pesan }}</p>
        <a href="{{ route('peminjaman.show', $n->id_peminjaman) }}" class="btn btn-sm btn-outline-primary mt-1">
            <i class="bi bi-eye"></i> Lihat Detail
        </a>
    </div>
</div>
@empty
<div class="alert alert-info">
    <i class="bi bi-info-circle"></i> Belum ada notifikasi.
</div>
@endforelse
@endsection