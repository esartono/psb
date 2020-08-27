<p>Data Calon Siswa - Penghasilan Orang Tua</p>
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
        <th>Penghasilan Ayah</th>
        <th>Penghasilan Ibu</th>
        <th>Penghasilan Ayah</th>
        <th>Penghasilan Ibu</th>
        <th>Penghasilan Ayah</th>
        <th>Penghasilan Ibu</th>
        <th>Penghasilan Ayah</th>
        <th>Penghasilan Ibu</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i=1; $i <= count($penghasilan['no']); $i++): ?>
        <tr>
            <td><?php echo e($penghasilan['no'][$i]); ?></td>
            <td><?php echo e($penghasilan['nama'][$i]); ?></td>
            <td><?php echo e($penghasilan['ayahTK'][$i]); ?></td>
            <td><?php echo e($penghasilan['ibuTK'][$i]); ?></td>
            <td><?php echo e($penghasilan['ayahSD'][$i]); ?></td>
            <td><?php echo e($penghasilan['ibuSD'][$i]); ?></td>
            <td><?php echo e($penghasilan['ayahSMP'][$i]); ?></td>
            <td><?php echo e($penghasilan['ibuSMP'][$i]); ?></td>
            <td><?php echo e($penghasilan['ayahSMA'][$i]); ?></td>
            <td><?php echo e($penghasilan['ibuSMA'][$i]); ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php /**PATH /home/tik/psb/resources/views/exports/statistik/penghasilan.blade.php ENDPATH**/ ?>