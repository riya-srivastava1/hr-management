@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('attendence') }}">Attendence Sheet</a></li>
            <li class="breadcrumb-item active">Attendence View</li>
        </ol>
        <!-- End breadcrumb start-->
        <!-- BEGIN page-header -->

        <h1 class="page-header">Attendence View </h1>

        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="card">
            <div class="card-header bg-success text-white">
                TimeTable
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

                                    for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                                        $dates[] = \Carbon\Carbon::createFromDate($year1, $month1, $i)->format('d-m-Y');
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

                            @foreach ($employees as $employe)
                                <input type="hidden" name="emp_id" value="{{ $employe->id }}">
                                <tr>
                                    <td>{{ $employe->employee_name }}</td>
                                    <td>{{ $employe->designation }}</td>

                                    @php
                                        $presents = [];
                                        $leaves = [];
                                        $paidleaves = [];
                                        $sickleaves = [];

                                        foreach ($employe->AllAttendace as $AllAttendace) {
                                            $presents[] = $AllAttendace->attendance_date ?? '';
                                        }

                                        foreach ($employe->AllLeave as $AllLeave) {
                                            $leaves[] = $AllLeave->leave_date ?? '';
                                        }
                                        foreach ($employe->AllPaidLeave as $AllPaidLeave) {
                                            $paidleaves[] = $AllPaidLeave->paid_leave_date ?? '';
                                        }
                                        foreach ($employe->AllSickLeave as $AllSickLeave) {
                                            $sickleaves[] = $AllSickLeave->sick_leave_date ?? '';
                                        }
                                    @endphp

                                    @for ($i = 1; $i <= $today->daysInMonth; $i++)
                                        @php
                                            $currentDate = \Carbon\Carbon::createFromDate($year1, $month1, $i)->format('Y-m-d');
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->

<link rel="stylesheet" href="{{ asset('css/yearly-attendance.css') }}">
@endsection
