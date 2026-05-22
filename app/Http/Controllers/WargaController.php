<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    public function search(Request $request)
{
    $search = $request->search;

    $warga = \App\Models\Warga::where('nama', 'like', "%$search%")
        ->orWhere('alamat', 'like', "%$search%")
        ->latest()
        ->get();

    return view('warga.table', compact('warga'))->render();
}
    public function index(Request $request)
    {
        $search = $request->search;

        $warga = \App\Models\Warga::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('alamat', 'like', "%{$search}%")
                         ->orWhere('no_hp', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);

        return view('warga.data', compact('warga'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:50',
        ]);

        Warga::create($data);

        return redirect('/warga')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $warga = Warga::find($id);
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $warga = Warga::find($id);
        $warga->update($request->all());

        return redirect('/warga')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Warga::destroy($id);
        return redirect('/warga')->with('success', 'Data berhasil dihapus');
    }
}