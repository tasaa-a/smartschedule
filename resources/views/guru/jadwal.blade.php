@extends('layouts.app')

@section('title', 'Jadwal Mengajar')

@section('content')
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Jadwal Mengajar</h2>
            <p class="text-sm text-gray-500">Nama Guru: {{ $guru->nama }}</p>
        </div>
        
        <!-- TOMBOL EXPORT PDF -->
        <a href="{{ route('guru.jadwal.export') }}" target="_blank" 
           class="px-4 py-2 rounded-xl text-white transition flex items-center gap-2"
           style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
            <i class="fas fa-file-pdf"></i>
            <span>Cetak Jadwal</span>
        </a>
    </div>

    <div class="p-6">
        @if($jadwalGroup->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-calendar-times text-4xl mb-2"></i>
                <p>Belum ada jadwal mengajar untuk Anda.</p>
                <a href="{{ route('admin.jadwal.index') }}" class="text-blue-500 hover:underline">Hubungi admin untuk membuat jadwal.</a>
            </div>
        @else
            @foreach($jadwalGroup as $hari => $jadwalList)
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-2" style="color: #6C9BCF;">{{ $hari }}</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Jam</th>
                                    <th class="border px-4 py-2 text-left">Kelas</th>
                                    <th class="border px-4 py-2 text-left">Mata Pelajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwalList as $j)
                                <tr>
                                    <td class="border px-4 py-2">
                                        {{ substr($j->jamPelajaran->jam_mulai, 0, 5) }} - {{ substr($j->jamPelajaran->jam_selesai, 0, 5) }}
                                    </td>
                                    <td class="border px-4 py-2">{{ $j->kelas->nama_kelas }} ({{ $j->kelas->jurusan }})</td>
                                    <td class="border px-4 py-2">{{ $j->mataPelajaran->nama_mapel }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection