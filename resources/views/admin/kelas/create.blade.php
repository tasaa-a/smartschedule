@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="text-xl font-semibold mb-4">Tambah Kelas</h2>
    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block text-sm font-bold mb-1">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="w-full border rounded-xl px-3 py-2" placeholder="Contoh: X RPL 1" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">Jurusan</label>
            <input type="text" name="jurusan" class="w-full border rounded-xl px-3 py-2" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
        </div>
        <button type="submit" class="px-6 py-2 rounded-xl text-white" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">Simpan</button>
        <a href="{{ route('admin.kelas.index') }}" class="px-6 py-2 rounded-xl bg-gray-300">Batal</a>
    </form>
</div>
@endsection