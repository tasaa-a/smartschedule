<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    // Menampilkan daftar siswa
    public function index()
    {
        $siswa = Siswa::with(['user', 'kelas'])->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    // Form tambah siswa
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    // Simpan data siswa
// Di dalam method store
public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:100',
        'nis' => 'required|string|unique:siswa',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'kelas_id' => 'required|exists:kelas,id',
    ]);

    // 1. Buat user dengan role siswa
    $user = User::create([
        'name' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'siswa',
    ]);

    // 2. Buat data siswa
    Siswa::create([
        'user_id' => $user->id,
        'nis' => $request->nis,
        'nama' => $request->nama,
        'kelas_id' => $request->kelas_id,
    ]);

    return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
}
    // Form edit siswa
public function edit($id)
{
    $siswa = Siswa::with('user', 'kelas')->findOrFail($id);
    $kelas = Kelas::all();
    return view('admin.siswa.edit', compact('siswa', 'kelas'));
}

    // Update data siswa
public function update(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:100',
        'nis' => 'required|string|unique:siswa,nis,' . $id,
        'email' => 'required|email|unique:users,email,' . $siswa->user_id,
        'kelas_id' => 'required|exists:kelas,id',
    ]);

    // Update user
    $siswa->user->update([
        'name' => $request->nama,
        'email' => $request->email,
    ]);

    if ($request->filled('password')) {
        $siswa->user->update(['password' => Hash::make($request->password)]);
    }

    // Update siswa
    $siswa->update([
        'nis' => $request->nis,
        'nama' => $request->nama,
        'kelas_id' => $request->kelas_id,
    ]);

    return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diupdate!');
}

    // Hapus siswa
 public function destroy($id)
{
    $siswa = Siswa::findOrFail($id);
    $siswa->user->delete(); // Hapus user juga
    $siswa->delete();

    return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus!');
}
}