<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartSchedule - Lupa Password</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-gradient-pastel {
            background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 50%, #F4B8C8 100%);
        }
        .card-pastel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gradient-pastel font-poppins">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-white/30 rounded-3xl flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                    <i class="fas fa-calendar-alt text-white text-4xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-white">SmartSchedule</h1>
                <p class="text-white/85 mt-2">Sistem Informasi Penjadwalan Akademik</p>
            </div>

            <div class="card-pastel rounded-3xl shadow-2xl p-8">
                <div class="text-center mb-6">
                    <i class="fas fa-key text-4xl" style="color: #6C9BCF;"></i>
                    <h2 class="text-2xl font-bold mt-3" style="color: #4A5568;">Lupa Password?</h2>
                    <p class="text-gray-500 text-sm mt-2">
                        Masukkan email Anda, kami akan mengirimkan link untuk reset password.
                    </p>
                </div>

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-2" style="color: #4A5568;">Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" name="email" 
                                class="w-full pl-10 pr-3 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6C9BCF] border" 
                                style="border-color: #E9ECEF;" 
                                placeholder="Masukkan email anda"
                                value="{{ old('email') }}"
                                required autofocus>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl font-semibold transition mb-4" 
                            style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%); color: white;">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Link Reset Password
                    </button>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-sm hover:underline" style="color: #6C9BCF;">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>