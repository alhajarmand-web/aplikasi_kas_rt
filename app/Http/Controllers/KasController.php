<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;

class KasController extends Controller
{
    public function index()
    {
        $kas = Kas::latest()->get();
        return view('kas.index', compact('kas'));
    }

    public function create()
    {
        return view('kas.create');
    }

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'keterangan' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        // SIMPAN DATA
        Kas::create([
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/kas')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kas = Kas::findOrFail($id);
        return view('kas.edit', compact('kas'));
    }

    public function update(Request $request, $id)
    {
        // VALIDASI
        $request->validate([
            'keterangan' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $kas = Kas::findOrFail($id);

        // UPDATE DATA
        $kas->update([
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/kas')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Kas::destroy($id);
        return redirect('/kas')->with('success', 'Data berhasil dihapus');
    }
    public function laporan()
{
    $kas = Kas::latest()->get();
    return view('kas.laporan', compact('kas'));
}

public function filter(Request $request)
{
    $kas = Kas::whereBetween('tanggal', [
        $request->tanggal_awal,
        $request->tanggal_akhir
    ])->get();

    return view('kas.laporan', compact('kas'));
}
}