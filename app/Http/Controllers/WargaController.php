<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;

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
        // Jika user adalah warga, batasi pilihan keluarga hanya ke keluarganya
        if(Auth::user()->role === 'warga'){
            $userWarga = Warga::where('user_id', Auth::id())->first();
            $keluarga = [];
            $selectedKeluarga = null;
            if($userWarga && $userWarga->keluarga_id){
                $keluarga = \App\Models\Keluarga::where('id', $userWarga->keluarga_id)->get();
                $selectedKeluarga = $userWarga->keluarga_id;
            }
            return view('warga.create', compact('keluarga', 'selectedKeluarga'));
        }

        $keluarga = \App\Models\Keluarga::all();
        $selectedKeluarga = request('keluarga_id');
        return view('warga.create', compact('keluarga', 'selectedKeluarga'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:50',
            'keluarga_id' => 'nullable|exists:keluargas,id',
        ]);
        // jika user adalah warga, force keluarga_id ke keluarganya sendiri
        if(Auth::user()->role === 'warga'){
            $userWarga = Warga::where('user_id', Auth::id())->first();
            if(!$userWarga || !$userWarga->keluarga_id){
                return redirect('/warga')->with('success', 'Anda belum terdaftar dalam keluarga, hubungi admin.');
            }
            $data['keluarga_id'] = $userWarga->keluarga_id;
        }

        Warga::create($data);

        return redirect('/warga')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);

        if(Auth::user()->role === 'warga'){
            $userWarga = Warga::where('user_id', Auth::id())->first();
            if(!$userWarga || $userWarga->keluarga_id != $warga->keluarga_id){
                abort(403);
            }
        }

        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        if(Auth::user()->role === 'warga'){
            $userWarga = Warga::where('user_id', Auth::id())->first();
            if(!$userWarga || $userWarga->keluarga_id != $warga->keluarga_id){
                abort(403);
            }
        }

        $data = $request->all();
        // jangan izinkan warga mengubah keluarga_id menjadi keluarga lain
        if(Auth::user()->role === 'warga'){
            $data['keluarga_id'] = $warga->keluarga_id;
        }

        $warga->update($data);

        return redirect('/warga')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);

        if(Auth::user()->role === 'warga'){
            $userWarga = Warga::where('user_id', Auth::id())->first();
            if(!$userWarga || $userWarga->keluarga_id != $warga->keluarga_id){
                abort(403);
            }
        }

        Warga::destroy($id);
        return redirect('/warga')->with('success', 'Data berhasil dihapus');
    }
}