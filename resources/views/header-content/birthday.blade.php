   {{-- Birthday --}}
   <div class="navbar-item dropdown birthday">
       <a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon">
           <i class="fa fa-gift"></i>
           @if ($employees->count() > 0)
               <span class="badge">{{ $employees->count() }}</span>
           @endif
       </a>

       <div class="dropdown-menu media-list dropdown-menu-end">
           <div class="dropdown-header">Birthday's ({{ $employees->count() }})</div>
           @if ($employees->count() > 0)
               @foreach ($employees as $employee)
                   <a href="javascript:;" class="dropdown-item media">
                       <div class="media-left">
                           <img src="{{ asset('assets/img/person-dummy-e1553259379744.jpg') }}" class="media-object"
                               alt="" />
                       </div>
                       <div class="media-body">
                        <h6 class="media-heading">{{ $employee->employee_name }}</h6>
                        @php
                            $dob = date('d-m', strtotime($employee['date_of_birth']));
                            $currentDate = now()->format('d-m');
                            $dobDate = \Carbon\Carbon::parse($dob . '-' . now()->year);
                            $currentDateObj = \Carbon\Carbon::parse($currentDate . '-' . now()->year);
                            $difference = $currentDateObj->diffInDays($dobDate);
                        @endphp

                        @if ($dobDate->isSameDay($currentDateObj))
                            <p>Today</p>
                        @elseif ($dobDate->isSameDay($currentDateObj->subDay()))
                            <p>Yesterday</p>
                        @else
                            <p>{{ $difference }} days left</p>
                        @endif
                    </div>

                   </a>
               @endforeach
           @else
               <img src="{{ asset('assets/img/no_data_found.png') }}" alt="">
           @endif
       </div>
   </div>
   {{-- !Birthday --}}
