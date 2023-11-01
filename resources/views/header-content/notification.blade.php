{{-- Notification for leave HR or TL  --}}
@if (Auth::user()->role == '1' || Auth::user()->role == '0')
    <div class="navbar-item dropdown notification">
        <a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon ">
            <i class="fa fa-bell"></i>
            @if ($total > 0)
                <span class="badge"> {{ $total }}</span>
            @endif
        </a>
        <div class="dropdown-menu media-list dropdown-menu-end">
            <div class="dropdown-header ">NOTIFICATIONS ({{ $total }})</div>
            @if ($total > 0)
                @if ($leavescount > 0)
                    <a href="{{ route('leave.index') }}" class="dropdown-item media">
                        <div class="media-body">
                            <h6 class="media-heading">Request for Leave - <span
                                    style="color: red">({{ $leavescount }})</span>
                            </h6>
                            @if ($leavescount > 0)
                                <div class="text-muted fs-10px">
                                    {{ \Carbon\Carbon::parse($leaves[0]['created_at'] ?? '')->diffForHumans() }}
                                </div>
                            @endif
                        </div>
                    </a>
                @endif

                @if ($markAttendancescount > 0)
                    <a href="{{ route('mark.index') }}" class="dropdown-item media">
                        <div class="media-body">
                            <h6 class="media-heading">Request for Attendance <span
                                    style="color: red">({{ $markAttendancescount }})</span>
                            </h6>
                            @if ($markAttendancescount > 0)
                                <div class="text-muted fs-10px">

                                    {{ \carbon\carbon::parse($markAttendances[0]['created_at'] ?? '')->diffForHumans() }}

                                </div>
                            @endif
                        </div>
                    </a>
                @endif

                @if ($reimburscount > 0)
                    <a href="{{ route('reimbursement.index') }}" class="dropdown-item media">
                        <div class="media-body">
                            <h6 class="media-heading">Reimbursement - <span
                                    style="color: red">({{ $reimburscount }})</span>
                            </h6>
                            @if ($reimburscount > 0)
                                <div class="text-muted fs-10px">
                                    {{ \Carbon\Carbon::parse($reimburs[0]['created_at'] ?? '')->diffForHumans() }}
                                </div>
                            @endif
                        </div>
                    </a>
                @endif
                @else
                <img src="{{ asset('assets/img/no_data_found.png') }}" alt="">
                @endif

        </div>


    </div>
@endif
{{-- !Notification for leave HR --}}


{{-- Notification for Employees  --}}
@if (Auth::user()->role == '2')
    <div class="navbar-item dropdown notification">
        <a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon ">
            <i class="fa fa-bell"></i>
            @if ($totalcount > 0)
                <span class="badge"> {{ $totalcount }}</span>
            @endif
        </a>
        <div class="dropdown-menu media-list dropdown-menu-end">
            <div class="dropdown-header">NOTIFICATIONS ({{ $totalcount }})</div>

            <a href="{{ route('leave.create') }}" class="dropdown-item media">
                <div class="media-left">
                </div>
                <div class="media-body">
                    <h6 class="media-heading"> Leave Status - <span style="color: red">({{ $empleavecount }})</span>
                    </h6>
                    @if ($empleavecount > 0)
                        <div class="text-muted fs-10px">
                            {{ \Carbon\Carbon::parse($empleaves[0]['updated_at'] ?? '')->diffForHumans() }}

                        </div>
                    @endif
                </div>
            </a>
            <a href="{{ route('reimbursement.create') }}" class="dropdown-item media">
                <div class="media-left">
                </div>
                <div class="media-body">
                    <h6 class="media-heading">Reimbursement Status - <span
                            style="color: red">({{ $reimbursempcount }})</span>
                    </h6>
                    @if ($reimbursempcount > 0)
                        <div class="text-muted fs-10px">
                            {{ \Carbon\Carbon::parse($reimbursemps[0]['updated_at'] ?? '')->diffForHumans() }}
                        </div>
                    @endif
                </div>
            </a>

            <a href="{{ route('mark.create') }}" class="dropdown-item media">
                <div class="media-left">
                </div>
                <div class="media-body">
                    <h6 class="media-heading">Mark Attendance Approved - <span
                            style="color: red">({{ $markAttendmpcount }})</span>
                    </h6>
                    @if ($markAttendmpcount > 0)
                        <div class="text-muted fs-10px">
                            {{ \Carbon\Carbon::parse($markAttendmps[0]['updated_at'] ?? '')->diffForHumans() }}
                        </div>
                    @endif
                </div>
            </a>
        </div>
    </div>
@endif

{{-- !Notification for HR --}}


{{--
<audio id="notification-sound" autoplay>
    @if (Auth::user()->role == '1' || Auth::user()->role == '0')
        <source src="{{ asset('assets/mp3/Notification_sound.mp3') }}" type="audio/mpeg">
    @endif
</audio>

<script>
    setInterval(checkCount, 5000);
    let currentCount = {{ $total }};
    let initialCount = {{ $total }};

    let audioPlayer = document.getElementById('audio-player');

    console.log('before reset initial count is:', initialCount, 'before reset currentCount is', currentCount);


    function checkCount() {
        $.ajax({
            url: "{{ route('count.increment') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            success: function(data) {
                currentCount = data;
                console.log('after request sucees is', currentCount, 'and inital count is', initialCount)
                if (currentCount > initialCount) {
                    playNotificationSound();
                    // audioPlayer.click();
                    console.log(currentCount);
                    initialCount = currentCount;
                } // Update currentCount with the received data.total
            },
            error: function(data) {
                // Handle error
            }
        });

        function playNotificationSound() {
            let audio = document.getElementById('notification-sound');
            audio.play();

            // Reset the playback after a short delay
            setTimeout(function() {
                audio.pause();
                audio.currentTime = 0;
            }, 3000);
        }


    }
</script> --}}
