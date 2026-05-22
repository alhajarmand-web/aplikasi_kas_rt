@extends('layouts.admin')

@section('content')

<h4>Data User</h4>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<a href="/user/create" class="btn btn-primary mb-3">
    + Tambah User
</a>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    @foreach($user as $u)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->role }}</td>
        <td>
            <a href="/user/edit/{{ $u->id }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="/user/delete/{{ $u->id }}" class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    @endforeach

</table>

@endsection