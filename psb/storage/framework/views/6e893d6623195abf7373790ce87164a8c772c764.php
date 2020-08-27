<p>Data Calon Siswa - Alamat (Kota/Kabupaten)</p>
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
    <?php for($i=1; $i <= count($kota['no']); $i++): ?>
        <tr>
            <td><?php echo e($kota['no'][$i]); ?></td>
            <td><?php echo e($kota['nama'][$i]); ?></td>
            <td><?php echo e($kota['TK'][$i]); ?></td>
            <td><?php echo e($kota['SD'][$i]); ?></td>
            <td><?php echo e($kota['SMP'][$i]); ?></td>
            <td><?php echo e($kota['SMA'][$i]); ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php /**PATH /home/tik/psb/resources/views/exports/statistik/kota.blade.php ENDPATH**/ ?>