

<?php $__env->startSection('title', 'Jadwal Kelas'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Jadwal Pelajaran</h2>
            <p class="text-sm text-gray-500">
                Kelas: <?php echo e(isset($siswa) && $siswa->kelas ? $siswa->kelas->nama_kelas : '-'); ?> | 
                Jurusan: <?php echo e(isset($siswa) && $siswa->kelas ? $siswa->kelas->jurusan : '-'); ?>

            </p>
        </div>
        
        <!-- TOMBOL CETAK PDF (seperti guru) -->
        <a href="<?php echo e(route('siswa.cetak.jadwal')); ?>" target="_blank" 
           class="px-4 py-2 rounded-xl text-white transition flex items-center gap-2"
           style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
            <i class="fas fa-file-pdf"></i>
            <span>Cetak Jadwal</span>
        </a>
    </div>

    <div class="p-6">
        <?php if(isset($error)): ?>
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded-xl">
                <?php echo e($error); ?>

            </div>
        <?php elseif($jadwalGroup->isEmpty()): ?>
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-calendar-times text-4xl mb-2"></i>
                <p>Belum ada jadwal untuk kelas Anda.</p>
                <a href="<?php echo e(route('admin.jadwal.index')); ?>" class="text-blue-500 hover:underline">Hubungi admin untuk membuat jadwal.</a>
            </div>
        <?php else: ?>
            <?php $__currentLoopData = $jadwalGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari => $jadwalList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-2" style="color: #6C9BCF;"><?php echo e($hari); ?></h3>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Jam</th>
                                    <th class="border px-4 py-2 text-left">Mata Pelajaran</th>
                                    <th class="border px-4 py-2 text-left">Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $jadwalList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border px-4 py-2">
                                        <?php echo e(substr($j->jamPelajaran->jam_mulai, 0, 5)); ?> - <?php echo e(substr($j->jamPelajaran->jam_selesai, 0, 5)); ?>

                                    </td>
                                    <td class="border px-4 py-2"><?php echo e($j->mataPelajaran->nama_mapel); ?></td>
                                    <td class="border px-4 py-2"><?php echo e($j->guru->nama); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\smartschedule\resources\views/siswa/jadwal.blade.php ENDPATH**/ ?>