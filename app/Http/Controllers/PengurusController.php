<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengurusController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengurus = Pengurus::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('jabatan', 'like', "%{$search}%")
                ->orWhere('rt_rw', 'like', "%{$search}%")
                ->orWhere('blok', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);

        $totalPengurus = Pengurus::count();
        $activePengurus = Pengurus::where('status', 'aktif')->count();
        $jabatanSummary = Pengurus::select('jabatan', DB::raw('count(*) as total'))
            ->groupBy('jabatan')
            ->get();
        $rtRwSummary = Pengurus::select('rt_rw', DB::raw('count(*) as total'))
            ->groupBy('rt_rw')
            ->get();

        $totalWarga = Warga::count();
        $wargaPerBlok = Warga::selectRaw(
            "SUBSTRING_INDEX(alamat, '/', 1) as blok, COUNT(*) as total"
        )
        ->groupBy('blok')
        ->get();

        return view('pengurus.index', compact(
            'pengurus',
            'totalPengurus',
            'activePengurus',
            'jabatanSummary',
            'rtRwSummary',
            'totalWarga',
            'wargaPerBlok'
        ));
    }

    public function create()
    {
        return view('pengurus.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'rt_rw' => 'nullable|string|max:100',
            'blok' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:50',
            'status' => 'required|string|in:aktif,non-aktif',
            'masa_jabatan' => 'nullable|string|max:100',
        ]);

        Pengurus::create($data);

        return redirect('/pengurus')->with('success', 'Data pengurus berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'rt_rw' => 'nullable|string|max:100',
            'blok' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:50',
            'status' => 'required|string|in:aktif,non-aktif',
            'masa_jabatan' => 'nullable|string|max:100',
        ]);

        $pengurus->update($data);

        return redirect('/pengurus')->with('success', 'Data pengurus berhasil diupdate');
    }

    public function destroy($id)
    {
        Pengurus::destroy($id);
        return redirect('/pengurus')->with('success', 'Data pengurus berhasil dihapus');
    }
}
