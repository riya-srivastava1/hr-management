@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/yearly-attendance.css') }}">
    <script src="{{ asset('js/report-date-range.js') }}"></script>

    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-12 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title"><b>Candidate's Details Management</b></h4>
                    </div>
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('date.range') }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-3">
                                <div class="col-lg-4">
                                    <label class="col-form-label form-label">Report <span class="text-red">*</span></label>
                                    <select class="form-select " name="qualification" id="qual"
                                        onchange="showDrop(this);">
                                        <option value="">Select</option>
                                        <option value="Screening Candidate"
                                            {{ old('qualification') == 'Screening Candidate' ? 'selected' : '' }}>Screening
                                            Candidate</option>
                                        <option value="employee-attendance"
                                            {{ old('qualification') == 'employee-attendance' ? 'selected' : '' }}>Employee
                                            Attendance</option>
                                        <option value="birthday" {{ old('qualification') == 'birthday' ? 'selected' : '' }}>
                                            Birthday List</option>
                                    </select>
                                    <span style="color:red">
                                        @error('qualification')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="col-form-label form-label" for="from_date">From Date<font color="red">
                                            *<br></font></label>
                                    <input class="form-control" value="{{ old('from_date') }}" type="date"
                                        name="from_date" placeholder="Required" />
                                    <span style="color:red">
                                        @error('from_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="col-form-label form-label" for="to_date">To Date<font color="red">
                                            *<br></font></label>
                                    <input class="form-control" value="{{ old('to_date') }}" type="date" name="to_date"
                                        placeholder="Required" />
                                    <span style="color:red">
                                        @error('to_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <!-- Employee dropdown -->
                            <div class="form-group row mb-3" id="employeeDropdown" style="display: none;">
                                <div class="col-lg-4">
                                    <label class="col-form-label form-label">Employee Name <span
                                            class="text-red">*</span></label>
                                    <select class="form-control" name="emp_id">
                                        <option value="">Select</option>


                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->employee_name }}
                                            </option>
                                        @endforeach


                                    </select>
                                    <span style="color:red">
                                        @error('employee_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END panel-body -->
                </div>
            </div>
            {{-- Candidate Details --}}
            @if (!empty($members))
                <div class="col-xl-12">
                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title"><b>Report of Candidate's Details</b></h4>
                        </div>
                        <!-- BEGIN panel-body -->
                        <div class="panel-body">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Candiate's Name</th>
                                        <th class="text-nowrap">Contact Number</th>
                                        <th class="text-nowrap">Email</th>
                                        <th class="text-nowrap">Expexted CTC</th>
                                        <th class="text-nowrap">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="employe_list" class="position-relative">

                                    @foreach ($members as $member)
                                        <tr>
                                            <td>{{ $member['fullname'] }}</td>
                                            <td>{{ $member['number'] }}</td>
                                            <td>{{ $member['email'] }}</td>
                                            <td>{{ $member['ectc'] }}</td>
                                            <td>{{ date('d-m-Y', strtotime($member['created_at'])) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- END panel-body -->
                    </div>
                </div>
            @endif

            {{-- Attendances --}}
            @if (!empty($attendances))

                <div class="card">
                    <div class="card-header bg-black text-white">
                        Attendence logs
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="printTable">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Employee Position</th>
                                        @php
                                            $today = today();
                                            $dates = [];

                                            // dd(today());

                                            for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                                                $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('d-m-Y');
                                            }

                                        @endphp
                                        @foreach ($dates as $key => $date)
                                            <div>
                                                <th>
                                                    {{ \Carbon\Carbon::parse($date)->format('l') }} <br>
                                                    {{ $date }}
                                                </th>
                                            </div>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$members)
                                        @foreach ($attendances as $attendance)
                                            <tr>
                                                <td>{{ $attendance->employee_name }}</td>
                                                <td>{{ $attendance->designation }}</td>

                                                @php
                                                    $presents = [];
                                                    $leaves = [];
                                                    $paidleaves = [];
                                                    $sickleaves = [];

                                                    foreach ($attendance->AllAttendace as $AllAttendace) {
                                                        $presents[] = $AllAttendace->attendance_date ?? '';
                                                    }

                                                    foreach ($attendance->AllLeave as $AllLeave) {
                                                        $leaves[] = $AllLeave->leave_date ?? '';
                                                    }
                                                    foreach ($attendance->AllPaidLeave as $AllPaidLeave) {
                                                        $paidleaves[] = $AllPaidLeave->paid_leave_date ?? '';
                                                    }
                                                    foreach ($attendance->AllSickLeave as $AllSickLeave) {
                                                        $sickleaves[] = $AllSickLeave->sick_leave_date ?? '';
                                                    }
                                                @endphp

                                                @for ($i = 1; $i <= $today->daysInMonth; $i++)
                                                    @php
                                                        $currentDate = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                                        $isPresent = in_array($currentDate, $presents ?? []);
                                                        $isLeave = in_array($currentDate, $leaves ?? []);
                                                        $isSickLeave = in_array($currentDate, $sickleaves ?? []);
                                                        $isPaidLeave = in_array($currentDate, $paidleaves ?? []);
                                                    @endphp

                                                    <td>
                                                        @if ($isPresent)
                                                            <b>
                                                                <font color="green">Present<br></font>
                                                            </b>
                                                        @elseif ($isLeave)
                                                            <b>
                                                                <font color="red">Absent<br></font>
                                                            </b>
                                                        @elseif ($isSickLeave)
                                                            <b>
                                                                <font color="black">Sick Leave<br></font>
                                                            </b>
                                                        @elseif ($isPaidLeave)
                                                            <b>
                                                                <font color="blue">Paid Leave<br></font>
                                                            </b>
                                                        @endif
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif


            {{-- Birthdays --}}
            @if (!empty($birthdays))
                <div class="col-xl-14 mt-20px">
                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse">
                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Birthday List</h4>
                        </div>
                        <!-- END panel-heading -->
                        <!-- BEGIN panel-body -->
                        <div class="panel-body">
                            <div class="form-horizontal">
                                @csrf
                                <table id="data-table-default" class="table table-bordered align-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">Name</th>
                                            <th class="text-nowrap">Date</th>

                                        </tr>
                                    </thead>
                                    <tbody id="data-table-default" class="position-relative">
                                        @if (!$members)
                                            @foreach ($birthdays as $birthday)
                                                <tr>
                                                    <td>{{ $birthday['employee_name'] }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($birthday->date_of_birth)) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                            <!-- END panel-body -->
                        </div>
                        <!-- END panel -->
                    </div>
            @endif
        </div>
    </div>
    <!-- END #app -->
@endsection
