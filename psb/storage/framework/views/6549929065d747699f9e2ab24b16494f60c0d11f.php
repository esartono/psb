<p>Data Calon Siswa - Alamat (Kelurahan)</p>
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
    <?php for($i=1; $i <= count($kelurahan['no']); $i++): ?>
        <tr>
            <td><?php echo e($kelurahan['no'][$i]); ?></td>
            <td><?php echo e($kelurahan['nama'][$i]); ?></td>
            <td><?php echo e($kelurahan['TK'][$i]); ?></td>
            <td><?php echo e($kelurahan['SD'][$i]); ?></td>
            <td><?php echo e($kelurahan['SMP'][$i]); ?></td>
            <td><?php echo e($kelurahan['SMA'][$i]); ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php /**PATH /home/tik/psb/resources/views/exports/statistik/kelurahan.blade.php ENDPATH**/ ?>