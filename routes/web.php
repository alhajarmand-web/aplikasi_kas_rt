<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\UserController;
use App\Models\Warga;
use App\Models\Kas;

/*
|--------------------------------------------------------------------------
| WEB
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // DASHBOARD ADMIN
    Route::get('/admin', function () {

        $totalWarga = Warga::count();

        $wargaPerBlok = Warga::selectRaw("
            SUBSTRING_INDEX(alamat, '/', 1) as blok,
            COUNT(*) as total
        ")
        ->groupBy('blok')
        ->get();

        return view('admin', compact(
            'totalWarga',
            'wargaPerBlok'
        ));
    });

    // DATA USER
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/delete/{id}', [UserController::class, 'destroy']);

});


/*
|--------------------------------------------------------------------------
| ADMIN + BENDAHARA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,bendahara'])->group(function () {

    // ================= WARGA =================
    Route::get('/warga', [WargaController::class, 'index']);
    Route::get('/warga/create', [WargaController::class, 'create']);
    Route::post('/warga/store', [WargaController::class, 'store']);
    Route::get('/warga/edit/{id}', [WargaController::class, 'edit']);
    Route::post('/warga/update/{id}', [WargaController::class, 'update']);
    Route::get('/warga/delete/{id}', [WargaController::class, 'destroy']);
    Route::get('/warga/search', [WargaController::class, 'search']);

    // ================= KAS =================
    Route::get('/kas', [KasController::class, 'index']);
    Route::get('/kas/create', [KasController::class, 'create']);
    Route::post('/kas/store', [KasController::class, 'store']);
    Route::get('/kas/edit/{id}', [KasController::class, 'edit']);
    Route::post('/kas/update/{id}', [KasController::class, 'update']);
    Route::get('/kas/delete/{id}', [KasController::class, 'destroy']);

    // ================= KAS MASUK =================
    Route::get('/kas-masuk', function () {

        $kas = Kas::where('jenis', 'masuk')
            ->latest()
            ->get();

        return view('kas.index', compact('kas'));
    });

    // ================= KAS KELUAR =================
    Route::get('/kas-keluar', function () {

        $kas = Kas::where('jenis', 'keluar')
            ->latest()
            ->get();

        return view('kas.index', compact('kas'));
    });

});


/*
|--------------------------------------------------------------------------
| LAPORAN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,bendahara,warga'])->group(function () {

    Route::get('/laporan', [KasController::class, 'laporan']);

    Route::post('/laporan/filter', [KasController::class, 'filter']);
});


/*
|--------------------------------------------------------------------------
| BENDAHARA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:bendahara'])->group(function () {

    Route::get('/bendahara', function () {

        $kasMasuk = Kas::where('jenis', 'masuk')->sum('jumlah');

        $kasKeluar = Kas::where('jenis', 'keluar')->sum('jumlah');

        $totalWarga = Warga::count();

        $wargaPerBlok = Warga::selectRaw("
            SUBSTRING_INDEX(alamat, '/', 1) as blok,
            COUNT(*) as total
        ")
        ->groupBy('blok')
        ->get();

        return view('bendahara.index', compact(
            'kasMasuk',
            'kasKeluar',
            'totalWarga',
            'wargaPerBlok'
        ));
    });

});


/*
|--------------------------------------------------------------------------
| WARGA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:warga'])->group(function () {

    Route::get('/dashboard-warga', function () {

        $kasMasuk = \App\Models\Kas::where('jenis', 'masuk')->sum('jumlah');

        $kasKeluar = \App\Models\Kas::where('jenis', 'keluar')->sum('jumlah');

        $warga = \App\Models\Warga::latest()->paginate(10);

        return view('warga.index', compact(
            'kasMasuk',
            'kasKeluar',
            'warga'
        ));
    });

});