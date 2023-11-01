@extends('layouts.main')
@section('content')
    <!-- ================== BEGIN core-js ================== -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- ================== END core-js ================== -->


    <!-- ================== BEGIN page-js ================== -->
    <script src="{{ asset('assets/plugins/nvd3/build/nv.d3.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/dashboard-v2.js') }}"></script>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END row -->

    </div>
    <!-- END #content -->

    <link rel="stylesheet" href="{{ asset('css/yearly-attendance.css') }}">

    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN row -->
        <div class="row">


        </div>
        <!-- END row -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-8 -->
            <div class="col-xl-8">
                <div class="widget-chart with-sidebar inverse-mode">

                    <div class="widget-chart-sidebar bg">
                        <div class="chart-number">
                            <span style="color: rgb(82, 74, 74);"> <b>Leave Chart</b></span>
                        </div>
                        <div class="flex-grow-1 d-flex align-items-center">
                            <div id="visitors-donut-chart" class="dark-mode" style="height: 180px"></div>
                        </div>
                        <ul class="chart-legend fs-11px">
                            <li><i class="fa fa-circle fa-fw text-blue fs-9px me-5px t-minus-1"></i><span
                                    style="color: black;"> {{ $usedleaves }}</span> <span
                                    style="color: rgb(82, 74, 74);">Used Leaves</span></li>
                            <li><i class="fa fa-circle fa-fw text-teal fs-9px me-5px t-minus-1"></i> <span
                                    style="color: black;">{{ $totalleaves }}</span><span
                                    style="color: rgb(82, 74, 74);">Total Leave</span></li>
                        </ul>
                    </div>
                    <div class="">
                        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
                        <style>
                            #donut-example {
                                width: 200px;
                                /* Adjust the width as needed */
                                height: 180px;
                                /* Adjust the height as needed */
                                margin-top: 40px;
                            }
                        </style>
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
                        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
                        <meta charset="utf-8" />
                        <title>Morris.js Donut Chart Example</title>

                        <body>
                            <div id="donut-example"></div>
                        </body>

                        <script>
                            Morris.Donut({
                                element: 'donut-example',
                                data: [{
                                    label: "Present",
                                    value: {{ $present }}
                                }, {
                                    label: "Absent",
                                    value: {{ $leave }}
                                }, {
                                    label: "Paid/sick Leave",
                                    value: {{ $sickpaid }}
                                }]
                            });
                        </script>
                    </div>
                    <div class="col-xl-5">
                        <!-- BEGIN panel -->

                        <div class="panel panel-inverse" data-sortable-id="table-basic-7">

                            <!-- BEGIN panel-heading -->

                            <div class="panel-heading">
                                <h4 class="panel-title">Clock Timesheet</h4>

                            </div>
                            <!-- END panel-heading -->
                            <!-- BEGIN panel-body -->
                            <div class="panel-body">
                                <!-- BEGIN table-responsive -->
                                <div class="pb-3">
                                    <table class="table table-striped mb-0 align-middle ">
                                        <thead>
                                            <tr>
                                                <th>User Name</th>
                                                <th>Clock-In Time</th>
                                                <th>Clock-Out Time</th>
                                                <th>Total Hours</th>
                                                <th width="1%"></th>
                                            </tr>
                                        </thead>
                                        <tbody id='emp-list'>
                                            {{-- {{ dd($employes) }} --}}
                                            @foreach ($clockRecords as $clockRecord)
                                                @php
                                                    $startTime = $clockRecord->clock_in;
                                                    $endTime = $clockRecord->clock_out;

                                                    $startDateTime = \Carbon\Carbon::parse($startTime);
                                                    $endDateTime = \Carbon\Carbon::parse($endTime);

                                                    $interval = $startDateTime->diff($endDateTime);

                                                    $hours = $interval->h;
                                                    $minutes = $interval->i;
                                                    $seconds = $interval->s;

                                                    $formattedTime = str_pad(strval($hours), 2, '0', STR_PAD_LEFT) . ':' . str_pad(strval($minutes), 2, '0', STR_PAD_LEFT) . ':' . str_pad(strval($seconds), 2, '0', STR_PAD_LEFT);
                                                @endphp

                                                <tr>
                                                    <td>{{ $clockRecord->created_by ?? '' }}</td>
                                                    <td>{{ $clockRecord->clock_in ?? '' }}</td>
                                                    <td>{{ $clockRecord->clock_out ?? '' }}</td>
                                                    <td>{{ $formattedTime ??'00:00:00'}} hrs</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END table-responsive -->
                            </div>
                            <!-- END panel-body -->
                        </div>
                        <!-- END panel -->
                    </div>
                </div>
            </div>
            <!-- END col-8 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->
@endsection
