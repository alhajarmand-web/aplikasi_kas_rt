@extends('layouts.admin')

@section('content')

<h3>Edit Warga</h3>

<form method="POST" action="/warga/update/{{ $warga->id }}">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" value="{{ $warga->nama }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Keluarga</label>
        <select name="keluarga_id" class="form-control">
            <option value="">-- Pilih Keluarga (opsional) --</option>
            @foreach(\App\Models\Keluarga::all() as $k)
                <option value="{{ $k->id }}" {{ $warga->keluarga_id == $k->id ? 'selected' : '' }}>{{ $k->nama_keluarga ?: 'Keluarga #' . $k->id }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" value="{{ $warga->alamat }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" value="{{ $warga->no_hp }}" class="form-control">
    </div>

    <button class="btn btn-primary">Update</button>

</form>

@endsection