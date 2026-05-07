<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Warga</title>
</head>
<body>

<h1>Dashboard Warga</h1>
<p>Selamat datang, {{ auth()->user()->name }}</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

</body>
</html>