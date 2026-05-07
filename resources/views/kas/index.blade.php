@extends('layouts.admin')

@section('content')

<h3>Data Kas</h3>

<a href="/kas/create" class="btn btn-primary mb-3">+ Tambah Data</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Jenis</th>
        <th>Jumlah</th>
        <th>Aksi</th>
    </tr>

    @foreach($kas as $k)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $k->tanggal }}</td>
        <td>{{ $k->keterangan }}</td>
        <td>
            <span class="{{ $k->jenis == 'masuk' ? 'text-success' : 'text-danger' }}">
                {{ ucfirst($k->jenis) }}
            </span>
        </td>
        <td>Rp {{ number_format($k->jumlah) }}</td>
        <td>
            <a href="/kas/edit/{{ $k->id }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="/kas/delete/{{ $k->id }}" class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    @endforeach

</table>

@endsection