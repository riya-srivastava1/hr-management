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
            <!-- BEGIN breadcrumb -->
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('phase3') }}">Interview Phase 3</a></li>
                <li class="breadcrumb-item active"> View Phase 3 detail</li>
            </ol>
            <!-- END breadcrumb -->
            <!-- BEGIN page-header -->
            <h1 class=page-header>Interview View Phase 3 detail</h1>
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
                            <td><a href={{ route('phase3') }} class="btn btn-primary">List</a></td>

                        </div>
                        <!-- END panel-heading -->

                        <!-- BEGIN panel-body -->
                        <div class="panel-body">
                            <form action="{{ route('view', $data['id']) }}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="fullname">Candidate Name :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="fullname">{{ $data->getPhase3->fullname ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="hrround">HR Round : </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="hrround">{{ $data->hrround }}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="bgv">Background Verification
                                        : </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="bgv">{{ $data->bgv }}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="offerletter">Offer Letter :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="offerletter">{{ $data->offerletter }}</label>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="ctc">CTC : </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="ctc">{{ $data->ctc }}</label>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="jdate">Date of Joining :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="jdate">{{ $data->jdate }}</label>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="repomanager">Report Manager
                                        :</label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="repomanager">{{ $data->repomanager }}</label>
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

    <!-- BEGIN scroll-top-btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i
            class="fa fa-angle-up"></i></a>
    <!-- END scroll-top-btn -->
    </div>
    <!-- END #app -->
@endsection
