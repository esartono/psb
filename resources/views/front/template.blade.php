<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Signika+Negative" rel="stylesheet">
    <title>PPDB Online - SIT Nurul Fikri</title>
    <style>
        body {
            padding: 10px;
            font-family: 'Signika Negative', sans-serif;
        }

        .table-bordered thead tr th{
            background-color:#dfe6e9;
            color:#2d3436;
        }

        .currency {
            text-align: right;
        }

        #exTab1 .tab-content {
            background-color: #fff;
            box-shadow: 0 3px 1px rgba(0, 0, 0, .125);
            padding: 30px;
            border-radius: 2px;
        }

        #exTab2 h3 {
            color: white;
            background-color: #428bca;
            padding: 5px 15px;
        }

        /* remove border radius for the tab */

        #exTab1 .nav-pills>li>a {
            border-radius: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="pull-left"><a href="/"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a></div>
        @yield('isi')
    </div>
</body>

</html>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
