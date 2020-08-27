<?php $__env->startSection('isi'); ?>
    <div>
        <b><i>Assalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
        Kami sampaikan terima kasih kepada bapak/ibu yang telah melakukan pembayaran biaya daftar ulang dalam proses
        Penerimaan Peserta Dididk Baru Sekolah Islam Terpadu Nurul Fikri tahun ajaran 2020/2021, untuk data peserta didik adalah sebagai berikut :
        </div>
        <table class="biodata">
            <tr>
                <th width="30%">No. Pendaftaran</th>
                <td><?php echo e($calonsnya->uruts); ?></td>
            </tr>
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
                <td>Kelas <?php echo e($calonsnya->kelasnya->name); ?></td>
            </tr>
        </table>
        <br>
        Dokumen ini berlaku sebagai <b>Bukti Daftar Ulang</b>.
        <br>
        <br>
        Bukti Daftar Ulang Peserta Didik Baru Sekolah Islam Terpadu Nurul Fikri ini agar disimpan dengan baik untuk dipergunakan dalam proses berikutnya.
        <br>
        <br>
        <p>Tertanda</p>
        <br>
        <br>
        <br>
        <b>Panitia PPDB SIT Nurul Fikri</b>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pdf.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tik/psb/resources/views/pdf/daul.blade.php ENDPATH**/ ?>