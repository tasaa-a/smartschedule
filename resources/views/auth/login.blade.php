<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartSchedule - Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-gradient-pastel {
            background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 50%, #F4B8C8 100%);
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .toggle-password {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .toggle-password:hover {
            color: #6C9BCF;
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

            <div class="login-card rounded-3xl shadow-2xl p-8" style="background: rgba(255, 255, 255, 0.95);">
                <h2 class="text-2xl font-bold text-center mb-6" style="color: #4A5568;">Login</h2>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Error Message -->
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Email Field -->
                    <div class="mb-4">
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

                    <!-- Password Field with Toggle -->
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" style="color: #4A5568;">Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="password" name="password" 
                                id="password"
                                class="w-full pl-10 pr-12 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6C9BCF] border" 
                                style="border-color: #E9ECEF;" 
                                placeholder="Masukkan password anda"
                                required>
                            <i class="fas fa-eye toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-gray-400" 
                               onclick="togglePasswordVisibility()" 
                               style="cursor: pointer;"></i>
                        </div>
                    </div>

                    <!-- Forgot Password & Remember Me -->
<div class="flex justify-between items-center mb-6">
    <label class="flex items-center gap-2">
        <input type="checkbox" name="remember" class="rounded" style="accent-color: #6C9BCF;">
        <span class="text-sm" style="color: #4A5568;">Ingat saya</span>
    </label>
    <a href="{{ route('password.request') }}" class="text-sm hover:underline" style="color: #6C9BCF;">
        Lupa password?
    </a>
</div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full py-3 rounded-xl font-semibold transition" 
                            style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%); color: white;">
                        Login
                    </button>
                </form>

                <!-- Informasi Demo
                <div class="mt-6 pt-6 text-center border-t" style="border-color: #E9ECEF;">
                    <p class="text-xs text-gray-400">Demo Akun Admin</p>
                    <p class="text-xs text-gray-400">Email: admin@smartschedule.com | Password: password123</p>
                </div>
            </div>
        </div>
    </div> -->

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>