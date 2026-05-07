@extends('layouts.admin')

@section('content')

<h4>Edit User</h4>

<form method="POST" action="/user/update/{{ $user->id }}">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
            <option value="bendahara" {{ $user->role=='bendahara' ? 'selected' : '' }}>Bendahara</option>
            <option value="warga" {{ $user->role=='warga' ? 'selected' : '' }}>Warga</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection