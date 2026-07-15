@extends('layouts.admin')

@section('content')

<div class="card card-custom p-4">
    <h4 class="mb-4">Edit Pengurus RT</h4>

    <form action="/pengurus/update/{{ $pengurus->id }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $pengurus->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ $pengurus->jabatan }}" required>
        </div>

        <div class="mb-3">
            <label>RT / RW</label>
            <input type="text" name="rt_rw" class="form-control" value="{{ $pengurus->rt_rw }}" placeholder="Contoh: RT 01 / RW 02">
        </div>

        <div class="mb-3">
            <label>Blok</label>
            <input type="text" name="blok" class="form-control" value="{{ $pengurus->blok }}" placeholder="Contoh: Blok A">
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pengurus->no_hp }}" placeholder="08xxxxxxxxxx">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="aktif" {{ $pengurus->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="non-aktif" {{ $pengurus->status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Masa Jabatan</label>
            <input type="text" name="masa_jabatan" class="form-control" value="{{ $pengurus->masa_jabatan }}" placeholder="Contoh: 2024-2026">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="/pengurus" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>

@endsection
