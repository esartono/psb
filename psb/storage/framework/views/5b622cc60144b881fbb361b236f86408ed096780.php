<?php $__env->startSection('isi'); ?>
        <p>
        <b><i>Assalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
        Terimakasih anda telah melakukan pendaftaran calon siswa baru SIT Nurul Fikri. Ini merupakan tahap awal dari Pendaftaran Penerimaan Siswa Baru SIT Nurul Fikri.
        Berikut data yang telah Anda isikan :
        </p>
        <table class="biodata">
            <tr>
                <th width="30%">Nama Lengkap</th>
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
        </table>
        <br>
        <center>Nomor pendaftarannya adalah : </center>
        <table class="kotak">
            <tr>
                <td><?php echo e($calonsnya->uruts); ?></td>
            </tr>
        </table>
        <p>Untuk melanjutkan proses pendaftaran, silakan melunasi biaya pendaftaran sejumlah:
            Rp. <?php echo e(number_format($calonsnya->biayates->biayanya->biaya)); ?>,-, 
            batas waktu pembayaran sampai tanggal : <b><?php echo e(date('d M Y', strtotime($calonsnya->biayates->expired))); ?></b></p>
        <p>Terima kasih.</p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tik/psb/resources/views/emails/biayates.blade.php ENDPATH**/ ?>