<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Biaya TES Calon Siswa - SIT Nurul Fikri</title>
    <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 50px 120px 50px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                border-bottom: solid black 1px;
            }

            main {
                margin-top: 120px;
            }

            .biodata {
                width: 100%;
                margin: 25px;
                border-collapse: collapse;
            }

            .biodata, .biodata th, .biodata td {
                border: 1px solid black;
                padding: 10px;
            }

            .qr {
                margin: -20px 0px 10px 0px;
                font-size: 20px !important;
            }

            .cardTest {
                font-size: 13px !important;
                width: 80%;
                border-collapse: collapse;
            }

            .cardTest, .cardTest th, .cardTest td {
                border: 1px solid black;
                padding: 10px;
            }

            .cardTest th h1 {
                margin: 0px;
                font-size: 25px !important;
            }

            .cardTest th h3 {
                margin: 10px 0px 0px 0px;
                font-size: 15px !important;
            }

            .kotak {
                width: 100%;
                margin: 0 25px 0px 25px;
                border-collapse: collapse;
                font-size: 40px;
                font-weight: bolder;
                text-align: center;
            }

            .kotak, .kotak th, .kotak td {
                border: 1px solid black;
                padding: 10px;
            }

        </style>
</head>

<body>
    <header>
        <table>
            <tr>
                <td></td>
                <td>
                    <h1>Sekolah Islam Terpadu Nurul Fikri</h1>
                    <h2>TKIT - SDIT - SMPIT - SMAIT Nurul Fikri </h2>
                </td>
            </tr>
        </table>
    </header>
    <main>
        @yield('isi')
    </main>
    <hr>
        <b>Panitia Penerimaan Siswa Baru SIT Nurul Fikri, Kota Depok - Jawa Barat </b><br>
        informasi lebih lanjut hubungi Panitia +62 822 1133 3434 (Whatsapp/Telegram)<br>
        Telepon: TK +62 21 870 8919, SD +62 21 872 0645, SMP +62 21 870 8300, SMA +62 21 872 2070<br>
        Website: psb.nurulfikri.sch.id -- Email: psb@nurulfikri.sch.id
</body>

</html>
