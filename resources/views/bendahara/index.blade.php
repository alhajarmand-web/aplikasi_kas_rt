@extends('layouts.admin')

@section('content')

@php
    $totalKas = $kasMasuk - $kasKeluar;
@endphp

<h3 class="mb-4">Dashboard Bendahara</h3>

<div class="row g-4">

    <!-- TOTAL KAS -->
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <h6>Total Kas</h6>
            <h3 class="text-success">
                Rp {{ number_format($totalKas, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <!-- KAS MASUK -->
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <h6>Kas Masuk</h6>
            <h3 class="text-primary">
                Rp {{ number_format($kasMasuk, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <!-- KAS KELUAR -->
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <h6>Kas Keluar</h6>
            <h3 class="text-danger">
                Rp {{ number_format($kasKeluar, 0, ',', '.') }}
            </h3>
        </div>
    </div>

</div>

<hr class="my-4">

<div class="card card-custom p-4">
    <h4>Kegiatan RT</h4>

    <ul class="mt-3">
        <li>Kerja bakti setiap minggu</li>
        <li>Rapat bulanan RT</li>
        <li>Iuran kas warga</li>
    </ul>
</div>

@endsection