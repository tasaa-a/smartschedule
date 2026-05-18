@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Data Siswa</h2>
            <p class="text-sm text-gray-500">Kelola data siswa</p>
        </div>
        <a href="{{ route('admin.siswa.create') }}" class="px-4 py-2 rounded-xl flex items-center gap-2 text-white transition" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
            <i class="fas fa-plus"></i> Tambah Siswa
        </a>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200" style="background-color: #F8F9FA;">
                        <th class="text-left py-3 px-4">No</th>
                        <th class="text-left py-3 px-4">NIS</th>
                        <th class="text-left py-3 px-4">Nama</th>
                        <th class="text-left py-3 px-4">Email</th>
                        <th class="text-left py-3 px-4">Kelas</th>
                        <th class="text-center py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
    @forelse($siswa as $index => $item)
    <tr class="border-b border-gray-100">
        <td class="py-3 px-4">{{ $index+1 }}</td>
        <td class="py-3 px-4">{{ $item->nis ?? '-' }}</td>
        <td class="py-3 px-4">{{ $item->user->name ?? '-' }}</td>   <!-- ← PERBAIKAN -->
        <td class="py-3 px-4">{{ $item->user->email ?? '-' }}</td>  <!-- ← PERBAIKAN -->
        <td class="py-3 px-4">{{ $item->kelas->nama_kelas ?? '-' }}</td>
        <td class="py-3 px-4 text-center">
            <a href="{{ route('admin.siswa.edit', $item->id) }}" class="text-blue-500 mr-2"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.siswa.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-500"><i class="fas fa-trash-alt"></i></button>
            </form>
        </td>
    </tr>
    @empty
    <tr><td colspan="6" class="py-12 text-center">Belum ada data siswa</td></tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>
</div>
@endsection