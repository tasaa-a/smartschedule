

<?php $__env->startSection('title', 'Data Kelas'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-2xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Data Kelas</h2>
            <p class="text-sm text-gray-500">Kelola data kelas</p>
        </div>
        <a href="<?php echo e(route('admin.kelas.create')); ?>" class="px-4 py-2 rounded-xl flex items-center gap-2 text-white transition" style="background: linear-gradient(135deg, #6C9BCF 0%, #8FC9A9 100%);">
            <i class="fas fa-plus"></i> Tambah Kelas
        </a>
    </div>

    <div class="p-6">
        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 border-l-4 border-green-500">
                <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200" style="background-color: #F8F9FA;">
                        <th class="text-left py-3 px-4">No</th>
                        <th class="text-left py-3 px-4">Nama Kelas</th>
                        <th class="text-left py-3 px-4">Jurusan</th>
                        <th class="text-center py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-4"><?php echo e($index + 1); ?></td>
                        <td class="py-3 px-4 font-medium"><?php echo e($item->nama_kelas); ?></td>
                        <td class="py-3 px-4"><?php echo e($item->jurusan); ?></td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="<?php echo e(route('admin.kelas.edit', $item->id)); ?>" class="text-blue-500 hover:text-blue-700 transition" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="<?php echo e(route('admin.kelas.destroy', $item->id)); ?>" method="POST" class="inline" id="deleteForm-<?php echo e($item->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="button" class="text-red-500 hover:text-red-700 transition" onclick="confirmDelete(<?php echo e($item->id); ?>, '<?php echo e($item->nama_kelas); ?>')" title="Hapus">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="py-12 text-center text-gray-500">
                            <i class="fas fa-building text-4xl mb-3 block opacity-50"></i>
                            Belum ada data kelas. Silakan tambah kelas baru.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Data?',
        text: "Yakin ingin menghapus kelas " + nama + "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6C9BCF',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm-' + id).submit();
        }
    });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\smartschedule\resources\views/admin/kelas/index.blade.php ENDPATH**/ ?>