@extends('layouts.app')

@section('title', 'Jadwal Kelas')

@section('content')
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Jadwal Pelajaran</h2>
            <p class="text-sm text-gray-500">
                Kelas: {{ isset($siswa) && $siswa->kelas ? $siswa->kelas->nama_kelas : '-' }} | 
                Jurusan: {{ isset($siswa) && $siswa->kelas ? $siswa->kelas->jurusan : '-' }}
            </p>
        </div>
        
        <!-- TOMBOL CETAK PDF (seperti guru) -->
        <a href="{{ route('siswa.cetak.jadwal') }}" target="_blank" 
           class="px-4 py-2 rounded-xl text-white transition flex items-center gap-2"
           style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
            <i class="fas fa-file-pdf"></i>
            <span>Cetak Jadwal</span>
        </a>
    </div>

    <div class="p-6">
        @if(isset($error))
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded-xl">
                {{ $error }}
            </div>
        @elseif($jadwalGroup->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-calendar-times text-4xl mb-2"></i>
                <p>Belum ada jadwal untuk kelas Anda.</p>
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
                                    <th class="border px-4 py-2 text-left">Mata Pelajaran</th>
                                    <th class="border px-4 py-2 text-left">Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwalList as $j)
                                <tr>
                                    <td class="border px-4 py-2">
                                        {{ substr($j->jamPelajaran->jam_mulai, 0, 5) }} - {{ substr($j->jamPelajaran->jam_selesai, 0, 5) }}
                                    </td>
                                    <td class="border px-4 py-2">{{ $j->mataPelajaran->nama_mapel }}</td>
                                    <td class="border px-4 py-2">{{ $j->guru->nama }}</td>
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