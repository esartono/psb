<p>Data Calon Siswa - Pekerjaan Orang Tua</p>
<table>
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Keterangan</th>
        <th colspan="2">TK</th>
        <th colspan="2">SD</th>
        <th colspan="2">SMP</th>
        <th colspan="2">SMA</th>
    </tr>
    <tr>
        <th>Pekerjaan Ayah</th>
        <th>Pekerjaan Ibu</th>
        <th>Pekerjaan Ayah</th>
        <th>Pekerjaan Ibu</th>
        <th>Pekerjaan Ayah</th>
        <th>Pekerjaan Ibu</th>
        <th>Pekerjaan Ayah</th>
        <th>Pekerjaan Ibu</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i=1; $i <= count($pekerjaan['no']); $i++): ?>
        <tr>
            <td><?php echo e($pekerjaan['no'][$i]); ?></td>
            <td><?php echo e($pekerjaan['nama'][$i]); ?></td>
            <td><?php echo e($pekerjaan['ayahTK'][$i]); ?></td>
            <td><?php echo e($pekerjaan['ibuTK'][$i]); ?></td>
            <td><?php echo e($pekerjaan['ayahSD'][$i]); ?></td>
            <td><?php echo e($pekerjaan['ibuSD'][$i]); ?></td>
            <td><?php echo e($pekerjaan['ayahSMP'][$i]); ?></td>
            <td><?php echo e($pekerjaan['ibuSMP'][$i]); ?></td>
            <td><?php echo e($pekerjaan['ayahSMA'][$i]); ?></td>
            <td><?php echo e($pekerjaan['ibuSMA'][$i]); ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php /**PATH /home/tik/psb/resources/views/exports/statistik/pekerjaan.blade.php ENDPATH**/ ?>