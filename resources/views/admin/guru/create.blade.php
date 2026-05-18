@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-gray-800">Tambah Guru</h2>
        <p class="text-sm text-gray-500">Isi data guru baru</p>
    </div>

    <div class="p-6">
        <form action="{{ route('admin.guru.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold mb-2" style="color: #4A5568;">Nama Lengkap</label>
                    <input type="text" name="nama" 
                        class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" 
                        style="border-color: #E9ECEF;" 
                        value="{{ old('nama') }}" required>
                    @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2" style="color: #4A5568;">NIP</label>
                    <input type="text" name="nip" 
                        class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" 
                        style="border-color: #E9ECEF;" 
                        value="{{ old('nip') }}" required>
                    @error('nip') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2" style="color: #4A5568;">Email</label>
                    <input type="email" name="email" 
                        class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" 
                        style="border-color: #E9ECEF;" 
                        value="{{ old('email') }}" required>
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2" style="color: #4A5568;">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]"
                            style="border-color: #E9ECEF;" required>
                        <i class="fas fa-eye toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer" 
                           onclick="togglePassword()"></i>
                    </div>
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="submit" class="px-6 py-2 rounded-xl text-white transition" 
                        style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <a href="{{ route('admin.guru.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-xl hover:bg-gray-400 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const pass = document.getElementById('password');
        type = pass.type === 'password' ? 'text' : 'password';
        pass.type = type;
    }
</script>
@endsection