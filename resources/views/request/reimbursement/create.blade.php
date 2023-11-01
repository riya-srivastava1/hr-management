@extends('layouts.main')

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <div class="col-xl-5">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Reimbursement Detail Management</h4>
                    </div>
                    <!-- END panel-heading -->
                    <br>

                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('reimbursement.store') }}" method="POST" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf


                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="date"> Request Date : <font
                                        color="red">*<br></font></label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="date" id="" name="request_date"
                                        value="{{ old('request_date') }}" placeholder="">
                                    <span style="color: red">
                                        @error('request_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="reason">Expense Month : <font
                                        color="red">*<br></font></label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="month" id="expense_month" name="expense_month"
                                        value="{{ old('expense_month') }}" data-parsley-type="expense_month"
                                        placeholder="Enter Candidate's expense_month" />
                                    <span style="color: red">
                                        @error('expense_month')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="reason">Expense Category : <font
                                        color="red">*<br></font></label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="expense_category" name="expense_category"
                                        value="{{ old('expense_category') }}" data-parsley-type="expense_category"
                                        placeholder="Enter Candidate's expense_category" />
                                    <span style="color: red">
                                        @error('expense_category')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="expense_description">Description
                                    :</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" id="expense_description" name="expense_description" rows="4"
                                        data-parsley-maxlength="100" value="{{ old('expense_description') }}" placeholder="Range from 20 - 200"></textarea>
                                    <span style="color: red">
                                        @error('reason')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>



                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="reason">Amount : <font
                                        color="red">*<br></font></label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="amount" name="amount"
                                        value="{{ old('amount') }}" data-parsley-type="amount"
                                        placeholder="Enter Candidate's amount" />
                                    <span style="color: red">
                                        @error('amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="reason">Supported Documents :
                                </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="support_documents"
                                        name="support_documents" value="{{ old('support_documents') }}"
                                        data-parsley-type="support_documents"
                                        placeholder="Enter Candidate's support_documents" />

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
            <div class="col-xl-7">
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
                                        <th class="text-nowrap">Request Date</th>
                                        <th class="text-nowrap">Expense Month</th>
                                        <th class="text-nowrap">Amount</th>
                                        <th class="text-nowrap">Request Status</th>
                                        <th class="text-nowrap">Approved/rejected by</th>
                                    </tr>
                                </thead>
                                <tbody id="emp_list" class="position-relative">
                                    <tr class="odd gradeX">
                                        @foreach ($reimbursments as $reimbursment)
                                    <tr>
                                        <td>{{ $reimbursment['request_date'] }}</td>
                                        <td>{{ $reimbursment['expense_month'] }}</td>
                                        <td>{{ $reimbursment['amount'] }}</td>
                                        <td>
                                            @if ($reimbursment->status == 'Pending')
                                                <span style="color: rgb(43, 41, 41)"><b>Pending</b></span>
                                            @endif
                                            @if ($reimbursment->status == 'approved')
                                                <span style="color: Green; "><b>Approved</b></span>
                                            @endif
                                            @if ($reimbursment->status == 'rejected')
                                                <span style="color: red; "><b>Rejected</b></span>
                                            @endif
                                        </td>
                                        <td>{{ $reimbursment['approved_by'] }}</td>

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
