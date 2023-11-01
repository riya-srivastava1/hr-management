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
                        <form action="{{ route('mark.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="date"> Date : <font color="red">*<br></font></label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="date" id="" name="date" value="{{ old('date') }}" placeholder="Enter Candidate's Contact date">
                                    <span style="color: red">
                                        @error('date')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="reason">Reason
                                    :</label>
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
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END panel-body -->
                </div>
                <!-- END panel -->
            </div>
            <div class="col-xl-6">
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
                        <form action="#" method="POST" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <table id="data-table-default" class="table  align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Date</th>
                                        <th class="text-nowrap">Reason</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Approved/Rejected By</th>
                                    </tr>
                                </thead>
                                <tbody id="emp_list" class="position-relative">
                                    @foreach ($markAttendances as $markAttendance)
                                    <tr>
                                        <td>{{ $markAttendance['date'] }}</td>
                                        <td>{{ $markAttendance['reason'] }}</td>
                                        <td>
                                            @if ($markAttendance->status == 'Pending')
                                            <span style="color: rgb(43, 41, 41)"><b>Pending</b></span>
                                            @endif
                                            @if ($markAttendance->status == 'approved')
                                            <span style="color: Green; "><b>Approved</b></span>
                                            @endif
                                            @if ($markAttendance->status == 'rejected')
                                            <span style="color: red; "><b>Rejected</b></span>
                                            @endif
                                        </td>
                                        <td>{{ $markAttendance['approved_by'] }}</td>
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
