@extends('layouts.admin')

@section('content')

<div class="card card-custom p-4">

    <h4 class="mb-4">Tambah User</h4>

    <form action="/user/store" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role</label>

            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="bendahara">Bendahara</option>
                <option value="warga">Warga</option>
            </select>
        </div>

        <button class="btn btn-primary">
            Simpan
        </button>

        <a href="/user" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection