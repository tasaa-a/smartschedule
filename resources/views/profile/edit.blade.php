@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    {{-- Form Edit Profil (Nama & Email) --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-1">Edit Profil</h2>
        <p class="text-sm text-gray-500 mb-4">Pastikan email anda valid dan dapat dihubungi.</p>

        @if (session('status') === 'profil-updated')
            <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4">
                Profil berhasil diperbarui.
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6C9BCF]" required>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-5 py-2 rounded-xl text-white" 
                        style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                    Update
                </button>
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- Form Ganti Password --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-1">Update Password</h2>
        <p class="text-sm text-gray-500 mb-4">
            <i class="fas fa-info-circle"></i> Password baru harus minimal 8 karakter dan mengandung huruf besar, huruf kecil, angka, serta karakter khusus (misalnya @, $, %, !*).
        </p>

        @if (session('status') === 'password-updated')
            <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4">
                Password berhasil diubah.
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Password Lama</label>
                <input type="password" name="current_password" class="w-full border rounded-xl px-4 py-2" required>
                @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Password Baru <span class="text-gray-400 text-xs">(minimal 8 karakter)</span></label>
                <input type="password" name="password" class="w-full border rounded-xl px-4 py-2" required>
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full border rounded-xl px-4 py-2" required>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-5 py-2 rounded-xl text-white" 
                        style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                    Update Password
                </button>
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection