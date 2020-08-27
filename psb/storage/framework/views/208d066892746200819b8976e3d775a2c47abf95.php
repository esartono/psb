<?php $__env->startSection('isi'); ?>
    <div>
        <table class="cardTest" align="center">
            <tr>
                <th colspan="2"  align="center">
                    <h1>KARTU SELEKSI</h1>
                    <h3><?php echo e($calonsnya->gelnya->unitnya->name); ?></h3>
                </th>
            </tr>
            <tr>
                <th colspan="2" align="center">
                    <img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(150)->generate($calonsnya->uruts)); ?> ">
                    <div class="qr"><?php echo e($calonsnya->uruts); ?> </div>
                </th>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td><?php echo e($calonsnya->name); ?></td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td><?php echo e($calonsnya->kelamin); ?></td>
            </tr>
            <tr>
                <th>Tempat, Tanggal Lahir</th>
                <td><?php echo e($calonsnya->lahir); ?></td>
            </tr>
            <tr>
                <th>Kelas Tujuan</th>
                <td><?php echo e($calonsnya->kelasnya->name); ?></td>
            </tr>
            <tr>
                <th>Asal Sekolah</th>
                <td><?php echo e($calonsnya->asal_sekolah); ?></td>
            </tr>
            <tr>
                <th>Tes Seleksi</th>
                <td><b><?php echo e($calonsnya->jadwal->seleksinya); ?></b></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 2px !important; text-align: center">
                    <h2>Kartu Wajib dibawa saat tes seleksi</h2>
                    <?php switch($calonsnya->gelnya->unitnya->catnya->name):
                        case ('TK'): ?>
                            <p>Jam 07.30 - 10.00 WIB di TKIT Nurul Fikri</p>
                            <?php break; ?>
                        <?php case ('SMP'): ?>
                            <p>Jam 07.00 - 15.00 WIB di SMPIT Nurul Fikri</p>
                            <?php break; ?>
                        <?php case ('SMA'): ?>
                            <p>Jam 07.00 - 15.00 WIB di SMAIT Nurul Fikri</p>
                            <?php break; ?>
                        <?php default: ?>
                    <?php endswitch; ?>
                </td>
            </tr>
        </table>
    </div>
    <!-- <div class="page-break"></div>
    <div class="hal2">
        <?php echo $__env->make('pdf.teskesehatan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div> -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pdf.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tik/psb/resources/views/pdf/seleksi.blade.php ENDPATH**/ ?>