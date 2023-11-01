@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active">Monthly Data</li>
        </ol>
        <!-- End breadcrumb start-->
        <!-- BEGIN page-header -->

        <h1 class="page-header">Monthly Data </h1>

        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Attendance Months</h4>

                    </div>
                    <!-- END panel-heading -->
                    <br>

                    <!-- BEGIN panel-body -->
                    <div class="" id="monthsContainer">
                        @foreach($months as $month)
                          <a href="{{ route('yearly.attendance', ['month' => $month, 'year' => $year]) }}" class="btn btn-primary">{{ $month }} {{ $year }}</a>
                        @endforeach
                    </div>

                    <style>
                        #monthsContainer{
                            display: flex;
                            justify-content: space-between;
                            flex-wrap: wrap;
                            max-width: 70%;
                            margin:0 auto;
                            padding:0 0 30px 0;
                        }

                        #monthsContainer a{
                            margin-top:10px;
                            margin-right:10px;
                            flex-basis: 25%;
                        }
                    </style>
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
