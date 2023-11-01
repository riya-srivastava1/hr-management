@extends('layouts.main')

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <div class="col-xl-14">
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
                            <table id="data-table-default" class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Employee Name</th>
                                        <th class="text-nowrap">Request for Date</th>
                                        <th class="text-nowrap">Reason</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="emp_list" class="position-relative">
                                    @foreach ($markApprovals as $markApproval)
                                        <tr>
                                            <td>{{ $markApproval['requested_by'] }}</td>
                                            <td>{{ $markApproval['date'] }}</td>
                                            <td>{{ $markApproval['reason'] }}</td>
                                            <td>
                                                @if ($markApproval->status == 'Pending')
                                                    <a class="btn btn-primary "
                                                        href="{{ route('mark-requests.approve', $markApproval->id) }}">Approve</a>

                                                    <a class="btn btn-danger"
                                                        href="{{ route('mark-requests.reject', $markApproval->id) }}">Reject</a>
                                                @endif
                                                @if ($markApproval->status == 'approved')
                                                    <span style="color: Green;"><b>Approved</b></span>
                                                @endif
                                                @if ($markApproval->status == 'rejected')
                                                    <span style="color: red;"><b>Rejected</b></span>
                                                @endif

                                            </td>
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
