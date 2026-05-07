@extends('layouts.admin')

@section('content')

<h3>Laporan Kas</h3>

<!-- FILTER -->
<form method="POST" action="/laporan/filter" class="row mb-3">
    @csrf
    <div class="col-md-3">
        <input type="date" name="tanggal_awal" class="form-control" required>
    </div>
    <div class="col-md-3">
        <input type="date" name="tanggal_akhir" class="form-control" required>
    </div>
    <div class="col-md-3">
        <button class="btn btn-primary">Filter</button>
        <a href="/laporan" class="btn btn-secondary">Reset</a>
    </div>
</form>

<!-- HITUNG TOTAL -->
@php
$totalMasuk = $kas->where('jenis','masuk')->sum('jumlah');
$totalKeluar = $kas->where('jenis','keluar')->sum('jumlah');
$total = $totalMasuk - $totalKeluar;
@endphp

<div class="row mb-3">
    <div class="col-md-4">
        <div class="card bg-success text-white p-3">
            Kas Masuk: Rp {{ number_format($totalMasuk) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white p-3">
            Kas Keluar: Rp {{ number_format($totalKeluar) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-primary text-white p-3">
            Total Kas: Rp {{ number_format($total) }}
        </div>
    </div>
</div>

<!-- TABEL -->
<table class="table table-bordered">
    <tr>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Jenis</th>
        <th>Jumlah</th>
    </tr>

    @foreach($kas as $k)
    <tr>
        <td>{{ $k->tanggal }}</td>
        <td>{{ $k->keterangan }}</td>
        <td>{{ ucfirst($k->jenis) }}</td>
        <td>Rp {{ number_format($k->jumlah) }}</td>
    </tr>
    @endforeach

</table>

<!-- PRINT -->
<button onclick="window.print()" class="btn btn-dark">Print</button>

@endsection