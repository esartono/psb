@extends('layouts.login')
@push('style')
<style>
	.countdown {
	  margin-bottom: 10px;
	  padding: 10px;
	  display: flex;
	  flex-direction: row;
	  justify-content: flex-start;
	  /* color: var(--primary); */
	  color: darkblue;
	}

	@media only screen and (max-width: 1024px) {
	  .countdown {
		justify-content: center;
	  }
	}

	.countdown .time {
	  display: flex;
	  flex-direction: column;
	  justify-content: start;
	}

	.countdown .time:not(:last-child) {
	  margin-right: 5px;
	}

	.countdown .time #days,
	.countdown .time #hours,
	.countdown .time #minutes,
	.countdown .time #seconds,
	.countdown .time .semicolon {
	  font-family: Samsung Sharp Sans;
	  font-style: normal;
	  font-weight: bold;
	  letter-spacing: 0.3px;
	}

	@media only screen and (min-width: 1024px) {

	  .countdown .time #days,
	  .countdown .time #hours,
	  .countdown .time #minutes,
	  .countdown .time #seconds,
	  .countdown .time .semicolon {
		font-size: 40px;
		line-height: 50px;
	  }
	}

	@media only screen and (max-width: 1024px) {

	  .countdown .time #days,
	  .countdown .time #hours,
	  .countdown .time #minutes,
	  .countdown .time #seconds,
	  .countdown .time .semicolon {
		font-size: 40px;
		line-height: 50px;
		text-align: center;
	  }
	}

	.countdown .time span {
	  font-family: Samsung Sharp Sans;
	  font-style: normal;
	  font-weight: normal;
	  line-height: 15px;
	  text-align: center;
	  letter-spacing: 0.3px;
	  align-self: center;
	}

	.countdown .semicolon {
	  margin-right: 16px;
	  display: flex;
	  flex-direction: column;
	  justify-content: flex-start;
	  font-family: Samsung Sharp Sans;
	  font-style: normal;
	  font-weight: bold;
	  letter-spacing: 0.3px;
	}

	@media only screen and (min-width: 1024px) {
	  .countdown .semicolon {
		font-size: 40px;
		line-height: 50px;
	  }
	}

	@media only screen and (max-width: 1024px) {
	  .countdown .semicolon {
		font-size: 40px;
		line-height: 50px;
		text-align: center;
	  }
	}
  </style>
@endpush

@section('content')

@php
    // $tp = \App\TahunPelajaran::where('status', 1)->first(); 
	$tp = taId(); 

    if ($tp) {
        $gelombang = \App\Gelombang::where('tp', $tp)->orderBy('start', 'asc')->first(); 
    } else {
        $gelombang = null;
    }

    if ($gelombang) { 
        $mulai_pendaftaran = date('Y-m-d', strtotime($gelombang->start)) . ' 08:00:00'; 
    } else { 
        $mulai_pendaftaran = date('Y') . '-09-01 08:00:00'; 
    }

    // Timestamp untuk pembandingan PHP dan JavaScript
    $target_timestamp_sec = strtotime($mulai_pendaftaran);
    $target_timestamp_ms = $target_timestamp_sec * 1000;

    // Cek apakah waktu pendaftaran sudah dibuka
    $is_open = time() >= $target_timestamp_sec;
@endphp

@if($is_open)
    <a href="{{ url('auth/google') }}" class="btn btn-primary btn-block sign-in" style="margin-top: 1em">
        <img src="https://www.google.com/favicon.ico">
        PENDAFTAR/CALON SISWA
    </a>
    *untuk yang sudah mendaftar silahkan login menggunakan akun email saat pendaftaran
@else
    <div class="countdown">
      <div class="time">
        <span id="days">00</span>
        <span>days</span>
      </div>
      <div class="semicolon">:</div>
      <div class="time">
        <span id="hours">00</span>
        <span>hours</span>
      </div>
      <div class="semicolon">:</div>
      <div class="time">
        <span id="minutes">00</span>
        <span>minutes</span>
      </div>
      <div class="semicolon">:</div>
      <div class="time">
        <span id="seconds">00</span>
        <span>seconds</span>
      </div>
    </div>
@endif
<hr>
<a href=" {{ url('login/admin') }}" class="btn btn-block btn-outline-primary" style="">
    <span><i class="fas fa-user-shield"></i></span> Panitia
</a>
@endsection
@if(!$is_open)
    @push('jawa')
    <script>
        // 3. Inject the server-calculated PHP timestamp securely into JavaScript
        const targetTime = <?php echo $target_timestamp_ms; ?>;

        // 4. Update the countdown every single second
        const timerInterval = setInterval(function() {  
        // Get the current local time in milliseconds
        const now = new Date().getTime();
        // Calculate the remaining time difference
        const difference = targetTime - now;
        // If the countdown is finished, clear the timer and display a message
        if (difference <= 0) {
            clearInterval(timerInterval);
            window.location.reload();
            return;
        }
        // Time math conversions for Days, Hours, Minutes, and Seconds
        const days = Math.floor(difference / (1000 * 60 * 60 * 24));
        const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((difference % (1000 * 60)) / 1000);
        // Output the formatted string to the browser
        // document.getElementById("app-name") = hide;
        document.getElementById("days").innerHTML = String(days).padStart(2, '0');
        document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
        document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
        document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');
        }, 1000);
    </script>
    @endpush
@endif