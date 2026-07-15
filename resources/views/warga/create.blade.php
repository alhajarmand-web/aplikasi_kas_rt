@extends('layouts.admin')

@section('content')

<h3>Tambah Warga</h3>

<form method="POST" action="/warga/store">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control">
    </div>

    <div class="mb-3">
        <label>Keluarga</label>
        <select name="keluarga_id" class="form-control">
            <option value="">-- Pilih Keluarga (opsional) --</option>
            @foreach($keluarga as $k)
                <option value="{{ $k->id }}" {{ isset($selectedKeluarga) && $selectedKeluarga == $k->id ? 'selected' : '' }}>{{ $k->nama_keluarga ?: 'Keluarga #' . $k->id }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control">
    </div>

    <div class="mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control">
    </div>

    <button class="btn btn-success">Simpan</button>

</form>

@endsection