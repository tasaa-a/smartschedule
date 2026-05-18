@extends('layouts.app')

@section('title', 'Tambah Jam Pelajaran')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="text-xl font-semibold mb-4">Tambah Jam Pelajaran</h2>

    <form action="{{ route('admin.jam.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">Hari</label>
            <select name="hari" class="w-full border rounded-xl px-3 py-2" required>
                <option value="">Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
            </select>
            @error('hari') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="w-full border rounded-xl px-3 py-2" required>
            @error('jam_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="w-full border rounded-xl px-3 py-2" required>
            @error('jam_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 rounded-xl text-white transition" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
            <a href="{{ route('admin.jam.index') }}" class="px-6 py-2 rounded-xl bg-gray-300 text-gray-700 hover:bg-gray-400 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection