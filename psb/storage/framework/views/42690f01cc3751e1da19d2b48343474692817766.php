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
                <th colspan="2" align="center" style="padding: 0px !important">
                    <img src="<?php echo $message->embedData(QrCode::format('png')->size(150)->generate($calonsnya->uruts), 'QrCode.png', 'image/png'); ?>">
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
                <th>Tes Seleksi</th>
                <td><b><?php echo e($calonsnya->jadwal->seleksinya); ?></b></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 2px !important; text-align: center"><h2>Kartu Wajib dibawa saat tes seleksi</h2></td>
            </tr>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tik/psb/resources/views/emails/seleksi.blade.php ENDPATH**/ ?>