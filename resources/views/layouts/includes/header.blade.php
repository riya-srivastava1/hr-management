<div id="header" class="app-header">
    <!-- BEGIN navbar-header -->
    <div class="navbar-header">
        <a href="{{ route('dashboard') }}" class="navbar-brand"><span class="navbar-logo"></span> <b>Hr</b>Management</a>
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <!-- END navbar-header -->
    <!-- BEGIN header-nav -->
    <div class="navbar-nav d-flex justify-content-between ">
        <div class="offset"></div>
        <div class="clock-buttons hidden   d-flex align-items-center m-0" id='clock-btns'>


            <h4 id='time' class="p-0 m-0"><span id="current-time"></span></h4>

            <div id="clockButtonsContainer">
                @if ($isClockedIn && $isClockedIn->clock_in)
                    @if ($isClockedIn->clock_out)
                        @if ($isClockedIn->clock_out && $isClockedIn->clock_in && today()->format('Y-m-d') == $isClockedIn->date)
                            <a class="btn btn-outline-primary mx-2" href="javascript:void(0);"
                                onclick="continueWorkingToday()">Continue Working Today</a>
                        @else
                            <a class="btn btn-outline-success mx-2" href="javascript:void(0);" onclick="clockIn()">Clock
                                In</a>
                        @endif
                    @else
                        <a class="btn btn-outline-danger mx-2" href="javascript:void(0);" onclick="clockOut()">Clock
                            Out</a>
                    @endif
                @else
                    <a class="btn btn-outline-success mx-2" href="javascript:void(0);" onclick="clockIn()">Clock In</a>
                @endif
            </div>
            <h4 id="timer" class="p-0 m-0">00:00:00</h4>

        </div>


        <div class="icons d-flex">

            @include('header-content.birthday')
            @include('header-content.notification')


            <div class="navbar-item navbar-user dropdown">
                <a href="javascript:;" class="navbar-link dropdown-toggle d-flex align-items-center"
                    data-bs-toggle="dropdown">
                    @if (Auth::user()->image ?? '')
                        <img src="{{ asset('') }}{{ Auth::user()->image ?? '' }}"
                            alt="{{ asset('assets/img/person-dummy-e1553259379744.jpg') }}" />
                    @else
                        <img src="{{ asset('assets/img/person-dummy-e1553259379744.jpg') }}"
                            alt="{{ asset('assets/img/person-dummy-e1553259379744.jpg') }}" />
                    @endif
                    <span>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end me-1">
                    <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item">logout</a>
                </div>
            </div>
        </div>


        <style>
            .navbar-item .navbar-link .badge {
                top: 4px !important;
                right: 5px !important;
            }
        </style>


    </div>
    <!-- END header-nav -->
</div>

<script>
    let clockBtns = document.querySelector('#clock-btns');
    let time = document.querySelector('#time');

    time.addEventListener('click', () => {
        clockBtns.classList.toggle('hidden');
    })
</script>
<script>
    // Global variables
    let startTime;
    let timerInterval;

    // Retrieve the start time and clock-in status from local storage
    startTime = localStorage.getItem('startTime');
    let clockInStatus = localStorage.getItem('clockInStatus');

    // Check if the timer was already running and the user is clocked in
    if (startTime && clockInStatus === 'true') {
        // Calculate the elapsed time
        let currentTime = new Date().getTime();
        let elapsedMilliseconds = currentTime - parseInt(startTime);

        // Start the timer with the elapsed time
        startTimer(elapsedMilliseconds);
    }

    // Function to start the timer
    function startTimer(initialElapsedMilliseconds = 0) {
        let elapsedMilliseconds = initialElapsedMilliseconds;

        // Update the timer display immediately
        updateTimerDisplay(elapsedMilliseconds);

        // Start the timer interval to update the display every second
        timerInterval = setInterval(() => {
            elapsedMilliseconds += 1000;
            updateTimerDisplay(elapsedMilliseconds);
        }, 1000);
    }

    // Function to update the timer display
    function updateTimerDisplay(elapsedMilliseconds) {
        // Convert elapsed time to hours, minutes, and seconds
        let hours = Math.floor(elapsedMilliseconds / 3600000);
        let minutes = Math.floor((elapsedMilliseconds % 3600000) / 60000);
        let seconds = Math.floor((elapsedMilliseconds % 60000) / 1000);

        // Format the time as "HH:MM:SS"
        const formattedTime =
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        // Update the timer display
        document.querySelector('#timer').innerText = formattedTime;
    }

    // Function to stop the timer
    function stopTimer() {
        clearInterval(timerInterval);
    }

    // Function to handle the clock-in event
    function clockIn() {
        // Make the AJAX request to clock in
        const userId = document.querySelector('#clockButtonsContainer').dataset.userId;

        $.ajax({
            url: "{{ route('clock.in') }}",
            type: "GET",
            data: {
                user_id: userId
            },
            success: function(response) {
                // Store the start time and clock-in status in local storage
                startTime = new Date().getTime();
                localStorage.setItem('startTime', startTime);
                localStorage.setItem('clockInStatus', 'true');

                // Start the timer
                startTimer();

                // Update the clock buttons container with clock-out button
                document.querySelector('#clockButtonsContainer').innerHTML =
                    '<a class="btn btn-outline-danger mx-2" href="javascript:void(0);" onclick="clockOut()">Clock Out</a>';

                // Handle the response if needed
            }
        });
    }

    // Function to handle the clock-out event
    function clockOut() {
        // Make the AJAX request to clock out
        const userId = document.querySelector('#clockButtonsContainer').dataset.userId;
        $.ajax({
            url: "{{ route('clock.out') }}",
            type: "GET",
            data: {
                user_id: userId
            },
            success: function(response) {
                // Stop the timer
                stopTimer();

                // Remove the start time and clock-in status from local storage
                localStorage.removeItem('startTime');
                localStorage.removeItem('clockInStatus');

                // Update the clock buttons container with the "Continue Working Today" button
                document.querySelector('#clockButtonsContainer').innerHTML =
                    '<a class="btn btn-outline-primary mx-2" href="javascript:void(0);"onclick="continueWorkingToday()">Continue Working Today</a>';

                // Handle the response if needed
            }
        });
    }
    // Function to handle the "Continue Working Today" button click
    function continueWorkingToday() {
        // Make the AJAX request to continue working today
        $.ajax({
            url: "{{ route('reset.clock.out') }}",
            type: "GET",
            success: function(response) {
                // Update the clock buttons container with the "Clock Out" button and its URL and type
                document.querySelector('#clockButtonsContainer').innerHTML =
                    '<a class="btn btn-outline-danger mx-2" href="javascript:void(0);" onclick="clockOut()">Clock Out</a>';
            }
        });
    }


    //for rapid time cange
    // Function to update the time
    function updateTime() {
        const currentTimeElement = document.getElementById('current-time');
        const now = new Date();
        const formattedTime = now.toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit',
            // second: '2-digit',
            hour12: true
        });
        currentTimeElement.textContent = formattedTime;
    }

    // Update the time immediately when the page loads
    updateTime();

    // Update the time every 1 second (1000 milliseconds)
    setInterval(updateTime, 1000);
</script>
