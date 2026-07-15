@extends('layouts.admin')

@section('content')

<div class="card card-custom p-4">
    <h4 class="mb-4">Tambah Pengurus RT</h4>

    <form action="/pengurus/store" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>RT / RW</label>
            <input type="text" name="rt_rw" class="form-control" placeholder="Contoh: RT 01 / RW 02">
        </div>

        <div class="mb-3">
            <label>Blok</label>
            <input type="text" name="blok" class="form-control" placeholder="Contoh: Blok A">
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non-aktif">Non-Aktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Masa Jabatan</label>
            <input type="text" name="masa_jabatan" class="form-control" placeholder="Contoh: 2024-2026">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="/pengurus" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>

@endsection
