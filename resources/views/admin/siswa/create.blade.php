@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="text-xl font-semibold mb-4">Tambah Siswa</h2>
    <form action="{{ route('admin.siswa.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold mb-1">Nama Lengkap</label>
                <input type="text" name="nama" class="w-full border rounded-xl px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">NIS</label>
                <input type="text" name="nis" class="w-full border rounded-xl px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Email</label>
                <input type="email" name="email" class="w-full border rounded-xl px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Password</label>
                <input type="password" name="password" class="w-full border rounded-xl px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Kelas</label>
                <select name="kelas_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }} - {{ $k->jurusan }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-6 flex gap-3">
            <button type="submit" class="px-6 py-2 rounded-xl text-white" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">Simpan</button>
            <a href="{{ route('admin.siswa.index') }}" class="px-6 py-2 rounded-xl bg-gray-300">Batal</a>
        </div>
    </form>
</div>
@endsection