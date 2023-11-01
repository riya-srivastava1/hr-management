@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('viewdetail2') }}">Post and Department</a></li>
            <li class="breadcrumb-item active">Edit Department</li>
        </ol>
        <!-- End breadcrumb start-->

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
                        <h4 class="panel-title"><b>Edit Details</b></h4>
                        <td><a href={{ route('viewdetail2') }} class="btn btn-primary">List</a></td>
                    </div>
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('edit2') }}" method="POST" class="form-horizontal" data-parsley-validate="true">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="fullname">Candidate Name :
                                </label>
                                <div class="col-lg-8">
                                    <label class="col-lg-4 col-form-label form-label"
                                        for="fullname">{{ $data->getMember->fullname ?? '' }}</label>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $data['id'] }}">

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="title">Post : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" maxlength="40" type="text" name="title"
                                        value="{{ $data['title'] }}" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="department">Department : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" maxlength="40" type="text" name="department"
                                        value="{{ $data['department'] }}" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                                <div class="col-lg-8">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
