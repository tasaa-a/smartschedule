@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="text-xl font-semibold mb-4">Tambah Jadwal Pelajaran</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4 border-l-4 border-red-500">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.jadwal.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Kelas -->
            <div>
                <label class="block text-sm font-bold mb-1">Kelas</label>
                <select name="kelas_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }} - {{ $k->jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Mata Pelajaran (dengan durasi info) -->
            <div>
                <label class="block text-sm font-bold mb-1">Mata Pelajaran</label>
                <select name="mata_pelajaran_id" id="mapel_select" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($mapel as $m)
                        <option value="{{ $m->id }}" data-durasi="{{ $m->durasi_jam }}">{{ $m->nama_mapel }} ({{ $m->durasi_jam }} jam)</option>
                    @endforeach
                </select>
                <div id="durasi_info" class="text-xs text-blue-600 mt-1"></div>
            </div>

            <!-- Guru -->
            <div>
                <label class="block text-sm font-bold mb-1">Guru</label>
                <select name="guru_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($guru as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jam Mulai -->
            <div>
                <label class="block text-sm font-bold mb-1">Jam Mulai (slot pertama)</label>
                <select name="jam_mulai_id" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="">-- Pilih Jam Mulai --</option>
                    @foreach($jam as $j)
                        <option value="{{ $j->id }}">{{ $j->hari }} ({{ substr($j->jam_mulai,0,5) }} - {{ substr($j->jam_selesai,0,5) }})</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Sistem akan otomatis mengisi slot berikutnya sesuai durasi mapel.</p>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="px-6 py-2 rounded-xl text-white" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
            <a href="{{ route('admin.jadwal.index') }}" class="px-6 py-2 rounded-xl bg-gray-300 text-gray-700 hover:bg-gray-400 transition">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('mapel_select').addEventListener('change', function() {
        let durasi = this.options[this.selectedIndex].getAttribute('data-durasi');
        let infoDiv = document.getElementById('durasi_info');
        if (durasi) {
            infoDiv.innerHTML = 'Durasi: ' + durasi + ' slot jam (masing-masing 45 menit)';
        } else {
            infoDiv.innerHTML = '';
        }
    });
</script>
@endsection