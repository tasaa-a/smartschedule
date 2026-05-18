<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jadwal Mengajar - <?php echo e($guru->nama); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 1.5cm;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 18pt;
            margin: 0;
        }
        .header h3 {
            font-size: 14pt;
            margin: 5px 0;
        }
        .info-guru {
            margin: 15px 0;
            font-size: 12pt;
            border: 1px solid #000;
            padding: 8px;
            background: #f9f9f9;
        }
        .jadwal-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .jadwal-table th, .jadwal-table td {
            border: 1px solid black;
            padding: 6px 4px;
            vertical-align: top;
        }
        .jadwal-table th {
            background-color: #e0e0e0;
            font-weight: bold;
            text-align: center;
        }
        .istirahat {
            background-color: #f5f5f5;
            font-style: italic;
            text-align: center;
        }
        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 10pt;
            border-top: 1px solid #ccc;
            padding-top: 8px;
        }
        .jam-col {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>SMK Negeri 1 Babelan</h1>
    <h3>Jadwal Mengajar Guru</h3>
    <p>Tahun Ajaran 2025/2026</p>
</div>

<div class="info-guru">
    <strong>Nama Guru:</strong> <?php echo e($guru->nama); ?> &nbsp;&nbsp;|&nbsp;&nbsp;
    <strong>NIP:</strong> <?php echo e($guru->nip); ?>

</div>

<?php $__currentLoopData = $jadwalGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari => $jadwalList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($jadwalList->count()): ?>
        <h4 style="margin: 15px 0 5px 0; background: #d9e1f2; padding: 5px;">Hari : <?php echo e($hari); ?></h4>
        <table class="jadwal-table">
            <thead>
                <tr>
                    <th width="10%">Jam ke-</th>
                    <th width="20%">Waktu</th>
                    <th width="40%">Kelas</th>
                    <th width="30%">Mata Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $prevEnd = null;
                ?>
                <?php $__currentLoopData = $jadwalList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $jamMulai = substr($j->jamPelajaran->jam_mulai, 0, 5);
                        $jamSelesai = substr($j->jamPelajaran->jam_selesai, 0, 5);
                        
                        // Deteksi istirahat (jika jeda > 15 menit)
                        if ($prevEnd && $jamMulai > $prevEnd) {
                            $breakStart = $prevEnd;
                            $breakEnd = $jamMulai;
                            echo "<tr class='istirahat'>";
                            echo "<td colspan='2'>ISTIRAHAT</td>";
                            echo "<td colspan='2'>$breakStart - $breakEnd</td>";
                            echo "</tr>";
                        }
                        $prevEnd = $jamSelesai;
                    ?>
                    <tr>
                        <td class="jam-col"><?php echo e($no++); ?></td>
                        <td class="jam-col"><?php echo e($jamMulai); ?> - <?php echo e($jamSelesai); ?></td>
                        <td><?php echo e($j->kelas->nama_kelas); ?> (<?php echo e($j->kelas->jurusan); ?>)</td>
                        <td><?php echo e($j->mataPelajaran->nama_mapel); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="footer">
    Dicetak pada: <?php echo e($tanggal_cetak); ?><br>
    SmartSchedule - Sistem Informasi Penjadwalan Akademik
</div>

</body>
</html><?php /**PATH C:\laragon\www\smartschedule\resources\views/guru/export-pdf.blade.php ENDPATH**/ ?>