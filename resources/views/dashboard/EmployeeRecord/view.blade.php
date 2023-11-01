@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employee.index') }}">Employee Record</a></li>
            <li class="breadcrumb-item">View Employee Record</li>
        </ol>
        <!-- END breadcrumb -->
        <h3 class=" page-header">View Employee Record</h3>
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Employee Record</h4>
                    </div>

                    <!-- END panel-heading -->
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 ">Emplyee Name</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->employee_name ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 ">Highest Qualification</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->qualification ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message"> Official Email Id :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->email ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message"> Total Leaves :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->total_leaves ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message">Taken Leaves :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->taken_leaves }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 ">Available Leaves</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->avilable_leaves}}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 ">Employment Type</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->employment_type ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 ">Ctc</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->ctc ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 ">Employee Status :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold"> {{ $employe->status ?? '' }} </h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="date">Date Of Birth</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->date_of_birth ?? '' }}</h6>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message">Address :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->address ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message">Aadhar Number :</h5>
                            <div class="col-lg-8">
                                <a href="{{ asset('Aadhar_no') . '/' }}{{ $employe->aadhar_no ?? '' }}" target="_blank">
                                    {{ $employe->aadhar_no ?? '' }}
                                </a>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message"> Pan Number :</h5>
                            <div class="col-lg-8">
                                <a href="{{ asset('pan_no') . '/' }}{{ $employe->pan_no ?? '' }}" target="_blank">
                                    {{ $employe->pan_no ?? '' }}
                                </a>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message"> Photo :</h5>
                            <div class="col-lg-8">

                                <a href="{{ asset('photo') . '/' }}{{ $employe->photo ?? '' }}" target="_blank">
                                    {{ $employe->pan_no ?? '' }}
                                </a>

                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message"> Employee Code :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->employment_code ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message"> Contact Number :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->contact_no ?? '' }}</h6>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 " for="message"> Department Name :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->departname ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4"> Designation :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->designation ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 ">Date Of Joining :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->date_of_joining ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 "> Work Location :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->location ?? '' }}</h6>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 "> Reporting Manager :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->reporting_manager ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 ">Shift :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->shift ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 ">Blood Group :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold"> {{ $employe->blood_groupo ?? '' }} </h6>
                            </div>
                        </div>

                        <h3 class="panel-title">Bank Details</h3>



                        <div class="form-group row mb-3 mt-4">
                            <h5 class="col-lg-4 "> Account Number :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->account_no ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 "> Bank Name :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->bank_name ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 "> IFSC Code :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->ifsc ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <h5 class="col-lg-4 "> UAN Number (if Exixts) :</h5>
                            <div class="col-lg-8">
                                <h6 class="fw-bold">{{ $employe->uan ?? '' }}</h6>
                            </div>
                        </div>
                        <center>
                            <a class="btn btn-primary" href="{{ route('employee.edit', $employe->id ?? '') }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('dashboard') }}">Cancel</a>
                        </center>
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
@endsection
