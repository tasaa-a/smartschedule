@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Data Guru</h2>
            <p class="text-sm text-gray-500">Kelola data guru yang mengajar</p>
        </div>
        <a href="{{ route('admin.guru.create') }}" class="px-4 py-2 rounded-xl flex items-center gap-2 text-white transition" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
            <i class="fas fa-plus"></i>
            <span>Tambah Guru</span>
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
                        <th class="text-left py-3 px-4 text-gray-600 font-semibold">No</th>
                        <th class="text-left py-3 px-4 text-gray-600 font-semibold">NIP</th>
                        <th class="text-left py-3 px-4 text-gray-600 font-semibold">Nama Guru</th>
                        <th class="text-left py-3 px-4 text-gray-600 font-semibold">Email</th>
                        <th class="text-center py-3 px-4 text-gray-600 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guru as $index => $item)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-gray-600">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $item->nip }}</td>
                        <td class="py-3 px-4 font-medium" style="color: #4A5568;">{{ $item->nama }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $item->user->email ?? '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('admin.guru.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 mr-3 inline-block" title="Edit">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                            <form action="{{ route('admin.guru.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus guru {{ $item->nama }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-500">
                            <i class="fas fa-chalkboard-user text-4xl mb-3 block opacity-50"></i>
                            Belum ada data guru. Silakan tambah guru baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection