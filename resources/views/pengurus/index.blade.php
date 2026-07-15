@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Dashboard Data Pengurus RT</h3>
        <p class="text-muted mb-0">Ringkasan dan daftar pengurus RT yang terdaftar.</p>
    </div>
    <div>
        <a href="/pengurus/create" class="btn btn-success">
            + Tambah Pengurus
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-custom p-4">
            <h6>Total Pengurus</h6>
            <h3 class="text-primary">{{ number_format($totalPengurus) }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom p-4">
            <h6>Pengurus Aktif</h6>
            <h3 class="text-success">{{ number_format($activePengurus) }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom p-4">
            <h6>Jumlah Jabatan</h6>
            <h3 class="text-warning">{{ $jabatanSummary->count() }}</h3>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card card-custom p-4">
            <h6>Jabatan Terdaftar</h6>
            <ul class="list-unstyled mt-3 mb-0">
                @forelse($jabatanSummary as $jabatan)
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span>{{ $jabatan->jabatan }}</span>
                        <span class="badge bg-primary">{{ $jabatan->total }}</span>
                    </li>
                @empty
                    <li class="text-muted">Belum ada data jabatan.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-custom p-4">
            <h6>RT/RW Terdata</h6>
            <ul class="list-unstyled mt-3 mb-0">
                @forelse($rtRwSummary as $rt)
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span>{{ $rt->rt_rw ?: 'Belum diisi' }}</span>
                        <span class="badge bg-secondary">{{ $rt->total }}</span>
                    </li>
                @empty
                    <li class="text-muted">Belum ada data RT/RW.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<form method="GET" action="/pengurus" class="mb-4">
    <div class="row gy-2 gx-3 align-items-center">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Cari nama / jabatan / blok / RT/RW" value="{{ request('search') }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Cari</button>
        </div>
    </div>
</form>

<div class="card card-custom p-3">
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-primary">
                <tr>
                    <th width="60">No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>RT/RW</th>
                    <th>Blok</th>
                    <th>No HP</th>
                    <th>Masa Jabatan</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengurus as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($pengurus->firstItem() - 1) }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->rt_rw }}</td>
                        <td>{{ $item->blok }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->masa_jabatan }}</td>
                        <td>
                            <span class="badge {{ $item->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="/pengurus/edit/{{ $item->id }}" class="btn btn-warning btn-sm me-1">Edit</a>
                            <a href="/pengurus/delete/{{ $item->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data pengurus?')">Hapus</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data pengurus RT.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $pengurus->links() }}
    </div>
</div>

@endsection
