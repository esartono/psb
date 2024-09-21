<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>PPDB - SIT Nurul Fikri - Depok</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Bootstrap 4-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--icons-->
        <style>
            body {
                height: 100%;
            }
            .container {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                background: url(https://ceramahmotivasi.com/wp-content/uploads/2020/05/nurul-fikri-depok2.jpg) no-repeat center center; 

                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            ul#timer {
                list-style: none;
                /* margin: 1rem 0; */
                padding: 0;
                display: block;
                text-align: center;
            }
            ul#timer li {
                display: inline-block;
            }
            ul#timer li span {
                text-shadow: 2px 2px #ff0000;
                font-size: 2rem;
                font-weight: 700;
                line-height: 3rem;
            }
            ul#timer li .days {
                text-shadow: 2px 2px #ff0000;
                font-size: 4rem;
                font-weight: 700;
                line-height: 3rem;
            }

            ul#timer li.seperator {
                font-size: 2rem;
                line-height: 2.8rem;
                vertical-align: top;
            }
            ul#timer li p {
                /* color: #a7abb1; */
                margin-top: 10px;
                font-size: 1rem;
            }
            .bgnya {
                padding: 2rem 6rem;
                background-color: whitesmoke;
                opacity: 0.7;
                border: 4px solid grey;
                border-radius: 5rem;
            }
            h3 {
                font-weight: 900;
            }
            h4, h5 {
                font-weight: 700;
            }

        </style>
    </head>
    <body>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center col-fixed bgnya">
                        <h3 class="mb-3">PPDB SIT Nurul Fikri - Depok</h3>
                        <h5>New Student Admission for the 2025/2026 Academic Year open in</h5>
                        <hr>
                        <h4 class="mb-5">1th of September 2024 at 07.00 WIB</h4>
                        <ul id="timer">
                            <li><span class="days">1000</span><p class="days_text">Hari</p></li>
                            <ul id="timer">
                                <li><span class="hours">00</span><p class="hours_text">Hours</p></li>
                                <li class="seperator">:</li>
                                <li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
                                <li class="seperator">:</li>
                                <li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="https://www.designbombs.com/freebies-demo/syrup/js/countdown/jquery.countdown.min.js"></script>
    <script>
        $(function () {
            var now = new Date();
            var day = 1;
            var month = 9;
            var year = 2024;
            var hour = 2; //dikurangi 5 jam
            var minute = 0;
            var second = 0;

            var nextyear = month + '/' + day + '/' + year + ' ' + hour + ':' + minute + ':' + second;            
            $('#timer').countdown({
                date: nextyear,
                offset: +2,
                day: 'Day',
                days: 'Days'
            }, function () {
            });
        });
    </script>
    <script>
        var x = setInterval(function() {
            var res = $('.days').text();
            if(res == '00') {
                $('.days').hide();
                $('.days_text').hide();
            } else {
                $('.days').show();
                $('.days_text').show();
            }
        }, 1000);
    </script>
</html>
