@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-16 h-16 rounded-full flex items-center justify-center text-white text-2xl font-bold" 
            style="background: linear-gradient(135deg, #F4B8C8 0%, #C5B4E3 100%);">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-gray-500">
                Kelas: {{ Auth::user()->siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mt-6">
        <a href="{{ route('siswa.jadwal') }}" class="bg-blue-50 rounded-2xl p-6 hover:shadow-lg transition flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-100">
                <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Lihat Jadwal Kelas</h3>
                <p class="text-sm text-gray-500">Cek jadwal pelajaran kelas Anda</p>
            </div>
        </a>
    </div>
</div>
@endsection