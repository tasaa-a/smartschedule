

<?php $__env->startSection('title', 'Dashboard Guru'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-2xl shadow-sm p-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-16 h-16 rounded-full flex items-center justify-center text-white text-2xl font-bold" 
            style="background: linear-gradient(135deg, #F4B8C8 0%, #C5B4E3 100%);">
            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Halo, <?php echo e(Auth::user()->name); ?>! 👋</h2>
            <p class="text-gray-500">NIP: <?php echo e($guru->nip ?? '-'); ?></p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <a href="<?php echo e(route('guru.jadwal')); ?>" class="bg-blue-50 rounded-2xl p-6 hover:shadow-lg transition flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-100">
                <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Lihat Jadwal Mengajar</h3>
                <p class="text-sm text-gray-500">Cek jadwal mengajar Anda</p>
            </div>
        </a>
        
        <a href="<?php echo e(route('guru.preferensi')); ?>" class="bg-green-50 rounded-2xl p-6 hover:shadow-lg transition flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-green-100">
                <i class="fas fa-heart text-green-600 text-xl"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Preferensi Waktu</h3>
                <p class="text-sm text-gray-500">Atur jam tidak tersedia</p>
            </div>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\smartschedule\resources\views/guru/dashboard.blade.php ENDPATH**/ ?>