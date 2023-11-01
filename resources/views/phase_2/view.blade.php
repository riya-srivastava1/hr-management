@extends('layouts.main')
@section('content')
    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->

    <!-- BEGIN #app -->
    <div id="app" class="app app-header-fixed app-sidebar-fixed">

        <!-- BEGIN #content -->
        <div id="content" class="app-content">
            <!-- Begain breadcrumb start-->
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="{{ ('dashboard') }}">Home </a></li>
                <li class="breadcrumb-item active"><a href="{{ route('templist') }}">Interview Phase 2</a></li>
                <li class="breadcrumb-item active">View Interview Detail</li>
            </ol>
            <!-- End breadcrumb start-->
            <!-- BEGIN page-header -->
            <h1 class=page-header>Interview Phase 2</h1>
            <!-- END page-header -->
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="col-xl-12">
                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Basic Form Validation</h4>
                            <td><a href={{ route('templist') }} class="btn btn-primary">List</a></td>
                        </div>
                        <!-- END panel-heading -->
                        <!-- BEGIN panel-body -->
                        <div class="panel-body">
                            <form action="{{ route('view1', $data['id']) }}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="fullname">Candidate Name :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="fullname">{{ $data->showI->fullname ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="intmode">Interview Mode :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="intmode">{{ $data->intmode }}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="inttype">Interview Type :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="inttype">{{ $data->inttype }}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="date">Date : </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="date">{{ date('d-m-Y',strtotime($data->date)) }}</label>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="intname">Interviewer's Name :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="intname">{{ $data->intname }}</label>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="intstatus">Interview Status :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="intstatus">{{ $data->intstatus }}</label>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="reschedule">Report Manager
                                        :</label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="reschedule">{{ $data->reschedule }}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="rdate">Reschedule Date
                                        :</label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="rdate">{{ $data->rdate }}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="intlink">Interview Link
                                        :</label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="intlink">{{ $data->intlink }}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="feedback">Feedback :</label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="feedback">{{ $data->feedback }}</label>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- END panel-body -->

                    </div>
                    <!-- END panel -->
                </div>
                <!-- END col-6 -->
                <!-- BEGIN col-6 -->
                <div class="col-xl-6">
                    <!-- BEGIN panel -->

                    <!-- END hljs-wrapper -->
                </div>
                <!-- END panel -->
            </div>
            <!-- END col-6 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->

    <!-- BEGIN theme-panel -->

    <!-- END theme-panel -->
    <!-- BEGIN scroll-top-btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i
            class="fa fa-angle-up"></i></a>
    <!-- END scroll-top-btn -->
    </div>
    <!-- END #app -->
@endsection
