@extends('layouts.app')

@section('title', 'Edit Jam Pelajaran')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="text-xl font-semibold mb-4">Edit Jam Pelajaran</h2>

    <form action="{{ route('admin.jam.update', $jam->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1" style="color: #4A5568;">Hari</label>
            <select name="hari" class="w-full border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" required>
                <option value="Senin" {{ $jam->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                <option value="Selasa" {{ $jam->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                <option value="Rabu" {{ $jam->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                <option value="Kamis" {{ $jam->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                <option value="Jumat" {{ $jam->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                <option value="Sabtu" {{ $jam->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
            </select>
            @error('hari') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1" style="color: #4A5568;">Jam Mulai</label>
            <input type="time" name="jam_mulai" value="{{ old('jam_mulai', substr($jam->jam_mulai, 0, 5)) }}" class="w-full border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" required>
            @error('jam_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1" style="color: #4A5568;">Jam Selesai</label>
            <input type="time" name="jam_selesai" value="{{ old('jam_selesai', substr($jam->jam_selesai, 0, 5)) }}" class="w-full border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" required>
            @error('jam_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 rounded-xl text-white transition" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                <i class="fas fa-save mr-2"></i> Update
            </button>
            <a href="{{ route('admin.jam.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-xl hover:bg-gray-400 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection