<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Kas RT</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <style>

        body{
            background:#eef2ff;
            min-height:100vh;
            font-family:'Segoe UI',sans-serif;
        }

        /* SIDEBAR */
        .sidebar{
            width:270px;
            height:100vh;
            background:#f8fafc;
            color:#0f172a;
            position:fixed;
            left:0;
            top:0;
            bottom:0;
            overflow-y:auto;
            box-shadow:5px 0 25px rgba(0,0,0,0.08);
            z-index:999;
        }

        .sidebar-logo{
            padding:25px 20px;
            border-bottom:1px solid rgba(15,23,42,0.08);
        }

        .logo-title{
            font-size:24px;
            font-weight:700;
            margin-bottom:0;
        }

        .logo-subtitle{
            font-size:13px;
            color:#475569;
        }

        .menu-title{
            font-size:11px;
            color:#64748b;
            text-transform:uppercase;
            margin:25px 20px 10px;
            font-weight:600;
            letter-spacing:1px;
        }

        .sidebar .nav-link{
            color:#0f172a;
            padding:12px 18px;
            margin:4px 12px;
            border-radius:12px;
            transition:0.3s;
            display:flex;
            align-items:center;
            gap:12px;
            font-size:15px;
        }

        .sidebar .nav-link:hover{
            background:rgba(15,23,42,0.07);
            transform:translateX(5px);
            color:#0f172a;
        }

        .sidebar .nav-link.active{
            background:linear-gradient(90deg,#2563eb,#3b82f6);
            color:white;
            box-shadow:0 5px 20px rgba(37,99,235,0.3);
        }

        .sidebar .nav-link i{
            font-size:18px;
        }

        .sidebar .nav-submenu{
            margin:2px 16px 6px 30px;
            padding-left:10px;
            border-left:2px solid rgba(37,99,235,0.16);
        }

        .sidebar .nav-submenu .nav-link{
            padding:8px 12px;
            margin:2px 0;
            font-size:13px;
            gap:10px;
            color:#475569;
        }

        .sidebar .nav-submenu .nav-link:hover{
            background:rgba(15,23,42,0.04);
            transform:translateX(3px);
            color:#0f172a;
        }

        .sidebar .nav-submenu .nav-link.active{
            background:rgba(37,99,235,0.12);
            color:#1d4ed8;
            box-shadow:none;
        }

        /* CONTENT */
        .content-wrapper{
            margin-left:270px;
            min-height:100vh;
            background:#f8fafc;
        }

        /* CARD */
        .card-custom{
            border:none;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
            transition:0.3s;
        }

        .card-custom:hover{
            transform:translateY(-4px);
        }
        /* STAT CARD */
.stat-card{
    border:none;
    border-radius:22px;
    padding:25px;
    position:relative;
    overflow:hidden;
    transition:0.3s;
    height:100%;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.stat-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    color:white;
    margin-bottom:18px;
}

.stat-title{
    font-size:15px;
    color:#64748b;
    margin-bottom:8px;
}

.stat-value{
    font-size:34px;
    font-weight:700;
    line-height:1;
}

.stat-sub{
    font-size:13px;
    margin-top:10px;
    color:#94a3b8;
}

/* WARNA CARD */
.bg-income{
    background:linear-gradient(135deg,#16a34a,#22c55e);
    color:white;
}

.bg-expense{
    background:linear-gradient(135deg,#dc2626,#ef4444);
    color:white;
}

.bg-total{
    background:linear-gradient(135deg,#2563eb,#3b82f6);
    color:white;
}

.bg-user{
    background:linear-gradient(135deg,#ca8a04,#facc15);
    color:white;
}

        /* TOPBAR */
        .topbar-custom{
            width:100%;
            display:flex;
            justify-content:flex-end;
            align-items:center;
            margin-bottom:25px;
        }

        .user-box{
            background:white;
            padding:10px 16px;
            border-radius:18px;
            display:flex;
            align-items:center;
            gap:12px;
            box-shadow:0 8px 25px rgba(0,0,0,0.08);
        }

        .avatar-circle{
            width:22px;
            height:22px;
            border-radius:50%;
            background:linear-gradient(135deg,#2563eb,#60a5fa);
            display:flex;
            align-items:center;
            justify-content:center;
            color:white;
            font-size:16px;
            font-weight:bold;
        }

        .user-name{
            font-size:13px;
            font-weight:700;
        }

        .user-role{
            font-size:9px;
            color:#64748b;
        }

    </style>
</head>

<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <aside class="sidebar d-flex flex-column justify-content-between">

        <div>

            <!-- LOGO -->
            <div class="sidebar-logo">
                <h3 class="logo-title">🏘️ RT/RW</h3>

                <div class="logo-subtitle">
                    Sistem Manajemen RT/RW
                </div>
            </div>

            <!-- DASHBOARD -->
            <div class="menu-title">Dashboard</div>

            <ul class="nav flex-column">

                <li>
                    <a href="
                        @if(auth()->user()->role == 'admin')
                            /admin
                        @elseif(auth()->user()->role == 'bendahara')
                            /bendahara
                        @else
                            /dashboard-warga
                        @endif
                    "
                    class="nav-link {{ request()->is('admin') || request()->is('bendahara') || request()->is('dashboard-warga') ? 'active' : '' }}">

                        <i class="bi bi-grid-fill"></i>
                        Dashboard

                    </a>
                </li>

            </ul>

            <!-- DATA KEPENDUDUKAN -->
            <div class="menu-title">Data Kependudukan</div>

            <ul class="nav flex-column">

                @if(auth()->user()->role == 'admin')
                <li>
                    <a href="/user"
                       class="nav-link {{ request()->is('user*') ? 'active' : '' }}">

                        <i class="bi bi-person-badge-fill"></i>
                        Data User

                    </a>
                </li>
                @endif

                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'bendahara')
                <li>
                    <a href="/warga"
                       class="nav-link {{ request()->is('warga*') ? 'active' : '' }}">

                        <i class="bi bi-person-vcard-fill"></i>
                        Data Warga

                    </a>
                </li>

                <li>
                    <a href="/pengurus"
                       class="nav-link {{ request()->is('pengurus*') ? 'active' : '' }}">

                        <i class="bi bi-people-fill"></i>
                        Data Pengurus RT

                    </a>
                </li>
                @endif

                <li>
                    <a href="/keluarga"
                       class="nav-link {{ request()->is('keluarga*') ? 'active' : '' }}">

                        <i class="bi bi-house-door-fill"></i>
                        Profil Keluarga

                    </a>
                </li>

            </ul>

            <!-- KEUANGAN & IURAN -->
            <div class="menu-title">Keuangan & Iuran</div>

            <ul class="nav flex-column">

                <li>
                    <a href="/kas"
                       class="nav-link {{ request()->is('kas*') ? 'active' : '' }}">

                        <i class="bi bi-wallet2"></i>
                        IPL Warga

                    </a>
                </li>

                <li>
                    <a href="/kas"
                       class="nav-link {{ request()->is('kas*') ? 'active' : '' }}">

                        <i class="bi bi-cash-stack"></i>
                        Keuangan & KAS

                    </a>
                </li>

                <li>
                    <a href="/kas"
                       class="nav-link {{ request()->is('kas*') ? 'active' : '' }}">

                        <i class="bi bi-bag-check-fill"></i>
                        Pengeluaran Rutin

                    </a>
                </li>

                <li>
                    <a href="/laporan"
                       class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">

                        <i class="bi bi-bar-chart-fill"></i>
                        Laporan

                    </a>
                </li>

            </ul>

            <!-- AGENDA KEGIATAN -->
            <div class="menu-title">Agenda Kegiatan</div>

            <ul class="nav flex-column">

                <li>
                    <a href="/kegiatan"
                       class="nav-link {{ request()->is('kegiatan*') ? 'active' : '' }}">

                        <i class="bi bi-calendar-event-fill"></i>
                        Kegiatan

                    </a>
                </li>

                <li>
                    <a href="/informasi"
                       class="nav-link {{ request()->is('informasi*') ? 'active' : '' }}">

                        <i class="bi bi-info-circle-fill"></i>
                        Informasi

                    </a>
                </li>

            </ul>

            <!-- LAYANAN WARGA -->
            <div class="menu-title">Layanan Warga</div>

            <ul class="nav flex-column">

                <li>
                    <a href="/surat-menyurat"
                       class="nav-link {{ request()->is('surat-menyurat*') ? 'active' : '' }}">

                        <i class="bi bi-envelope-fill"></i>
                        Surat Menyurat

                    </a>
                </li>

                <li>
                    <a href="/arsip-surat"
                       class="nav-link {{ request()->is('arsip-surat*') ? 'active' : '' }}">

                        <i class="bi bi-archive-fill"></i>
                        Arsip Surat

                    </a>
                </li>

                <li>
                    <a href="/master-surat"
                       class="nav-link {{ request()->is('master-surat*') ? 'active' : '' }}">

                        <i class="bi bi-file-earmark-text-fill"></i>
                        Master Surat

                    </a>
                </li>

            </ul>

        </div>

        <!-- LOGOUT -->
        <div class="p-3">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="btn btn-danger w-100 rounded-4">

                    <i class="bi bi-box-arrow-right"></i>
                    Logout

                </button>

            </form>

        </div>

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

                        <p class="text-muted">
                            Ikhtisar terbaru
                        </p>

                        @yield('content')
                        <!-- GRAFIK -->
<div class="card card-custom p-4 mt-4">

    <h5 class="mb-4">Grafik Kas</h5>

    <div style="height:350px;">
        <canvas id="kasChart"></canvas>
    </div>

</div>

                    </div>

                </div>

                <!-- KANAN -->
                @if(auth()->user()->role != 'warga')

                <div class="col-12 col-xl-4">

                    <div class="card card-custom p-4 mb-4 text-center">

                        <h6>Total Warga</h6>

                        <h2 class="text-primary">
                            {{ $totalWarga ?? 0 }}
                        </h2>

                    </div>

                    <div class="card card-custom p-4">

                        <h6>Warga per Blok</h6>

                        @if(isset($wargaPerBlok))

                            @foreach($wargaPerBlok as $blok)

                            <div class="d-flex justify-content-between mb-2">

                                <span>{{ $blok->blok }}</span>

                                <span class="badge bg-primary">
                                    {{ $blok->total }}
                                </span>

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

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('kasChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
        datasets: [
            {
                label: 'Kas Masuk',
                data: [500000, 700000, 600000, 800000, 900000, 750000, 950000],
                borderWidth: 3,
                tension: 0.4
            },
            {
                label: 'Kas Keluar',
                data: [300000, 400000, 350000, 500000, 450000, 550000, 600000],
                borderWidth: 3,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            }
        }
    }
});
</script>

</body>
</html>