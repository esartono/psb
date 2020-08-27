<p>Data Calon Siswa - Alamat (Provinsi)</p>
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
    <?php for($i=1; $i <= count($provinsi['no']); $i++): ?>
        <tr>
            <td><?php echo e($provinsi['no'][$i]); ?></td>
            <td><?php echo e($provinsi['nama'][$i]); ?></td>
            <td><?php echo e($provinsi['TK'][$i]); ?></td>
            <td><?php echo e($provinsi['SD'][$i]); ?></td>
            <td><?php echo e($provinsi['SMP'][$i]); ?></td>
            <td><?php echo e($provinsi['SMA'][$i]); ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php /**PATH /home/tik/psb/resources/views/exports/statistik/provinsi.blade.php ENDPATH**/ ?>