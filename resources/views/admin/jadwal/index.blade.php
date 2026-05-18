@extends('layouts.app')

@section('title', 'Lihat Jadwal')

@section('content')
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-gray-800">Lihat Jadwal Pelajaran</h2>
        <p class="text-sm text-gray-500">Pilih kelas untuk melihat jadwal</p>
    </div>

    <div class="p-6">
        <!-- Pilih Kelas -->
        <form method="GET" action="{{ route('admin.jadwal.index') }}" class="mb-6">
            <div class="flex gap-4 items-end">
                <div class="flex-1">
                    <label class="block text-sm font-bold mb-1">Pilih Kelas</label>
                    <select name="kelas_id" class="w-full md:w-96 border rounded-xl px-3 py-2" onchange="this.form.submit()">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id }}" {{ $selectedKelas == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }} - {{ $kelas->jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <!-- Tabel Jadwal dengan Rowspan -->
        @if($selectedKelas && count($jadwalGroup) > 0)
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="border px-4 py-2 text-left">Hari</th>
                            <th class="border px-4 py-2 text-left">Jam</th>
                            <th class="border px-4 py-2 text-left">Mata Pelajaran</th>
                            <th class="border px-4 py-2 text-left">Guru</th>
                            <th class="border px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalGroup as $group)
                            @php
                                $jamList = $group['jam'];
                                $firstJam = $jamList[0];
                                $lastJam = $jamList[count($jamList) - 1];
                                $durasiJam = count($jamList);
                                $jamRange = substr($firstJam->jam_mulai, 0, 5) . ' - ' . substr($lastJam->jam_selesai, 0, 5);
                            @endphp
                            <tr>
                                <td class="border px-4 py-2">{{ $firstJam->hari }}</td>
                                <td class="border px-4 py-2">{{ $jamRange }} ({{ $durasiJam }} jam)</td>
                                <td class="border px-4 py-2">{{ $group['mata_pelajaran']->nama_mapel }}</td>
                                <td class="border px-4 py-2">{{ $group['guru']->nama }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.jadwal.editGroup', ['kelas_id' => $selectedKelas, 'mapel_id' => $group['mata_pelajaran']->id]) }}" 
                                           class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.jadwal.destroyGroup', ['kelas_id' => $selectedKelas, 'mapel_id' => $group['mata_pelajaran']->id]) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Hapus semua jadwal untuk mapel {{ $group['mata_pelajaran']->nama_mapel }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif($selectedKelas)
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-calendar-times text-4xl mb-2"></i>
                <p>Belum ada jadwal untuk kelas ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection