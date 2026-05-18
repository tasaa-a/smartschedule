@extends('layouts.app')

@section('title', 'Edit Mata Pelajaran')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="text-xl font-semibold mb-4">Edit Mata Pelajaran</h2>

    <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1" style="color: #4A5568;">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" class="w-full border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" required>
            @error('nama_mapel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1" style="color: #4A5568;">Durasi (Jam)</label>
            <input type="number" name="durasi_jam" value="{{ old('durasi_jam', $mapel->durasi_jam) }}" class="w-full border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" required>
            @error('durasi_jam') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 rounded-xl text-white transition" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                <i class="fas fa-save mr-2"></i> Update
            </button>
            <a href="{{ route('admin.mapel.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-xl hover:bg-gray-400 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection