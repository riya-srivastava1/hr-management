@extends('layouts.main')
@section('content')
    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Leave Approval</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h5 class="page-header">Leave Approval</h5>

        <!-- BEGIN panel -->
        <div class="panel panel-inverse">
            <!-- BEGIN panel-heading -->

            <div class="panel-heading">
                <h4 class="panel-title">Leave Approval</h4>


            </div>
            <!-- END panel-heading -->
            <!-- BEGIN panel-body -->
            <div class="panel-body">
                <form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <table id="data-table-default" class="table table-hover align-middle">
                        <thead>
                            @php

                            @endphp
                            <tr>
                                <th class="text-nowrap">Employee Name</th>
                                <th class="text-nowrap">Leave Type</th>
                                <th class="text-nowrap">leave Duration</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody id="emp_list" class="position-relative">
                            <tr class="odd gradeX">
                                @foreach ($leaveApprovals as $leaveApproval)
                            <tr>
                                <td>{{ $leaveApproval['requested_by'] }}</td>
                                <td>{{ $leaveApproval['leave_type'] }}</td>
                                <td>{{ $leaveApproval['start_date'] }} To {{ $leaveApproval['end_date'] }}</td>
                                <td>
                                    @if ($leaveApproval->status == 'Pending')
                                        <a class="btn m-1 btn-sm btn-primary w-130px"
                                            href="{{ route('leave-requests.approve', $leaveApproval->id) }}">Approve</a>

                                        <a class="btn m-1 btn-sm btn-danger w-130px"
                                            href="{{ route('leave-requests.reject', $leaveApproval->id) }}">Reject</a>
                                    @endif
                                    @if ($leaveApproval->status == 'approved')
                                        <span style="color: Green;"><b>Approved</b></span>
                                    @endif
                                    @if ($leaveApproval->status == 'rejected')
                                        <span style="color: red;"><b>Rejected</b></span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </form>
            </div>
            {{-- @forelse ($phase3s as $phase3)
            @empty
                <!-- Display vector image here -->
                <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="500"
                    width="900">
            @endforelse --}}
            <!-- END panel-body -->
        </div>
        <!-- END panel -->
    </div>
    <!-- END #content -->

    </div>
    <!-- END #app -->
@endsection
