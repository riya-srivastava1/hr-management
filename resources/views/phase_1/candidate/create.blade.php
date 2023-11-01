@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('viewdetail') }}">Candidate's Details</a></li>
            <li class="breadcrumb-item active">Interview Phase 1</li>
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
                        <h4 class="panel-title"><b>Candidate's Details Management</b></h4>
                        <td><a href={{ route('viewdetail') }} class="btn btn-primary">List</a></td>
                    </div>
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="member" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <!-- First Part: Personal Information -->
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label class="form-label" for="fullname">Full Name : <font color="red">*</font></label>
                                    <input class="form-control" maxlength="30" type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" placeholder="Enter Candidate's Name" required />
                                    <span style="color: red">
                                        @error('fullname')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="number">Contact number : <font color="red">*</font></label>
                                    <input class="form-control" maxlength="10" type="text" id="number" name="number" value="{{ old('number') }}" placeholder="Enter Candidate's Contact number" required>
                                    <span style="color: red">
                                        @error('number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="email">Email : <font color="red">*</font></label>
                                    <input class="form-control" maxlength="35" type="email" id="email" name="email" value="{{ old('email') }}" data-parsley-type="email" placeholder="Enter Candidate's Email" required/>
                                    <span style="color: red">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <!-- Second Part: Work Experience Information -->
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label class="form-label" for="corg">Current Organization :</label>
                                    <input class="form-control" maxlength="70" type="text" id="fullname" name="corg" value="{{ old('corg') }}" placeholder="Enter Candidate's Current Organization" />
                                    <span style="color: red">
                                        @error('corg')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="dob">Date of Birth :</label>
                                    <input class="form-control" type="date"  name="dob" value="{{ old('dob') }}" placeholder="Enter Candidate's Date of Birth" />
                                    <span style="color: red">
                                        @error('dob')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="ectc">Expected CTC :</label>
                                    <input class="form-control" type="text" id="ectc" name="ectc" value="{{ old('ectc') }}" placeholder="Enter Candidate's Expected CTC" />
                                </div>
                            </div>

                            <!-- Third Part: Additional Information -->
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label class="form-label" for="ctc">Current CTC :</label>
                                    <input class="form-control" type="text" id="ctc" name="ctc" value="{{ old('ctc') }}" placeholder="Enter Candidate's Current CTC" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="doc">Resume :</label>
                                    <input class="form-control" type="file" id="doc" name="doc" value="{{ old('doc') }}" placeholder="Resume">
                                    <span style="color: red">
                                        @error('doc')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <label><b>Note: </b> <span style="color: red">Only PDF is allowed</span></label>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="address">Address :</label>
                                    <textarea class="form-control" maxlength="100" id="message" name="address" rows="4" data-parsley-maxlength="100" placeholder="Address">{{ old('address') }}</textarea>
                                    <span style="color: red">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label class="form-label" for="message">Additional Information:</label>
                                    <textarea class="form-control" maxlength="100" id="message" name="message" rows="4" data-parsley-maxlength="100" placeholder="Range from 20 - 200">{{ old('message') }}</textarea>
                                    <span style="color: red">
                                        @error('message')
                                            {{ $message }}
                                        @enderror
                                    </span>
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
            </div>
        </div>
    </div>
    <!-- END #app -->
@endsection
