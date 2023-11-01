@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employee.index') }}">Employee Record</a></li>
            <li class="breadcrumb-item">Edit Employee Record</li>
        </ol>
        <!-- END breadcrumb -->
        <h3 class=" page-header">Edit Employee Record</h3>
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
                        <form action="{{ route('employee.update', $employee->id) }}" method="post"
                            enctype="multipart/form-data" class="form-horizontal" data-parsley-validate="true"
                            name="demo-form">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="employee_name">Employee Name <span
                                        class="text-red">*</span>:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="employee_name"
                                        name="employee_name" value="{{ $employee->employee_name }}" />
                                    <span style="color:red">
                                        @error('employee_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Highest Qualification<span
                                        class="text-red">*</span></label>
                                <div class="col-lg-8">
                                    <select class="cand_id form-select" name="qualification">
                                        <option value="{{ $employee->qualification }}">{{ $employee->qualification }}
                                        </option>
                                        <option value="Secondary">Secondary</option>
                                        <option value="Senior-Secondary">Senior Secondary</option>
                                        <option value="Graduation">Graduation</option>
                                        <option value="Post-Graduation">Post-Graduation</option>
                                        <option value="Phd">PhD</option>
                                    </select>
                                    <span style="color:red">
                                        @error('qualification')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> Official Email Id:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" maxlength="40" type="email" id="number" name="email"
                                        value="{{ $employee->email }}" />
                                    <span style="color:red">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            @if (Auth::user()->role == '1')
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="message"> Total Leaves :</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" maxlength="5" type="text" id="number"
                                            name="total_leaves" value="{{ $employee->total_leaves }}" />
                                        <span style="color:red">
                                            @error('total_leaves')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="message"> Taken Leaves :</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" maxlength="5" type="text" id="number"
                                            name="taken_leaves" value="{{ $employee->taken_leaves }}" />
                                        <span style="color:red">
                                            @error('taken_leaves')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label">Employee Status<span
                                            class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <select class="cand_id form-select" name="status">
                                            <option value="{{ $employee->status }}">{{ $employee->status }}</option>
                                            <option value="Active">Active</option>
                                            <option value="Not Active">Not Active</option>
                                        </select>
                                        <span style="color:red">
                                            @error('status')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Employment Type<span
                                        class="text-red">*</span></label>
                                <div class="col-lg-8">
                                    <select class="cand_id form-select" name="Emptype">
                                        <option value="{{ $employee->employment_type }}">{{ $employee->employment_type }}
                                        </option>
                                        <option value="INTERN">INTERN</option>
                                        <option value="Permanent">Permanent</option>
                                    </select>
                                    <span style="color:red">
                                        @error('Emptype')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="date">CTC</label>
                                <div class="col-lg-8">
                                    <input class="form-control" maxlength="8" type="text" id="website" name="ctc"
                                        value="{{ $employee->ctc }}" />

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Employee Status<span
                                        class="text-red">*</span></label>
                                <div class="col-lg-8">
                                    <select class="cand_id form-select" name="status">
                                        <option value="{{ $employee->status }}">{{ $employee->status }}</option>
                                        <option value="Active">Active</option>
                                        <option value="Not Active">Not Active</option>
                                    </select>
                                    <span style="color:red">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="date">Date Of Birth<span
                                        class="text-red">*</span></label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="date" id="website" name="dob"
                                        value="{{ $employee->date_of_birth }}" />
                                    <span style="color:red">
                                        @error('dob')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message">Address:</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" maxlength="100" id="message" name="address" rows="4">{{ $employee->address }}</textarea>
                                    <span style="color:red">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message">Aadhar Number :</label>
                                <div class="col-lg-8 position-relative">
                                    <input class="form-control" type="file" id="existing-file" name="Aadharno"
                                        value="{{ $employee->aadhar_no ?? '' }}" />
                                    <span class="existing-name">{{ $employee->aadhar_no ?? '' }}</span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> Pan Number :</label>
                                <div class="col-lg-8 position-relative">
                                    <input class="form-control" type="file" id="existing-file" name="panNo"
                                        value="{{ $employee->pan_no ?? '' }}" />
                                    <span class="existing-name">{{ $employee->pan_no ?? '' }}</span>

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> Employee Photo :</label>
                                <div class="col-lg-8 position-relative">
                                    <input class="form-control" type="file" id="existing-file" name="photo"
                                        value="{{ $employee->photo ?? '' }}" />
                                    <span class="existing-name">{{ $employee->photo ?? '' }}</span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> Employee Code :</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="number" name="empcode"
                                        value="{{ $employee->employment_code }}" />

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> Contact Number <span
                                        class="text-red">*</span> :</label>
                                <div class="col-lg-8">
                                    <input class="form-control" maxlength="10" type="text" id="number"
                                        name="contactno" value="{{ $employee->contact_no }}" />
                                    <span style="color:red">
                                        @error('contactno')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Orgnization Name<span
                                        class="text-red">*</span></label>
                                <div class="col-lg-8">
                                    <select class="cand_id form-select" name="departname">
                                        <option value="{{ $employee->departname }}">{{ $employee->departname }}
                                        </option>
                                        <option value="Hexabells">Hexabells</option>
                                        <option value="Zoylee">Zoylee</option>
                                        <option value="Sagenext">Sagenext</option>
                                    </select>
                                    <span style="color:red">
                                        @error('departname')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> Designation <span
                                        class="text-red">*</span> :</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="number" name="designation"
                                        value="{{ $employee->designation }}" />
                                    <span style="color:red">
                                        @error('designation')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="date">Date Of Joining :</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="date" id="website" name="doj"
                                        value="{{ $employee->date_of_joining }}" />
                                    <span style="color:red">
                                        @error('doj')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Work Location<span
                                        class="text-red">*</span></label>
                                <div class="col-lg-8">
                                    <select class="cand_id form-select" name="location">
                                        <option value="{{ $employee->location }}">{{ $employee->location }}</option>
                                        <option value="Noida">Noida</option>
                                        <option value="Gorakhpur">Gorakhpur</option>
                                        <option value="Work-From-Home">Work From Home</option>
                                    </select>
                                    <span style="color:red">
                                        @error('location')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Reporting Manager<font color="red">
                                        *<br>
                                    </font> </label>
                                <div class="col-lg-8">
                                    <select name="reportman" class="cand_id form-select">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">
                                        @error('reportman')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Shift<span
                                        class="text-red">*</span></label>
                                <div class="col-lg-8">
                                    <select class="cand_id form-select" name="shift">
                                        <option value="{{ $employee->shift }}">{{ $employee->shift }}</option>
                                        <option value="Day">Day</option>
                                        <option value="Night">Night</option>
                                    </select>
                                    <span style="color:red">
                                        @error('shift')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Blood Group</label>
                                <div class="col-lg-8">
                                    <select class="cand_id form-select" name="Bgroup">
                                        <option value="{{ $employee->blood_group }}">{{ $employee->blood_group }}
                                        </option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB-">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>

                                </div>
                            </div>

                            <h3 class="panel-title">Bank Details </h3>


                            <div class="form-group row mb-3 mt-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> Account Number :</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="number" name="accountno"
                                        value="{{ $employee->account_no }}" />

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message">Confirm Account Number
                                    :</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="number" name="caccountno"
                                        value="{{ $employee->account_no }}" />

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> Bank Name :</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="number" name="bank"
                                        value="{{ $employee->bank_name }}" />

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> IFSC Code:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="number" name="ifsc"
                                        value="{{ $employee->ifsc }}" oninput="this.value = this.value.toUpperCase()" />

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="message"> UAN Number (if Exixts)
                                    :</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="number" name="uan"
                                        value="{{ $employee->uan }}" />

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                                <div class="col-lg-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-danger" href="{{ route('dashboard') }}">Back</a>
                                </div>
                            </div>
                        </form>
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
