@extends('layouts.admin')

@section('content')

<h4>Data User</h4>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="/user/create" class="btn btn-primary">
        + Tambah User
    </a>

    <form action="/user" method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Cari nama, email, atau role">
        <button type="submit" class="btn btn-outline-secondary">Cari</button>
        @if(request('search'))
            <a href="/user" class="btn btn-outline-danger">Reset</a>
        @endif
    </form>
</div>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    @forelse($users as $u)
    <tr>
        <td>{{ $users->firstItem() ? $users->firstItem() + $loop->index : 0 }}</td>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->role }}</td>
        <td>
            <a href="/user/edit/{{ $u->id }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="/user/delete/{{ $u->id }}" class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center text-muted">Tidak ada data user yang cocok.</td>
    </tr>
    @endforelse
</table>

<div class="d-flex justify-content-end">
    {{ $users->links() }}
</div>

@endsection