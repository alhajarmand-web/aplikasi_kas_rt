@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Keluarga: {{ $keluarga->nama_keluarga ?: 'Keluarga #' . $keluarga->id }}</h3>
        <p class="text-muted mb-0">Kepala: {{ $keluarga->kepala_keluarga ?: '-' }}</p>
    </div>
    <div>
        <a href="/warga/create?keluarga_id={{ $keluarga->id }}" class="btn btn-success">+ Tambah Anggota</a>
        <a href="/keluarga" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<div class="card card-custom p-3">
    <h6>Daftar Anggota</h6>

    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggota as $a)
                <tr>
                    <td>{{ $loop->iteration + ($anggota->firstItem() - 1) }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->alamat }}</td>
                    <td>{{ $a->no_hp }}</td>
                    <td>
                        <a href="/warga/edit/{{ $a->id }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/warga/delete/{{ $a->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus anggota?')">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada anggota.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $anggota->links() }}
    </div>
</div>

@endsection
