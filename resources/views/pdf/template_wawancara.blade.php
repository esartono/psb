<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Seleksi Wawancara PPDB Calon Siswa - SIT Nurul Fikri</title>
    <style type="text/css">
            /** Define the margins of your page **/
            @page {
                margin: 30px 40px 10px 40px;
            }

            header {
                position: fixed;
                top: -40px;
                left: 0px;
                right: 0px;
                height: 5px;
                /* border-bottom: solid black 1px; */
                /* line-height: 35px; */
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
                border-top: solid black 1px;
                width: 90%;
                margin: 0px;
                /* float: right; */
                text-align: right;
                bottom: 35px;
            }

            .page-break {
                page-break-after: always;
                margin-top: 25px;
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
                margin-top: 80px;
                font-size: 13.5px !important;
                text-align: justify;
                text-justify: inter-word;
            }

        </style>
</head>

<body>
    <header>
        <table>
            <tr>
                <td align="center" width="120px"><img src="img/logo.png" alt="Logo NF" height="100" width="100" style="margin: 10px 0 0 0;"></img></td>
                <td>
                    <h1 style="margin-bottom: -15px">Seleksi Wawancara</h1>
                    <h2>PPDB Nurul Fikri Islamic School - TP. {{ Auth::user()->tpname }}</h2>
                </td>
                {{-- <div class="security"></div> --}}
            </tr>
        </table>
        <hr style="margin-top: -10px">

    </header>
    {{-- <div class="main"> --}}
        @yield('isi')
    {{-- </div> --}}
</body>
</html>
