@if($target_timestamp_ss - time() > 0)
  <div class="countdown ml-2">
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
  <p class="countdown">New Student Admission for the 2027/2028 Academic Year opens on<br> {{ $start }} WIB (UTC+7)</p>

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
@endif