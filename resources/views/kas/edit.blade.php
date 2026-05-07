@extends('layouts.admin')

@section('content')

<h4>Edit Data Kas</h4>

<form action="/kas/update/{{ $kas->id }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="{{ $kas->tanggal }}" required>
    </div>

    <div class="mb-3">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" value="{{ $kas->keterangan }}" required>
    </div>

    <div class="mb-3">
        <label>Jenis</label>
        <select name="jenis" class="form-control" required>
            <option value="masuk" {{ $kas->jenis == 'masuk' ? 'selected' : '' }}>Masuk</option>
            <option value="keluar" {{ $kas->jenis == 'keluar' ? 'selected' : '' }}>Keluar</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" value="{{ $kas->jumlah }}" required>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="/kas" class="btn btn-secondary">Kembali</a>

</form>

@endsection