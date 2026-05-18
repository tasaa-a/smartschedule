<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    // Menampilkan daftar guru
    public function index()
    {
        $guru = Guru::with('user')->get();
        return view('admin.guru.index', compact('guru'));
    }

    // Menampilkan form tambah guru
    public function create()
    {
        return view('admin.guru.create');
    }

    // Menyimpan data guru baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|unique:guru',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Buat user account
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        // Buat data guru
        Guru::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil ditambahkan!');
    }

    // Menampilkan form edit guru
    public function edit($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    // Mengupdate data guru
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|unique:guru,nip,' . $id,
            'email' => 'required|email|unique:users,email,' . $guru->user_id,
        ]);

        // Update user
        $guru->user->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        // Update guru
        $guru->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil diupdate!');
    }

    // Menghapus data guru
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->user->delete(); // Hapus user juga
        $guru->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil dihapus!');
    }
}