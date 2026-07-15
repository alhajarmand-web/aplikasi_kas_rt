@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Profil Keluarga</h3>
        <p class="text-muted mb-0">Daftar keluarga dan jumlah anggota.</p>
    </div>
    <div>
        <a href="/keluarga/create" class="btn btn-success">+ Tambah Keluarga</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-4">
    @forelse($keluarga as $k)
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <h5>{{ $k->nama_keluarga ?: 'Keluarga #' . $k->id }}</h5>
            <p class="text-muted mb-1">Kepala: {{ $k->kepala_keluarga ?: '-' }}</p>
            <p class="text-muted mb-2">Alamat: {{ $k->alamat ?: '-' }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="/keluarga/{{ $k->id }}" class="btn btn-primary btn-sm">Lihat Anggota</a>
                    <a href="/keluarga/edit/{{ $k->id }}" class="btn btn-warning btn-sm">Edit</a>
                </div>
                <div>
                    <span class="badge bg-primary">{{ $k->anggotas_count ?? 0 }} anggota</span>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card card-custom p-4 text-center text-muted">Belum ada data keluarga.</div>
    </div>
    @endforelse
</div>

@if(method_exists($keluarga, 'links'))
<div class="mt-3">
    {{ $keluarga->links() }}
</div>
@endif

@endsection
