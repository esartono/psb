<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Biaya PPDB Calon Siswa - SIT Nurul Fikri</title>
    <style type="text/css">
            /** Define the margins of your page **/
            @page {
                margin: 10px 60px 40px 60px;
            }

            header {
                position: fixed;
                top: 0px;
                left: 0px;
                right: 0px;
                border-bottom: solid black 1px;
            }

            footer {
                position: fixed;
                bottom: 0px;
                left: 0px;
                right: 0px;
                height: 60px;
                border-top: solid black 1px;
                padding-bottom: 5px;
                font-size: 14px;
            }

            .qrsecurity {
                position: absolute;
                float: left;
                bottom: 35px;
            }

            .halaman {
                position: fixed;
                float: right;
                bottom: 85px;
            }

            .page-break {
                page-break-before: always;
                margin-top: 125px;
            }

            main {
                margin-top: 90px;
            }

            p {
                margin-bottom: 0px;
            }

            ol {
                margin-top: 0px;
                margin-bottom: 0px;
            }
            li {
                text-align: justify;
            }

            .pagenum:before {
                content: counter(page);
            }

            .main {
                font-size: 16px;
                text-align: justify;
                text-justify: inter-word;
            }

        </style>
</head>

<body>
    <header>
        <table>
            <tr>
                <td align="center" width="120px"><img src="img/logo.png" alt="Logo NF" height="100" width="100"></img></td>
                <td>
                    <h1 style="margin-bottom: -15px">Sekolah Islam Terpadu Nurul Fikri</h1>
                    <h2>TKIT - SDIT - SMPIT - SMAIT Nurul Fikri</h2>
                </td>
                <div class="security"></div>
            </tr>
        </table>
    </header>
    <footer>
        <div class="panitia" style= "padding-left: 100px">
            <b>Panitia Penerimaan Peserta Didik Baru SIT Nurul Fikri, Kota Depok - Jawa Barat </b>
            <br>informasi lebih lanjut hubungi Panitia +62 822 1133 3434 (Whatsapp/Telegram)
            <br>Telepon: TK +62 21 870 8919, SD +62 21 872 0645, SMP +62 21 870 8300, SMA +62 21 872 2070
            <br>Website: ppdb.nurulfikri.sch.id -- Email: psb@nurulfikri.sch.id
        </div>
        <div class="halaman">{{ Str::title($calon->name) }} ({{ $calon->uruts }}) - hal. <span class="pagenum"></span></div>
        <div class="qrsecurity">
            <img class="qrcode" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->margin(0.7)->merge('img/logo.png', .2, true)->generate($calon->uruts.'::')) !!} ">
        </div>
    </footer>
    <main>
        @yield('isi')
    </main>
</body>
</html>
