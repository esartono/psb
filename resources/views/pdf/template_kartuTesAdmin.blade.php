<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PPDB SIT Nurul Fikri</title>
    <style type="text/css">
            /** Define the margins of your page **/
            @page {
                margin: 1cm 0cm;
            }

            .page-break {
                /* page-break-before: always; */
                page-break-inside: avoid;
            }

            .kartuAdmin, .kartuAdmin td {  
                border: 1px solid #ddd;
            }

            .kartuAdmin  {
                border-collapse: collapse;
                width: 100%;
            }

            .kartuAdmin td {
                padding: 8px;
            }

            .qr {
                margin-top: -10px;
                font-size: 22px !important;
            }
            .qrcode {
                margin: 15px;
            }
            .cardTest {
                font-size: 12px !important;
                width: 100%;
                border-collapse: collapse;
            }

            .cardTest, .cardTest th, .cardTest td {
                border: 1px solid black;
                padding: 6px;
            }

            .cardTest th h1 {
                margin: 1px;
                font-size: 34px !important;
            }

            .cardTest th h3 {
                margin: 10px 0px 0px 0px;
                font-size: 16px !important;
            }

            .wrapper-page {
                page-break-after: always;
            }

            .wrapper-page:last-child {
                page-break-after: avoid;
            }

            .page { width: 100%; height: 100%; }
        </style>
</head>

<body>
    <main>
        @yield('isi')
    </main>
</body>

</html>
