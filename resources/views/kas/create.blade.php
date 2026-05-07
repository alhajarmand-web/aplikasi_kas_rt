@extends('layouts.admin')

@section('content')

<h3>Tambah Data Kas</h3>

@if ($errors->any())
<div class="alert alert-danger">
    {{ $errors->first() }}
</div>
@endif

<form method="POST" action="/kas/store">
    @csrf

    <div class="mb-3">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Jenis</label>
        <select name="jenis" class="form-control">
            <option value="masuk">Kas Masuk</option>
            <option value="keluar">Kas Keluar</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="/kas" class="btn btn-secondary">Kembali</a>

</form>

@endsection