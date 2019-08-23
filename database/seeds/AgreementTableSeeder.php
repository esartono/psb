<?php

use App\Agreement;
use Illuminate\Database\Seeder;

class AgreementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agreement::create([
            'agreement' =>
            'Apakah Lorem Ipsum itu? Lorem Ipsum adalah contoh teks atau dummy dalam industri 
            percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar 
            contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil 
            sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. 
            Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf 
            elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan 
            diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, 
            dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga 
            memiliki versi Lorem Ipsum. Mengapa kita menggunakannya? <br>
            Sudah merupakan fakta bahwa seorang pembaca akan terpengaruh oleh isi tulisan dari 
            sebuah halaman saat ia melihat tata letaknya. Maksud penggunaan Lorem Ipsum adalah 
            karena ia kurang lebih memiliki penyebaran huruf yang normal, ketimbang menggunakan 
            kalimat seperti "Bagian isi disini, bagian isi disini", sehingga ia seolah menjadi 
            naskah Inggris yang bisa dibaca. Banyak paket Desktop Publishing dan editor situs web 
            yang kini menggunakan Lorem Ipsum sebagai contoh teks. Karenanya pencarian terhadap 
            kalimat "Lorem Ipsum" akan berujung pada banyak situs web yang masih dalam tahap 
            pengembangan. Berbagai versi juga telah berubah dari tahun ke tahun, kadang karena 
            tidak sengaja, kadang karena disengaja (misalnya karena dimasukkan unsur humor atau 
            semacamnya)<br>
            Dari mana asalnya?<br>
            Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. 
            Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, 
            hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, 
            seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari 
            makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, 
            yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di 
            literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum 
            berasal dari bagian 1.10.32 dan 1.10.33 dari naskah "de Finibus Bonorum et Malorum" 
            (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 
            sebelum masehi. Buku ini adalah risalah dari teori etika yang sangat terkenal pada 
            masa Renaissance. Baris pertama dari Lorem Ipsum, "Lorem ipsum dolor sit amet..", 
            berasal dari sebuah baris di bagian 1.10.32.<br>
            Bagian standar dari teks Lorem Ipsum yang digunakan sejak tahun 1500an kini di reproduksi 
            kembali di bawah ini untuk mereka yang tertarik. Bagian 1.10.32 dan 1.10.33 dari 
            "de Finibus Bonorum et Malorum" karya Cicero juga di reproduksi persis seperti 
            bentuk aslinya, diikuti oleh versi bahasa Inggris yang berasal dari terjemahan tahun 1914 
            oleh H. Rackham.<br>
            Dari mana saya bisa mendapatkannya?<br>
            Ada banyak variasi tulisan Lorem Ipsum yang tersedia, tapi kebanyakan sudah mengalami 
            perubahan bentuk, entah karena unsur humor atau kalimat yang diacak hingga nampak 
            sangat tidak masuk akal. Jika anda ingin menggunakan tulisan Lorem Ipsum, anda harus 
            yakin tidak ada bagian yang memalukan yang tersembunyi di tengah naskah tersebut. 
            Semua generator Lorem Ipsum di internet cenderung untuk mengulang bagian-bagian tertentu. 
            Karena itu inilah generator pertama yang sebenarnya di internet. Ia menggunakan kamus 
            perbendaharaan yang terdiri dari 200 kata Latin, yang digabung dengan banyak contoh 
            struktur kalimat untuk menghasilkan Lorem Ipsun yang nampak masuk akal. Karena itu 
            Lorem Ipsun yang dihasilkan akan selalu bebas dari pengulangan, unsur humor yang sengaja 
            dimasukkan, kata yang tidak sesuai dengan karakteristiknya dan lain sebagainya.<br>'
        ]);
    }
}
