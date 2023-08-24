<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Biaya PPDB Calon Siswa - SIT Nurul Fikri</title>
    <style type="text/css">
            /** Define the margins of your page **/
            @page {
                margin: 20px 50px 40px 50px;
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
                height: 50px;
                text-align: center;
                border-top: solid black 1px;
                padding: 10px;
                font-size: 14px;
            }

            .security {
                position: fixed;
                float: right;
                margin-top: 30px;
                margin-right: -40px;
            }

            .halaman {
                position: fixed;
                float: right;
                bottom: 87px;
                margin-right: -40px;
            }

            .page-break {
                page-break-before: always;
                margin-top: 130px;
            }

            main {
                margin-top: 105px;
            }

            p {
                margin-bottom: 0px;
            }

            ol {
                margin-top: 0px;
                margin-bottom: 0px;
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
        <div class="halaman">{{ Str::title($calon->name) }} ({{ $calon->uruts }}) - hal. <span class="pagenum"></span></div>
        <b>Panitia Penerimaan Peserta Didik Baru SIT Nurul Fikri, Kota Depok - Jawa Barat </b><br>
        informasi lebih lanjut hubungi Panitia +62 822 1133 3434 (Whatsapp/Telegram)<br>
        Telepon: TK +62 21 870 8919, SD +62 21 872 0645, SMP +62 21 870 8300, SMA +62 21 872 2070<br>
        Website: ppdb.nurulfikri.sch.id -- Email: psb@nurulfikri.sch.id
    </footer>
    <main>
        @yield('isi')
    </main>
</body>
</html>
