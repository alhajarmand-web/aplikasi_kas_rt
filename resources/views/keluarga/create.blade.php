@extends('layouts.admin')

@section('content')

<div class="card card-custom p-4">
    <h4 class="mb-4">Tambah Keluarga</h4>

    <form action="/keluarga/store" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Keluarga</label>
            <input type="text" name="nama_keluarga" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kepala Keluarga</label>
            <input type="text" name="kepala_keluarga" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control">
        </div>

        <div class="mb-3">
            <label>RT/RW</label>
            <input type="text" name="rt_rw" class="form-control">
        </div>

        <div class="mb-3">
            <label>Blok</label>
            <input type="text" name="blok" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="/keluarga" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>

@endsection
