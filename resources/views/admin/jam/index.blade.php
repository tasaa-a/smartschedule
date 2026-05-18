@extends('layouts.app')

@section('title', 'Data Jam Pelajaran')

@section('content')
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Data Jam Pelajaran</h2>
            <p class="text-sm text-gray-500">Kelola hari dan jam pelajaran</p>
        </div>
        <a href="{{ route('admin.jam.create') }}" class="px-4 py-2 rounded-xl flex items-center gap-2 text-white transition" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
            <i class="fas fa-plus"></i> Tambah Jam
        </a>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 border-l-4 border-green-500">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200" style="background-color: #F8F9FA;">
                        <th class="text-left py-3 px-4">No</th>
                        <th class="text-left py-3 px-4">JP ke-</th>
                        <th class="text-left py-3 px-4">Hari</th>
                        <th class="text-left py-3 px-4">Jam Mulai</th>
                        <th class="text-left py-3 px-4">Jam Selesai</th>
                        <th class="text-center py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentHari = '';
                        $jpCounter = 1;
                    @endphp

                    @forelse($jam as $index => $item)
                        @php
                            if ($currentHari != $item->hari) {
                                $currentHari = $item->hari;
                                $jpCounter = 1;
                            }
                        @endphp
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 font-medium text-blue-600">JP {{ $jpCounter++ }}</td>
                            <td class="py-3 px-4">{{ $item->hari }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('admin.jam.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 transition" title="Edit">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <form action="{{ route('admin.jam.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus jam {{ $item->hari }} {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Hapus">
                                            <i class="fas fa-trash-alt text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-500">
                                <i class="fas fa-clock text-4xl mb-3 block opacity-50"></i>
                                Belum ada data jam pelajaran. Silakan tambah jam baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection