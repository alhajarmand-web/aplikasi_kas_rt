@php
$totalMasuk = \App\Models\Kas::where('jenis','masuk')->sum('jumlah');
$totalKeluar = \App\Models\Kas::where('jenis','keluar')->sum('jumlah');
$totalKas = $totalMasuk - $totalKeluar;
@endphp

@extends('layouts.admin')


@section('content')

<h4 class="mb-4">Dashboard</h4>

<div class="row">

    <!-- TOTAL KAS -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Total Kas</h6>
                 <h3 class="text-success">
                    Rp {{ number_format($totalKas) }}
                </h3>
            </div>
        </div>
    </div>
    

    <!-- KAS MASUK -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Kas Masuk</h6>
                <h3 class="text-primary">
                    Rp {{ number_format($totalMasuk) }}
                </h3>
            </div>
        </div>
    </div>

    <!-- KAS KELUAR -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Kas Keluar</h6>
                 <h3 class="text-danger">
                    Rp {{ number_format($totalKeluar) }}
                </h3>
            </div>
        </div>
    </div>

</div>

<hr>

<!-- KEGIATAN -->
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5>Kegiatan RT</h5>
        <ul>
            <li>Kerja bakti setiap minggu</li>
            <li>Rapat bulanan RT</li>
            <li>Iuran kas warga</li>
        </ul>
    </div>
</div>

<hr>




@endsection