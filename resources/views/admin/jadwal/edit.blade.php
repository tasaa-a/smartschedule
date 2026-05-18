@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="text-xl font-semibold mb-4">Edit Jadwal</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4 border-l-4 border-red-500">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold mb-1">Kelas</label>
                <select name="kelas_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ $jadwal->kelas_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }} - {{ $k->jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-1">Mata Pelajaran</label>
                <select name="mata_pelajaran_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($mapel as $m)
                        <option value="{{ $m->id }}" {{ $jadwal->mata_pelajaran_id == $m->id ? 'selected' : '' }}>
                            {{ $m->nama_mapel }} ({{ $m->durasi_jam }} jam)
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-1">Guru</label>
                <select name="guru_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($guru as $g)
                        <option value="{{ $g->id }}" {{ $jadwal->guru_id == $g->id ? 'selected' : '' }}>
                            {{ $g->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-1">Hari & Jam</label>
                <select name="jam_pelajaran_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Hari & Jam --</option>
                    @foreach($jam as $j)
                        <option value="{{ $j->id }}" {{ $jadwal->jam_pelajaran_id == $j->id ? 'selected' : '' }}>
                            {{ $j->hari }} ({{ substr($j->jam_mulai,0,5) }} - {{ substr($j->jam_selesai,0,5) }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="px-6 py-2 rounded-xl text-white" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                <i class="fas fa-save mr-2"></i> Update
            </button>
            <a href="{{ route('admin.jadwal.index') }}" class="px-6 py-2 rounded-xl bg-gray-300 text-gray-700 hover:bg-gray-400 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection