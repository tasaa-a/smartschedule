

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<!-- Welcome Card -->
<div class="rounded-3xl p-8 text-white mb-8 card-hover" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold mb-2">Halo, <?php echo e(Auth::user()->name); ?>! 👋</h1>
            <p class="text-white/85">Selamat datang di SmartSchedule. Kelola penjadwalan akademik dengan mudah.</p>
        </div>
        <div class="w-20 h-20 bg-white/25 rounded-2xl flex items-center justify-center backdrop-blur-sm">
            <i class="fas fa-calendar-check text-white text-4xl"></i>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
    <div class="stat-card-pastel p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Total Guru</p>
                <p class="text-3xl font-bold" style="color: #4A5568;"><?php echo e($totalGuru ?? 0); ?></p>
            </div>
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-pastel-blue-light">
                <i class="fas fa-chalkboard-user text-2xl" style="color: #6C9BCF;"></i>
            </div>
        </div>
    </div>

    <div class="stat-card-pastel p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Total Siswa</p>
                <p class="text-3xl font-bold" style="color: #4A5568;"><?php echo e($totalSiswa ?? 0); ?></p>
            </div>
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-pastel-green-light">
                <i class="fas fa-users text-2xl" style="color: #8FC9A9;"></i>
            </div>
        </div>
    </div>

    <div class="stat-card-pastel p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Total Kelas</p>
                <p class="text-3xl font-bold" style="color: #4A5568;"><?php echo e($totalKelas ?? 0); ?></p>
            </div>
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-pastel-yellow-light">
                <i class="fas fa-building text-2xl" style="color: #F9E2A1;"></i>
            </div>
        </div>
    </div>

    <div class="stat-card-pastel p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Mata Pelajaran</p>
                <p class="text-3xl font-bold" style="color: #4A5568;"><?php echo e($totalMapel ?? 0); ?></p>
            </div>
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-pastel-pink-light">
                <i class="fas fa-book text-2xl" style="color: #F4B8C8;"></i>
            </div>
        </div>
    </div>

    <div class="stat-card-pastel p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Jadwal Aktif</p>
                <p class="text-3xl font-bold" style="color: #4A5568;"><?php echo e($totalJadwal ?? 0); ?></p>
            </div>
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-pastel-blue-light">
                <i class="fas fa-calendar-week text-2xl" style="color: #6C9BCF;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Aksi Cepat -->
<h3 class="text-lg font-semibold mb-4" style="color: #4A5568;">Aksi Cepat</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <a href="<?php echo e(route('admin.guru.create')); ?>" class="bg-white rounded-2xl p-6 shadow-sm card-hover flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-pastel-blue-light">
            <i class="fas fa-user-plus text-2xl" style="color: #6C9BCF;"></i>
        </div>
        <div>
            <h3 class="font-semibold" style="color: #4A5568;">Tambah Guru</h3>
            <p class="text-sm text-gray-500">Kelola data guru mengajar</p>
        </div>
    </a>
    
    <a href="<?php echo e(route('admin.siswa.create')); ?>" class="bg-white rounded-2xl p-6 shadow-sm card-hover flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-pastel-green-light">
            <i class="fas fa-user-graduate text-2xl" style="color: #8FC9A9;"></i>
        </div>
        <div>
            <h3 class="font-semibold" style="color: #4A5568;">Tambah Siswa</h3>
            <p class="text-sm text-gray-500">Kelola data siswa</p>
        </div>
    </a>
    
    <a href="<?php echo e(route('admin.jadwal.create')); ?>" class="bg-white rounded-2xl p-6 shadow-sm card-hover flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-pastel-pink-light">
            <i class="fas fa-plus-circle text-2xl" style="color: #F4B8C8;"></i>
        </div>
        <div>
            <h3 class="font-semibold" style="color: #4A5568;">Tambah Jadwal</h3>
            <p class="text-sm text-gray-500">Buat jadwal pelajaran</p>
        </div>
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\smartschedule\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>