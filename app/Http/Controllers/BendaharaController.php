<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class BendaharaController extends Controller
{
    public function index()
    {
        $totalWarga = Warga::count();

        $wargaPerBlok = DB::table('wargas')
            ->selectRaw("SUBSTRING_INDEX(alamat, '/', 1) as blok, COUNT(*) as total")
            ->groupBy('blok')
            ->orderBy('blok')
            ->get();

        $kasMasuk = Kas::where('jenis', 'masuk')->sum('jumlah');
        $kasKeluar = Kas::where('jenis', 'keluar')->sum('jumlah');

        return view('bendahara.index', compact(
            'totalWarga',
            'wargaPerBlok',
            'kasMasuk',
            'kasKeluar'
        ));
    }
}