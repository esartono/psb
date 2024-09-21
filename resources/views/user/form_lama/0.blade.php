<style type="text/css">
    .countdown ul {
		color: #024A81;
		display: inline;
	}
	.countdown ul li {
		margin: 0px 5px;
		display: inline-block;
		width: 100px;
		border: #024A81 2px solid;
		background-color: #fff;
		padding: 15px 20px;
		border-radius: 15px;
	}
	.countdown ul li span {
		font-size: 40px;
	}
	.countdown ul li span::after {
		content: "\a";
		white-space: pre;
	}
    @media only screen and (max-width: 800px) {
        ul.jam li {
            width: 80px;
            font-size: 1em;
            padding: 0.25em 1em;
            margin: 0 0.25em;
            border-radius: 0.5em;
        }

        ul.jam li span {
            font-size: 2em;
        }
    }
    @media only screen and (max-width: 450px) {
        ul.jam li {
            width: 50px;
            font-size: 0.75em;
            padding: 0.1em 0.5em;
            margin: 0 0.25em;
            border-radius: 0.25em;
        }

        ul.jam li span {
            font-size: 2em;
        }
    }
</style>
<div class="text-center">
    <h4 class="mb-3">Pendaftaran Peserta Didik Baru - SIT Nurul Fikri akan dimulai :</h4>
    <div class="col-sm-8 offset-sm-2 border-warning countdown mt-4">
        <ul class="jam mt-2">
            <li><span id="days"></span>hari</li>
            <li><span id="hours"></span>jam</li>
            <li><span id="minutes"></span>menit</li>
            <li><span id="seconds"></span>detik</li>
        </ul>
    </div>
    <br>

    <a href="/ppdb" type="button" class="btn bg-danger btn-lg">
        <i class="fas fa-home"></i> &nbsp; Kembali ke Dashboard
    </a>
</div>
<script>
    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

    let countDown = new Date('{{ $start }}').getTime(),
        x = setInterval(function() {

        let now = new Date().getTime(),
        distance = countDown - now;

        document.getElementById('days').innerText = Math.floor(distance / (day)),
        document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
        document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
        document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

        //do something later when date is reached
        if (distance < 0) {
            $(".countdown").hide();
        }

        }, second)
</script>