@extends('layouts.main')

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <div class="col-xl-4">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Leave Request</h4>
                    </div>
                    <!-- END panel-heading -->
                    <br>
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Leave Type<font color="red">*<br>
                                    </font> </label>
                                <div class="col-lg-8">

                                    <select name="leave_type" value="{{ old('leave_type') }}" class="form-select">
                                        <option value="">Select</option>
                                        <option value="Absent" {{ old('leave_type') == 'Absent' ? 'selected' : '' }}>
                                            Absent
                                        </option>
                                        <option value="Sick-Leave"
                                            {{ old('leave_type') == 'Sick-Leave' ? 'selected' : '' }}>Sick-Leave
                                        </option>
                                        <option value="Paid-Leave"
                                            {{ old('leave_type') == 'Paid-Leave' ? 'selected' : '' }}>
                                            Paid-Leave</option>
                                        <option value="Paid-Leave" {{ old('leave_type') == 'Half day' ? 'selected' : '' }}>
                                            Half day</option>
                                    </select>
                                    <span style="color:red">
                                        @error('leave_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="start_date">Start Date <font
                                        color="red">*<br></font> </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="date" id="start_date" name="start_date"
                                        value="{{ old('start_date') }}" placeholder="Enter Cand_date's Name" />
                                    <span style="color: red">
                                        @error('start_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="end_date">End Date<font
                                        color="red">*<br></font> </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="date" id="" name="end_date"
                                        value="{{ old('end_date') }}" placeholder="Enter Candidate's Contact end_date">
                                    <span style="color: red">
                                        @error('end_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="reason">Reason
                                    : <font color="red">*<br></font></label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" id="reason" name="reason" rows="4" data-parsley-maxlength="100"
                                        value="{{ old('reason') }}" placeholder="Range from 20 - 200"></textarea>
                                    <span style="color: red">
                                        @error('reason')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                                <div class="col-lg-8">
                                    {{-- <audio src="{{ asset('assets/mp3/Notification_sound.mp3') }}" id="audio" controls style="display:none;"></audio> --}}
                                    <button type="submit" onclick="playAudio()" class="btn btn-primary"> Submit </button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END panel-body -->
                </div>
                <!-- END panel -->
            </div>
            <div class="col-xl-8">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-2">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Request Log</h4>
                    </div>
                    <!-- END panel-heading -->
                    <br>
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <table id="data-table-default" class="table  align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Leave Type</th>
                                        <th class="text-nowrap">Leave Status</th>
                                        <th class="text-nowrap">leave Duration</th>
                                        <th class="text-nowrap">Approved/Rejected By</th>
                                    </tr>
                                </thead>
                                <tbody id="emp_list" class="position-relative">
                                    <tr class="odd gradeX">
                                        @foreach ($leaveRequests as $leaveRequest)
                                    <tr>
                                        <td>{{ $leaveRequest['leave_type'] }}</td>

                                        <td>
                                            @if ($leaveRequest->status == 'Pending')
                                                <span style="color: rgb(43, 41, 41)"><b>Pending</b></span>
                                            @endif
                                            @if ($leaveRequest->status == 'approved')
                                                <span style="color: Green; "><b>Approved</b></span>
                                            @endif
                                            @if ($leaveRequest->status == 'rejected')
                                                <span style="color: red; "><b>Rejected</b></span>
                                            @endif
                                        </td>
                                        <td>{{ $leaveRequest['start_date'] }} To {{ $leaveRequest['end_date'] }}</td>
                                        <td>{{ $leaveRequest['approved_by'] }}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <!-- END panel-body -->
                </div>
                <!-- END panel -->
            </div>
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->
@endsection

{{--
<script>
    function playAudio(){
        document.getElementById("audio").play();
    }
</script> --}}
