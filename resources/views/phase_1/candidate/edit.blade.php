@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN Bread-crum -->

        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item"><a href="{{ route('viewdetail') }}">Candidate's Details</a></li>
            <li class="breadcrumb-item active">Interview 1 edit</li>
        </ol>
        <!-- End Bread-crum -->
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
                        <td><a href={{ route('viewdetail') }} class="btn btn-primary">List</a></td>
                    </div>
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('edit') }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data['id'] }}">
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Full Name : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" maxlength="30" type="text" name="fullname"
                                        value="{{ $data['fullname'] }}" required/>
                                    <span style="color: red">
                                        @error('fullname')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Contact Number : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="number" name="number"
                                        value="{{ $data['number'] }}" required/>
                                    <span style="color: red">
                                        @error('number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="email">Email : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" maxlength="35" type="email" name="email"
                                        value="{{ $data['email'] }}" required/>
                                    <span style="color: red">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="dob">Date Of Birth : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="date" name="dob"
                                        value="{{ $data['dob'] }}" />
                                    <span style="color: red">
                                        @error('dob')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="corg">Current Organization :
                                </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="corg"
                                        value="{{ $data['corg'] }}" />
                                    <span style="color: red">
                                        @error('corg')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="ectc">ECTC : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="ectc"
                                        value="{{ $data['ectc'] }}" />
                                    <span style="color: red">
                                        @error('ectc')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="ctc">CTC : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="ctc"
                                        value="{{ $data['ctc'] }}" />
                                    <span style="color: red">
                                        @error('ctc')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="address">address : </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="address"
                                        value="{{ $data['address'] }}" /><span style="color: red">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="doc">Resume : </label>
                                <div class="col-lg-8 position-relative ">
                                    <input class="form-control" id='existing-file' type="file" name="doc" />
                                    <span class="existing-name">{{ $data->doc }}</span>
                                    <style>
                                        .existing-name {
                                            position: absolute;
                                            background: #fff;
                                            width: 50%;
                                            top: 38%;
                                            transform: translateY(-50%);
                                            left: 110px;
                                            height: 50%;
                                            display: block;
                                            font-weight: bold;
                                        }

                                        .hide {
                                            display: none;
                                        }
                                    </style>

                                    <script>
                                        const input = document.getElementById('existing-file');

                                        const existing_name = document.querySelector('.existing-name');

                                        input.onchange = (e) => {

                                            console.log(e.target.value);

                                            if (e.target.value) {
                                                existing_name.classList.add('hide');

                                            } else {
                                                existing_name.classList.remove('hide');
                                            }
                                        }
                                    </script>

                                    <span style="color: red">
                                        @error('doc')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message">message : </label>
                                <div class="col-lg-8">

                                        <textarea class="form-control" maxlength="100" id="message" name="message" rows="4" data-parsley-maxlength="100" placeholder="Range from 20 - 200">{{ $data['message'] }}</textarea>
                                        @error('message')
                                            {{ $message }}
                                        @enderror
                                    </span>
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
    <!-- END #app -->
@endsection
