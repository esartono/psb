<p>Data Calon Siswa - Alamat (Kecamatan)</p>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Keterangan</th>
        <th>TK</th>
        <th>SD</th>
        <th>SMP</th>
        <th>SMA</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i=1; $i <= count($kecamatan['no']); $i++): ?>
        <tr>
            <td><?php echo e($kecamatan['no'][$i]); ?></td>
            <td><?php echo e($kecamatan['nama'][$i]); ?></td>
            <td><?php echo e($kecamatan['TK'][$i]); ?></td>
            <td><?php echo e($kecamatan['SD'][$i]); ?></td>
            <td><?php echo e($kecamatan['SMP'][$i]); ?></td>
            <td><?php echo e($kecamatan['SMA'][$i]); ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php /**PATH /home/tik/psb/resources/views/exports/statistik/kecamatan.blade.php ENDPATH**/ ?>