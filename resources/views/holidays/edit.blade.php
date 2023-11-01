@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN Bread-crum -->

        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active">Edit Holiday</li>
        </ol>
        <!-- End Bread-crum -->
        <!-- BEGIN page-header -->
        <h1 class="page-header"><b>Edit Holiday</b><small></small></h1>
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
                    </div>
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('holiday.update', $holidays->id) }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="id" value="{{ $holidays['id'] }}">
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Holiday Date : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="date" name="holiday_date"
                                        value="{{ $holidays['holiday_date'] }}" />
                                    <span style="color: red">
                                        @error('holiday_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="holiday_name">Holiday Name : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="holiday_name"
                                        value="{{ $holidays['holiday_name'] }}" />
                                    <span style="color: red">
                                        @error('holiday_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                                <div class="col-lg-8">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END #app -->
@endsection
