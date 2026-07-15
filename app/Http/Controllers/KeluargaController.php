<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class KeluargaController extends Controller
{
    public function index()
    {
        // Jika user adalah warga, tampilkan hanya keluarganya sendiri
        if(Auth::user()->role === 'warga'){
            $userWarga = \App\Models\Warga::where('user_id', Auth::id())->first();
            if($userWarga && $userWarga->keluarga_id){
                $keluarga = Keluarga::where('id', $userWarga->keluarga_id)->withCount('anggotas')->paginate(10);
                return view('keluarga.index', compact('keluarga'));
            }
            // jika tidak punya keluarga, tetap kirim paginator kosong agar view bisa merender pagination safely
            $keluarga = new LengthAwarePaginator([], 0, 10, 1);
            return view('keluarga.index', compact('keluarga'));
        }

        $keluarga = Keluarga::withCount('anggotas')->latest()->paginate(10);
        return view('keluarga.index', compact('keluarga'));
    }

    public function show($id)
    {
        $keluarga = Keluarga::findOrFail($id);
        $anggota = Warga::where('keluarga_id', $id)->latest()->paginate(10);

        return view('keluarga.show', compact('keluarga', 'anggota'));
    }

    public function create()
    {
        if (!in_array(Auth::user()->role, ['admin', 'bendahara'])) {
            abort(403);
        }

        return view('keluarga.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_keluarga' => 'nullable|string|max:255',
            'kepala_keluarga' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'rt_rw' => 'nullable|string|max:100',
            'blok' => 'nullable|string|max:100',
        ]);

        if (!in_array(Auth::user()->role, ['admin', 'bendahara'])) {
            abort(403);
        }

        Keluarga::create($data);

        return redirect('/keluarga')->with('success', 'Data keluarga berhasil ditambahkan');
    }

    public function edit($id)
    {
        $keluarga = Keluarga::findOrFail($id);

        // warga tidak boleh mengedit keluarga lain
        if(Auth::user()->role === 'warga'){
            $userWarga = \App\Models\Warga::where('user_id', Auth::id())->first();
            if(!$userWarga || $userWarga->keluarga_id != $keluarga->id){
                abort(403);
            }
        }

        return view('keluarga.edit', compact('keluarga'));
    }

    public function update(Request $request, $id)
    {
        $keluarga = Keluarga::findOrFail($id);

        // warga hanya boleh update keluarganya sendiri
        if(Auth::user()->role === 'warga'){
            $userWarga = \App\Models\Warga::where('user_id', Auth::id())->first();
            if(!$userWarga || $userWarga->keluarga_id != $keluarga->id){
                abort(403);
            }
        }

        $data = $request->validate([
            'nama_keluarga' => 'nullable|string|max:255',
            'kepala_keluarga' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'rt_rw' => 'nullable|string|max:100',
            'blok' => 'nullable|string|max:100',
        ]);

        $keluarga->update($data);

        return redirect('/keluarga')->with('success', 'Data keluarga berhasil diupdate');
    }

    public function destroy($id)
    {
        $keluarga = Keluarga::findOrFail($id);

        if(Auth::user()->role === 'warga'){
            $userWarga = \App\Models\Warga::where('user_id', Auth::id())->first();
            if(!$userWarga || $userWarga->keluarga_id != $keluarga->id){
                abort(403);
            }
        }

        Keluarga::destroy($id);
        return redirect('/keluarga')->with('success', 'Data keluarga berhasil dihapus');
    }
}
