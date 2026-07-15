<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ================= TAMPILKAN DATA USER =================
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('role', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('user.index', compact('users', 'search'));
    }

    // ================= FORM TAMBAH USER =================
    public function create()
    {
        return view('user.create');
    }

    // ================= SIMPAN USER =================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/user')
            ->with('success', 'User berhasil ditambahkan');
    }

    // ================= FORM EDIT USER =================
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    // ================= UPDATE USER =================
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect('/user')
            ->with('success', 'User berhasil diupdate');
    }

    // ================= HAPUS USER =================
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/user')
            ->with('success', 'User berhasil dihapus');
    }
}