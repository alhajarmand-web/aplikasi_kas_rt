<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengurusController;
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

    Route::get('/user/create', [UserController::class, 'create']);
    Route::post('/user/store', [UserController::class, 'store']);

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

    // ================= PENGURUS RT =================
    Route::get('/pengurus', [PengurusController::class, 'index']);
    Route::get('/pengurus/create', [PengurusController::class, 'create']);
    Route::post('/pengurus/store', [PengurusController::class, 'store']);
    Route::get('/pengurus/edit/{id}', [PengurusController::class, 'edit']);
    Route::post('/pengurus/update/{id}', [PengurusController::class, 'update']);
    Route::get('/pengurus/delete/{id}', [PengurusController::class, 'destroy']);

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
    
    // ================= KELUARGA / PROFIL KELUARGA =================
    Route::get('/keluarga', [App\Http\Controllers\KeluargaController::class, 'index']);
    Route::get('/keluarga/create', [App\Http\Controllers\KeluargaController::class, 'create']);
    Route::post('/keluarga/store', [App\Http\Controllers\KeluargaController::class, 'store']);
    Route::get('/keluarga/edit/{id}', [App\Http\Controllers\KeluargaController::class, 'edit']);
    Route::post('/keluarga/update/{id}', [App\Http\Controllers\KeluargaController::class, 'update']);
    Route::get('/keluarga/delete/{id}', [App\Http\Controllers\KeluargaController::class, 'destroy']);
    Route::get('/keluarga/{id}', [App\Http\Controllers\KeluargaController::class, 'show']);
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