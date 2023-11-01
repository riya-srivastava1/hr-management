@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active">All Leaves</li>
        </ol>
        <!-- End breadcrumb start-->

        <!-- BEGIN page-header -->
        <h1 class="page-header"><b>All Leaves</b><small></small></h1>
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-14">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title"><b>All Leaves</b></h4>
                    </div>
                    <!-- BEGIN panel-body -->

                    <div class="pb-6">
                        <table class="table table-striped mb-0 align-middle ">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email </th>
                                    <th>Contact Number</th>
                                    <th>Designation</th>
                                    <div>
                                        <th> Attendance
                                            {{ now()->format('d-m-Y') }}
                                        </th>
                                    </div>
                                    <th width="1%"></th>
                                </tr>
                            </thead>
                            <tbody id='emp-list' class="position-relative">
                                @foreach ($employes as $employe)
                                    @if ($absent = $employe->getLeave->leave_date ?? '' || $sick_leave = $employe->getSickLeave->sick_leave_date ?? '' || $paid_leave = $employe->getPaidLeave->paid_leave_date ?? '')
                                        <tr>
                                            @php
                                                $present = $employe->getAttendace->attendance_date ?? '';
                                                $absent = $employe->getLeave->leave_date ?? '';
                                                $sick_leave = $employe->getSickLeave->sick_leave_date ?? '';
                                                $paid_leave = $employe->getPaidLeave->paid_leave_date ?? '';

                                            @endphp

                                            @if (!$present == now()->format('d-m-Y'))
                                                <td>{{ $employe->employee_name }}</td>
                                                <td>{{ $employe->email }}</td>
                                                <td>{{ $employe->contact_no }}</td>
                                                <td>{{ $employe->designation }}</td>
                                                <td>

                                                    @if ($absent)
                                                        <b>
                                                            <font color="red">Absent<br></font>
                                                        </b>
                                                    @endif

                                                    @if ($sick_leave)
                                                        <b>
                                                            <font color="red">Sick Leave<br></font>
                                                        </b>
                                                    @endif

                                                    @if ($paid_leave)
                                                        <b>
                                                            <font color="red">Paid Leave<br></font>
                                                        </b>
                                                    @endif


                                                </td>
                                            @endif
                                            {{-- @endif --}}
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                        </table>
                        {{-- @if (!$present)
                            <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found"
                                height="500" width="900">
                        @endif --}}

                    </div>
                </div>
            @endsection
