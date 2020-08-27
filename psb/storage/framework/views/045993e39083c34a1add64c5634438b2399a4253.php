<p>Data Calon Siswa - Pendidikan Orang Tua</p>
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
        <th>Pendidikan Ayah</th>
        <th>Pendidikan Ibu</th>
        <th>Pendidikan Ayah</th>
        <th>Pendidikan Ibu</th>
        <th>Pendidikan Ayah</th>
        <th>Pendidikan Ibu</th>
        <th>Pendidikan Ayah</th>
        <th>Pendidikan Ibu</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i=1; $i <= count($pendidikan['no']); $i++): ?>
        <tr>
            <td><?php echo e($pendidikan['no'][$i]); ?></td>
            <td><?php echo e($pendidikan['nama'][$i]); ?></td>
            <td><?php echo e($pendidikan['ayahTK'][$i]); ?></td>
            <td><?php echo e($pendidikan['ibuTK'][$i]); ?></td>
            <td><?php echo e($pendidikan['ayahSD'][$i]); ?></td>
            <td><?php echo e($pendidikan['ibuSD'][$i]); ?></td>
            <td><?php echo e($pendidikan['ayahSMP'][$i]); ?></td>
            <td><?php echo e($pendidikan['ibuSMP'][$i]); ?></td>
            <td><?php echo e($pendidikan['ayahSMA'][$i]); ?></td>
            <td><?php echo e($pendidikan['ibuSMA'][$i]); ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php /**PATH /home/tik/psb/resources/views/exports/statistik/pendidikan.blade.php ENDPATH**/ ?>