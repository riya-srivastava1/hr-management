@extends('layouts.main')

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- END page-header -->
        <!-- BEGIN row -->x
        <div class="row">

            <div class="col-xl-10">
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
                                        <th class="text-nowrap">Employee Name</th>
                                        <th class="text-nowrap">Request Date</th>
                                        <th class="text-nowrap">Expense Month</th>
                                        <th class="text-nowrap">Amount</th>
                                        <th class="text-nowrap">Payment Status</th>
                                        <th class="text-nowrap">Approved/rejected by</th>
                                    </tr>
                                </thead>
                                <tbody id="emp_list" class="position-relative">
                                    <tr class="odd gradeX">
                                        @foreach ($reimbursments as $reimbursment)
                                    <tr>
                                        <td>{{ $reimbursment['requested_by'] }}</td>
                                        <td>{{ $reimbursment['request_date'] }}</td>
                                        <td>{{ $reimbursment['expense_month'] }}</td>
                                        <td>{{ $reimbursment['amount'] }}</td>
                                        <td>{{ $reimbursment['payment_status'] }}</td>

                                        <td>
                                            @if ($reimbursment->status == 'Pending')
                                                    <a class="btn btn-primary "
                                                        href="{{ route('reimbursement-requests.approve', $reimbursment->id) }}">Approve</a>

                                                    <a class="btn btn-danger"
                                                        href="{{ route('reimbursement-requests.reject', $reimbursment->id) }}">Reject</a>
                                                @endif
                                                @if ($reimbursment->status == 'approved')
                                                <span style="color: Green;"><b>Approved</b></span>
                                                @endif
                                                @if ($reimbursment->status == 'rejected')
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
