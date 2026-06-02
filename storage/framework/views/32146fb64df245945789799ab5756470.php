

<?php $__env->startSection('title', 'Preferensi Waktu'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-gray-800">Preferensi Waktu Tidak Tersedia</h2>
        <p class="text-sm text-gray-500">Tandai jam yang Anda tidak bisa mengajar. Sistem akan menghindari jam tersebut saat menyusun jadwal.</p>
    </div>

    <div class="p-6">
        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 border-l-4 border-green-500">
                <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('guru.preferensi.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <?php $__currentLoopData = $semuaJam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $checked = in_array($jam->id, $jamTerpilih) ? 'checked' : '';
                    ?>
                    <label class="flex items-center gap-3 p-3 border rounded-xl hover:bg-gray-50 cursor-pointer transition">
                        <input type="checkbox" name="jam_tidak_tersedia[]" value="<?php echo e($jam->id); ?>" <?php echo e($checked); ?>>
                        <div>
                            <div class="font-semibold text-gray-800"><?php echo e($jam->hari); ?></div>
                            <div class="text-sm text-gray-500"><?php echo e(substr($jam->jam_mulai, 0, 5)); ?> - <?php echo e(substr($jam->jam_selesai, 0, 5)); ?></div>
                        </div>
                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($semuaJam->isEmpty()): ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-clock text-4xl mb-2 opacity-50"></i>
                    <p>Belum ada data jam pelajaran. Silakan hubungi admin.</p>
                </div>
            <?php endif; ?>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 rounded-xl text-white transition flex items-center gap-2" 
                        style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
                    <i class="fas fa-save"></i> Simpan Preferensi
                </button>
                <a href="<?php echo e(route('guru.dashboard')); ?>" class="px-6 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\smartschedule\resources\views/guru/preferensi.blade.php ENDPATH**/ ?>