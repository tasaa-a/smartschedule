<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SmartSchedule - Sistem Penjadwalan Akademik</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Warna Pastel */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);
        }
        .bg-sidebar {
            background: linear-gradient(180deg, #7BAFD4 0%, #6C9BCF 100%);
        }
        .stat-card-pastel {
            background: linear-gradient(135deg, #ffffff 0%, #F8F9FA 100%);
            border-radius: 24px;
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .sidebar-item.active {
            background: rgba(255,255,255,0.25);
        }
        .sidebar-item:hover {
            background: rgba(255,255,255,0.15);
        }
        .sidebar-scroll {
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
        }
    </style>
</head>
<body class="font-poppins antialiased" style="background-color: #F8F9FA;">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-72 shadow-xl fixed h-full bg-sidebar sidebar-scroll">
            <div class="p-6 border-b border-white/20 sticky top-0 bg-sidebar z-10">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/30 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-xl">SmartSchedule</h1>
                        <p class="text-white/80 text-xs">Sistem Penjadwalan Akademik</p>
                    </div>
                </div>
            </div>

            <nav class="p-4">
                <p class="text-white/60 text-xs uppercase tracking-wider mb-4 px-4">Menu Utama</p>
                @php
                    $role = Auth::user()->role;
                    $currentRoute = Route::currentRouteName();
                @endphp

                @if($role == 'admin')
                <div class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition {{ $currentRoute == 'admin.dashboard' ? 'bg-white/25' : '' }}">
                        <i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.guru.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-chalkboard-user w-5"></i><span>Data Guru</span>
                    </a>
                    <a href="{{ route('admin.siswa.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-users w-5"></i><span>Data Siswa</span>
                    </a>
                    <a href="{{ route('admin.kelas.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-building w-5"></i><span>Data Kelas</span>
                    </a>
                    <a href="{{ route('admin.mapel.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-book w-5"></i><span>Mata Pelajaran</span>
                    </a>
                    <a href="{{ route('admin.jam.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-clock w-5"></i><span>Jam Pelajaran</span>
                    </a>
                    <a href="{{ route('admin.jadwal.create') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-plus-circle w-5"></i><span>Tambah Jadwal</span>
                    </a>
                    <a href="{{ route('admin.jadwal.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-table-list w-5"></i><span>Lihat Jadwal</span>
                    </a>
                </div>
                @elseif($role == 'guru')
                <div class="space-y-2">
                    <a href="{{ route('guru.dashboard') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span>
                    </a>
                    <a href="{{ route('guru.jadwal') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-calendar-week w-5"></i><span>Jadwal Saya</span>
                    </a>
                    <a href="{{ route('guru.preferensi') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-heart w-5"></i><span>Preferensi Waktu</span>
                    </a>
                </div>
                @elseif($role == 'siswa')
                <div class="space-y-2">
                    <a href="{{ route('siswa.dashboard') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span>
                    </a>
                    <a href="{{ route('siswa.jadwal') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 transition">
                        <i class="fas fa-calendar-week w-5"></i><span>Jadwal Kelas</span>
                    </a>
                </div>
                @endif

                <div class="mt-8 pt-8 border-t border-white/20">
                    <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                        @csrf
                        <button type="button" onclick="confirmLogout()" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:bg-white/15 w-full transition">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-72">
            <nav class="bg-white shadow-sm border-b">
                <div class="px-8 py-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-500">Selamat datang, {{ Auth::user()->name }}</p>
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold" style="background: linear-gradient(135deg, #F4B8C8 0%, #C5B4E3 100%);">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 z-50" x-cloak>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-circle mr-2"></i> Profil Saya
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="p-8" style="background-color: #f0f2f5;">
                @yield('content')
            </div>
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- SweetAlert Notifikasi -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#6C9BCF',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    </script>
    @endif

    <script>
    function confirmLogout() {
        Swal.fire({
            title: 'Logout?',
            text: "Apakah Anda yakin ingin keluar?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6C9BCF',
            confirmButtonText: 'Ya, logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    }
    </script>
</body>
</html>