<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>Kategori</th>
        <th>No. Pendaftaran</th>
        <th>No. NIK</th>
        <th>No. NISN</th>
        <th>Nama Lengkap</th>
        <th>Panggilan</th>
        <th>JK</th>
        <th>Tempat, Tanggal Lahir</th>
        <th>Kelas Tujuan</th>
        <th>Nama Ayah</th>
        <th>Pendidikan Ayah</th>
        <th>Pekerjaan Ayah</th>
        <th>Nama Ibu</th>
        <th>Pendidikan Ibu</th>
        <th>Pekerjaan Ibu</th>
        <th>No. Telepon</th>
        <th>Asal Sekolah</th>
        <th>Alamat</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $calons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $calon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($no++); ?></td>
            <td><?php echo e($calon->gelnya->unitnya->name); ?></td>
            <td><?php echo e($calon->cknya->name); ?></td>
            <td><?php echo e($calon->uruts); ?></td>
            <td>'<?php echo e($calon->nik); ?></td>
            <td>'<?php echo e($calon->nisn); ?></td>
            <td><?php echo e($calon->name); ?></td>
            <td><?php echo e($calon->panggilan); ?></td>
            <td><?php echo e($calon->kelamin); ?></td>
            <td><?php echo e($calon->lahir); ?></td>
            <td>Kelas <?php echo e($calon->kelasnya->name); ?></td>
            <td><?php echo e($calon->ayah_nama); ?></td>
            <td><?php echo e(App\Pendidikan::nama($calon->ayah_pendidikan)); ?></td>
            <td><?php echo e(App\Pekerjaan::nama($calon->ayah_pekerjaan)); ?></td>
            <td><?php echo e($calon->ibu_nama); ?></td>
            <td><?php echo e(App\Pendidikan::nama($calon->ibu_pendidikan)); ?></td>
            <td><?php echo e(App\Pekerjaan::nama($calon->ibu_pekerjaan)); ?></td>
            <td><?php echo e($calon->ayah_hp); ?>, <?php echo e($calon->ibu_hp); ?></td>
            <td><?php echo e($calon->asal_sekolah); ?></td>
            <td><?php echo e($calon->alamat); ?>, Kel. <?php echo e(App\Kelurahan::nama($calon->kelurahan)); ?> Kec. <?php echo e(App\Kecamatan::nama($calon->kecamatan)); ?> <?php echo e(App\Kota::nama($calon->kota)); ?> <?php echo e(App\Provinsi::nama($calon->provinsi)); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /home/tik/psb/resources/views/exports/cpd.blade.php ENDPATH**/ ?>