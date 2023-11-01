@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content mt-5">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Today's Interview Record</li>
        </ol>
        <!-- END breadcrumb -->
        <h3 class=" page-header">Today's Interview Record</h3>
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->

                <div class="panel panel-inverse" data-sortable-id="table-basic-7">

                    <!-- BEGIN panel-heading -->

                    <div class="panel-heading">
                        <h4 class="panel-title">Today's Interview Record</h4>
                    </div>

                    <!-- END panel-heading -->

                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <!-- BEGIN table-responsive -->
                        <div class="pb-3">
                            <table class="table table-striped mb-0 align-middle ">
                                <thead>
                                    <tr>
                                        <th>Candidate Name</th>
                                        <th>Interview Mode</th>
                                        <th>Interview Date</th>
                                        <th>Interviewer's Name</th>
                                        <th>Interview Status</th>
                                        <th>Reschedule</th>
                                        <th width="1%"></th>
                                    </tr>
                                </thead>
                                <tbody id='emp-list'>
                                    @foreach ($AllEmps as $data)
                                        <tr>
                                            <td>{{ $data->showI->fullname ?? '' }}</td>
                                            <td>{{ $data->intmode }}</td>
                                            <td>{{  date('d-m-Y', strtotime($data->date))  }}</td>
                                            <td>{{ $data->intname }}</td>
                                            <td>{{ $data->intstatus }}</td>
                                            <td>{{ $data->reschedule }}</td>
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
