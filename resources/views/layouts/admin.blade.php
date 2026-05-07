<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Kas RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       .topbar-custom{
    width:100%;
    display:flex;
    justify-content:flex-end;
    align-items:center;
    margin-bottom:25px;
}

.user-box{
    background:white;
    padding:12px 20px;
    border-radius:18px;
    display:flex;
    align-items:center;
    gap:15px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

.avatar-circle{
    width:55px;
    height:55px;
    border-radius:50%;
    background:linear-gradient(135deg,#0d6efd,#4f8cff);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:24px;
    font-weight:bold;
    box-shadow:0 5px 15px rgba(13,110,253,0.3);
}

.user-info{
    line-height:1.2;
}

.user-name{
    font-size:20px;
    font-weight:700;
    color:#111827;
}

.user-role{
    font-size:14px;
    color:#6b7280;
}
        body {
            background: #eef2ff;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0d6efd 0%, #0b5ed7 100%);
        }
        .sidebar h4 {
            color: #fff;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.9);
            padding: 0.8rem 1rem;
            border-radius: 10px;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.2);
        }
        .content-wrapper {
            background: #f8fafc;
            min-height: 100vh;
        }
        .card-custom {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);

            
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <aside class="sidebar p-4 d-flex flex-column justify-content-between">
        <div>
            <h4>Kas RT</h4>

            <ul class="nav flex-column gap-2 mt-4">

    {{-- DASHBOARD --}}
    <li>
        <a href="
            @if(auth()->user()->role == 'admin') /admin
            @elseif(auth()->user()->role == 'bendahara') /bendahara
            @else /dashboard-warga
            @endif
        " class="nav-link">🏠 Dashboard</a>
    </li>

    {{-- ADMIN & BENDAHARA --}}
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'bendahara')
        <li><a href="/warga" class="nav-link">👥 Data Warga</a></li>
    @endif

    {{-- SEMUA ROLE --}}
    <li><a href="/kas" class="nav-link">💰 Kas</a></li>
    <li><a href="/laporan" class="nav-link">📊 Laporan</a></li>

    {{-- KHUSUS ADMIN --}}
    @if(auth()->user()->role == 'admin')
        <li><a href="/user" class="nav-link">👤 Data User</a></li>
    @endif

</ul>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-light w-100">Logout</button>
        </form>
    </aside>

    <!-- CONTENT -->
    <main class="content-wrapper flex-fill p-4">

      <!-- TOPBAR -->
<div class="topbar-custom">

    <div class="user-box">

        <!-- AVATAR -->
        <div class="avatar-circle">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <!-- INFO -->
        <div class="user-info">
            <div class="user-name">
                {{ auth()->user()->name }}
            </div>

            <div class="user-role">
                {{ ucfirst(auth()->user()->role) }}
            </div>
        </div>

    </div>

</div>
        <div class="container-fluid">
            <div class="row g-4">

                @if(
    request()->is('admin*') || 
    request()->is('bendahara*') ||
    request()->is('dashboard-warga')
)

                <!-- KIRI -->
        <div class="col-12 col-xl-8">
            <div class="card card-custom p-4">
                <h5>Ringkasan Kas</h5>
                <p class="text-muted">Ikhtisar terbaru</p>

                @yield('content')
            </div>
        </div>

                 <!-- KANAN -->
                 @if(auth()->user()->role != 'warga')
        <div class="col-12 col-xl-4">

            <div class="card card-custom p-4 mb-4 text-center">
                <h6>Total Warga</h6>
                <h2 class="text-primary">{{ $totalWarga ?? 0 }}</h2>
            </div>

            <div class="card card-custom p-4">
                <h6>Warga per Blok</h6>

                        @if(isset($wargaPerBlok))
                    @foreach($wargaPerBlok as $blok)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $blok->blok }}</span>
                            <span class="badge bg-primary">{{ $blok->total }}</span>
                        </div>
                    @endforeach
                @endif

                    </div>

                </div>

@endif

@else

                 <div class="col-12">
            <div class="card card-custom p-4">
                @yield('content')
                    </div>
                </div>

                @endif

            </div>
        </div>

    </main>

</div>

</body>
</html>