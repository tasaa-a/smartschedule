@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="text-xl font-semibold mb-4">Edit Jadwal: {{ $mapel->nama_mapel }}</h2>
    <p class="text-sm text-gray-500 mb-4">Kelas: {{ $kelas->nama_kelas }} | Durasi: {{ $mapel->durasi_jam }} jam</p>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.jadwal.updateGroup', ['kelas_id' => $kelas_id, 'mapel_id' => $mapel_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold mb-1">Guru</label>
                <select name="guru_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach(\App\Models\Guru::all() as $g)
                        <option value="{{ $g->id }}" {{ $guru->id == $g->id ? 'selected' : '' }}>
                            {{ $g->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-1">Jam Mulai (slot pertama)</label>
                <select name="jam_mulai_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Jam Mulai --</option>
                    @foreach($jamList as $j)
                        <option value="{{ $j->id }}" {{ $jamMulaiId == $j->id ? 'selected' : '' }}>
                            {{ $j->hari }} ({{ substr($j->jam_mulai,0,5) }} - {{ substr($j->jam_selesai,0,5) }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Sistem akan otomatis mengisi {{ $mapel->durasi_jam }} slot berturut-turut.</p>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="px-6 py-2 rounded-xl text-white" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                <i class="fas fa-save mr-2"></i> Update Jadwal
            </button>
            <a href="{{ route('admin.jadwal.index', ['kelas_id' => $kelas_id]) }}" class="px-6 py-2 rounded-xl bg-gray-300">Batal</a>
        </div>
    </form>
</div>
@endsection