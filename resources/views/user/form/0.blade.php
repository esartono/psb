<style>
    ul.jam {
        padding: 0px !important;
    }
	ul.jam li {
		display: inline-block;
		font-size: 1.25em;
		list-style-type: none;
		padding: 0.5em 1.5em;
        margin: 0 0.5em;
		text-transform: uppercase;
		color: red;
        background-color: yellowgreen;
        border-radius: 0.25em;
	}

	ul.jam li span {
		display: block;
		font-size: 3em;
	}
    @media only screen and (max-width: 800px) {
        ul.jam li {
            font-size: 1em;
            padding: 0.25em 1em;
            margin: 0 0.25em;
            border-radius: 0.25em;
        }

        ul.jam li span {
            font-size: 2em;
        }
    }
    @media only screen and (max-width: 450px) {
        ul.jam li {
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
    <div class="card col-sm-8 offset-sm-2 border-warning countdown mt-4">
        <ul class="jam mt-2">
            <li><span id="days" class="mb-1"></span>hari</li>
            <li><span id="hours" class="mb-1"></span>jam</li>
            <li><span id="minutes" class="mb-1"></span>menit</li>
            <li><span id="seconds" class="mb-1"></span>detik</li>
        </ul>
    </div>
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