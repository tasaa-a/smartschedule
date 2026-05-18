@extends('layouts.app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Data Mata Pelajaran</h2>
            <p class="text-sm text-gray-500">Kelola data mata pelajaran</p>
        </div>
        <a href="{{ route('admin.mapel.create') }}" class="px-4 py-2 rounded-xl flex items-center gap-2 text-white transition" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
            <i class="fas fa-plus"></i> Tambah Mata Pelajaran
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
                        <th class="text-left py-3 px-4">Nama Mata Pelajaran</th>
                        <th class="text-left py-3 px-4">Durasi (Jam)</th>
                        <th class="text-center py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mapel as $index => $item)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 font-medium">{{ $item->nama_mapel }}</td>
                        <td class="py-3 px-4">{{ $item->durasi_jam }} jam</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('admin.mapel.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 transition" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('admin.mapel.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus mata pelajaran {{ $item->nama_mapel }}?')">
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
                        <td colspan="4" class="py-12 text-center text-gray-500">
                            <i class="fas fa-book text-4xl mb-3 block opacity-50"></i>
                            Belum ada data mata pelajaran. Silakan tambah mata pelajaran baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection