@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content mt-5">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Clock Timesheet</li>
        </ol>
        <!-- END breadcrumb -->
        <h3 class=" page-header">Clock Timesheet</h3>
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
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
                                        <th>Clock-In Date</th>
                                        <th>Clock-In Time</th>
                                        <th>Clock-Out Time</th>
                                        <th width="1%"></th>
                                    </tr>
                                </thead>
                                <tbody id='emp-list'>
                                    @foreach ($timesheets as $timesheet)
                                        <tr>
                                            <td>{{ $timesheet->created_by }}</td>
                                            <td>{{ date('d-m-Y', strtotime($timesheet->clock_in)) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($timesheet->clock_in)->format('h:i A') }}</td>
                                            @if ($timesheet->clock_out)
                                                <td>{{ date('h:i A', strtotime($timesheet->clock_out)) }}</td>
                                            @else
                                                <td></td>
                                            @endif

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
            <!-- END col-6 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->
@endsection
