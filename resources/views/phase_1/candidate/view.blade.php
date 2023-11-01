@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active">Interview 1 view</li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class="page-header"><b>Interview Phase 1</b><small></small></h1>
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title"><b>Candidate's Details</b></h4>
                        <td><a href={{ route('viewdetail') }} class="btn btn-primary">List</a></td>
                    </div>
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('member') }}" method="POST" class="form-horizontal"
                            data-parsley-validate="true">
                            @csrf

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="fullname">Full Name : </label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="fullname">{{ $data->fullname ?? '' }}</label>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="number">Contact Number : </label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="number">{{ $data->number ?? '' }}</label>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="email">Email : </label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="email">{{ $data->email ?? '' }}</label>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="dob">Date of birth : </label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="dob">{{ date('d-m-Y', strtotime($data->dob)) ?? '' }}</label>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="corg">Current Organization :
                                </label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="corg">{{ $data->corg ?? '' }}</label>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="ectc">Expected CTC : </label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="ectc">{{ $data->ectc ?? '' }}</label>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="ctc">Current CTC :</label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="ctc">{{ $data->ctc ?? '' }}</label>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="address">Address :</label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="address">{{ $data->address ?? '' }}</label>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message">Additional Information
                                    :</label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="message">{{ $data->message ?? '' }}</label>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="doc">Resume :</label>
                                <div class="col-lg-8">
                                    {{-- <label class="col-lg-4 col-form-label form-label" target="_blank"
                                        for="doc">{{ $data->doc ?? '' }}</label> --}}
                                    <a href="{{ asset('doc') . '/' }}{{ $data->doc }}" target="_blank">
                                        {{ $data->doc ?? '' }}
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
