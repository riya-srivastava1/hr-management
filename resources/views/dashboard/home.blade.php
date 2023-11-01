@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item">Home</li>
        </ol>
        @if (Auth::user()->role == '1')
            <h4 class=" page-header"> Attendance</h4>
            <!-- BEGIN row -->
            <div class="row">

                <!-- BEGIN col-3 -->
                <div class="col-xl-3 col-md-2">
                    <div class="widget widget-stats bg-teal-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3> Mark Attendance </h3>
                            <p style="display: inline;">{{ $employees }} <span style="display: inline; font-size: small;"> (total employee)</span></p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('attendence') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- END col-3 -->
                <!-- BEGIN col-3 -->
                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-orange-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3> Today's Present </h3>
                            <p>{{ $present }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('present') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- END col-3 -->


                <!-- BEGIN col-3 -->
                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-red-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3> Today's Absent</h3>
                            <p>{{ $leaves }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('leaves') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- END col-3 -->


            </div>
            <!-- END row -->
            <h4 class=" page-header">Request Section</h4>
            <!-- BEGIN row -->
            <div class="row">
                <div class="col-xl-3 col-md-2">
                    <div class="widget widget-stats bg-red-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3> Leave Approval </h3>
                            <p>{{ $leaveReq }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('leave.index') }}">View Detail <i
                                    class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-2">
                    <div class="widget widget-stats bg-orange-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3> Attendance Request</h3>
                            <p>{{ $markAttendance }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('mark.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-2">
                    <div class="widget widget-stats bg-blue-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3> Reimbursement </h3>
                            <p>{{ $reimbursment }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('reimbursement.index') }}">View Detail <i
                                    class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class=" page-header">Today's Interviews</h3>
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-3 -->
                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-red-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3> Today's Interview </h3>
                            <p>{{ $todaysinter }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('todaysInterview') }}">View Detail<i
                                    class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- END col-3 -->

            </div>
            <!-- END row -->
            <!-- END breadcrumb -->
            <h3 class=" page-header">Upcoming Interviews</h3>
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-3 -->
                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-orange-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3>Screening </h3>
                            <p>{{ $ApperCandid }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('viewdetail') }}">View Detail <i
                                    class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- END col-3 -->
                <!-- BEGIN col-3 -->
                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-teal-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3>Phase 2</h3>
                            <p>{{ $phase2 }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('templist') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- END col-3 -->
                <!-- BEGIN col-3 -->
                <div class="col-xl-3 col-md-6">
                    <div class="widget widget-stats bg-gray-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></i></div>
                        <div class="stats-info">
                            <h3>Phase 3 </h3>
                            <p>{{ $phase3 }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('phase3') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- END col-3 -->
            @elseif (Auth::user()->role == '0')
                <h3 class=" page-header">Team Leader</h3>

                <div class="col-xl-3 col-md-2">
                    <div class="widget widget-stats bg-red-900">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h3> Present Employe's </h3>
                            <p>{{ $teamLead }}</p>
                        </div>
                        <div class="stats-link">
                            <a href="{{ route('teamLead') }}">View Detail <i
                                    class="fa fa-arrow-alt-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <h3 class=" page-header">Request Section</h3>
                <!-- BEGIN row -->
                <div class="row">
                    <div class="col-xl-3 col-md-2">
                        <div class="widget widget-stats bg-red-900">
                            <div class="stats-icon"><i class="fa fa-users"></i></div>
                            <div class="stats-info">
                                <h3> Leave Approval </h3>
                                <p>{{ $leaveReq }}</p>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('leave.index') }}">View Detail <i
                                        class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-2">
                        <div class="widget widget-stats bg-orange-900">
                            <div class="stats-icon"><i class="fa fa-users"></i></div>
                            <div class="stats-info">
                                <h3>  Attendance </h3>
                                <p>{{ $markAttendance }}</p>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('mark.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-2">
                        <div class="widget widget-stats bg-blue-900">
                            <div class="stats-icon"><i class="fa fa-users"></i></div>
                            <div class="stats-info">
                                <h3> Reimbursement </h3>
                                <p>{{ $reimbursment }}</p>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('reimbursement.index') }}">View Detail <i
                                        class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h3 class=" page-header">Attendance</h3>
                <!-- BEGIN row -->
                <div class="row">

                    <!-- BEGIN col-3 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-orange-900">
                            <div class="stats-icon"><i class="fa fa-users"></i></div>
                            <div class="stats-info">
                                <h3> Attendance </h3>
                                <p>{{ $empAttendance }}</p>
                            </div>
                            <div class="stats-link">
                                <a href="{{ route('employee.attendance') }}">View Detail <i
                                        class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endIf
    </div>
    <!-- END row -->
    </div>
    <!-- END #content -->
@endsection
