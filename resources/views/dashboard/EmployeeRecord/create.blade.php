@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employee.index') }}">Employee Record</a></li>
            <li class="breadcrumb-item">Add Employee Record</li>
        </ol>
        <!-- END breadcrumb -->
        <h3 class=" page-header">Add Employee Record</h3>

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
                        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="employee_name">Employee Name<span
                                                class="text-red">*</span></label>
                                        <input class="form-control" maxlength="30" type="text"
                                            value="{{ old('employee_name') }}" id="employee_name" name="employee_name"
                                            placeholder=" Enter Employee Name" required />
                                        <span style="color:red">
                                            @error('employee_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Highest Qualification<span
                                                class="text-red">*</span></label>

                                        <select class="form-select" name="qualification">
                                            <option value="">Select</option>
                                            <option value="Secondary"
                                                {{ old('qualification') == 'Secondary' ? 'selected' : '' }}>Secondary
                                            </option>
                                            <option value="Senior-Secondary"
                                                {{ old('qualification') == 'Senior-Secondary' ? 'selected' : '' }}>Senior
                                                Secondary</option>
                                            <option value="Graduation"
                                                {{ old('qualification') == 'Graduation' ? 'selected' : '' }}>Graduation
                                            </option>
                                            <option value="Post-Graduation"
                                                {{ old('qualification') == 'Post-Graduation' ? 'selected' : '' }}>Post
                                                Graduation
                                            </option>
                                            <option value="PhD" {{ old('qualification') == 'PhD' ? 'selected' : '' }}>PhD
                                            </option>
                                        </select>
                                        <span style="color:red">
                                            @error('qualification')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> Official Email Id:</label>

                                        <input class="form-control" type="email" maxlength="40"
                                            value="{{ old('email') }}" id="number" name="email"
                                            data-parsley-type="number" placeholder=" Enter Official Email Id" />
                                        <span style="color:red">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                @if (Auth::user()->role == '1')
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="col-lg-4 col-form-label form-label" for="message"> Total leaves
                                                :</label>

                                            <input class="form-control" maxlength="5" type="text"
                                                value="{{ old('total_leaves') }}" id="number" name="total_leaves"
                                                data-parsley-type="number" placeholder=" Enter Total Leaves" />
                                            <span style="color:red">
                                                @error('total_leaves')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="col-lg-4 col-form-label form-label" for="message"> Taken leaves
                                                :</label>

                                            <input class="form-control" maxlength="5" type="text"
                                                value="{{ old('taken_leaves') }}" id="number" name="taken_leaves"
                                                data-parsley-type="number" placeholder=" Enter Total Leaves" />
                                            <span style="color:red">
                                                @error('taken_leaves')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="col-lg-4 col-form-label form-label">Employee Status<span
                                                    class="text-red">*</span></label>

                                            <select class="form-select" name="status">
                                                <option value="">Select</option>
                                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="Not Active"
                                                    {{ old('status') == 'Not Active' ? 'selected' : '' }}>
                                                    Not Active</option>
                                            </select>
                                            <span style="color:red">
                                                @error('status')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="date">CTC</label>
                                        <input class="form-control" maxlength="8" type="text"
                                            value="{{ old('ctc') }}" id="website" name="ctc"
                                            placeholder=" Enter Ctc " />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="date">Date Of Birth<span
                                                class="text-red">*</span></label>
                                        <input class="form-control" type="date" value="{{ old('dob') }}"
                                            id="website" name="dob" placeholder="Required" />
                                        <span style="color:red">
                                            @error('dob')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-lg-4 col-form-label form-label">Employment Type<span
                                                class="text-red">*</span></label>
                                        <select class="form-select" name="Emptype">
                                            <option value="">Select</option>
                                            <option value="INTERN" {{ old('Emptype') == 'INTERN' ? 'selected' : '' }}>
                                                INTERN
                                            </option>
                                            <option value="Permanent"
                                                {{ old('Emptype') == 'Permanent' ? 'selected' : '' }}>Permanent
                                            </option>
                                        </select>
                                        <span style="color:red">
                                            @error('Emptype')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message">Aadhar Number :</label>

                                        <input class="form-control" type="file" value="{{ old('Aadhar_no') }}"
                                            id="digits" name="Aadhar_no" data-parsley-type="digits" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> Pan Number :</label>

                                        <input class="form-control" type="file" value="{{ old('pan_no') }}"
                                            id="number" name="pan_no" data-parsley-type="number" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> Photograph :</label>

                                        <input class="form-control" type="file" value="{{ old('photo') }}"
                                            id="number" name="photo" data-parsley-type="number" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> Employee Code :</label>

                                        <input class="form-control" type="text" value="{{ old('employment_code') }}"
                                            id="number" name="employment_code" data-parsley-type="number"
                                            placeholder=" Enter Employee Code" />

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> Contact Number :</label>

                                        <input class="form-control" maxlength="10" type="text"
                                            value="{{ old('contact_no') }}" id="number" name="contact_no"
                                            data-parsley-type="number" placeholder=" Enter Contact Number" />
                                        <span style="color:red">
                                            @error('contact_no')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Orgnization Name<span
                                                class="text-red">*</span></label>
                                        <select class="form-select" name="departname">
                                            <option value="">Select</option>
                                            <option value="Hexabells"
                                                {{ old('departname') == 'Hexabells' ? 'selected' : '' }}>
                                                Hexabells
                                            </option>
                                            <option value="Zoylee" {{ old('departname') == 'Zoylee' ? 'selected' : '' }}>
                                                Zoylee
                                            <option value="Sagenext"
                                                {{ old('departname') == 'Sagenext' ? 'selected' : '' }}>Sagenext
                                            </option>
                                        </select>
                                        <span style="color:red">
                                            @error('departname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> Designation <span
                                                class="text-red">*</span> :</label>
                                        <input class="form-control" type="text" value="{{ old('designation') }}"
                                            id="number" name="designation" data-parsley-type="number"
                                            placeholder=" Enter Designation" maxlength="30" required />
                                        <span style="color:red">
                                            @error('designation')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="date">Date Of Joining :</label>
                                        <input class="form-control" type="date" value="{{ old('doj') }}"
                                            id="website" name="doj" placeholder="Required" />
                                        <span style="color:red">
                                            @error('doj')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Work Location<span
                                                class="text-red">*</span></label>
                                        <select class="form-select" name="location">
                                            <option value="">Select</option>
                                            <option value="Noida" {{ old('location') == 'Noida' ? 'selected' : '' }}>
                                                Noida
                                            </option>
                                            <option value="Gorakhpur"
                                                {{ old('location') == 'Gorakhpur' ? 'selected' : '' }}>
                                                Gorakhpur</option>
                                            <option value="Work-From-Home"
                                                {{ old('location') == 'Work-From-Home' ? 'selected' : '' }}>Work From Home
                                            </option>
                                        </select>
                                        <span style="color:red">
                                            @error('location')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message">Address :</label>
                                        <textarea class="form-control" maxlength="100" id="message" name="address" rows="2"
                                            data-parsley-minlength="20" data-parsley-maxlength="100" placeholder=" Enter Address">{{ old('address') }}</textarea>
                                        <span style="color:red">
                                            @error('address')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Reporting Manager<font color="red">
                                                *<br>
                                            </font> </label>
                                        <select name="reportman" class=" cand_id form-select">
                                            <option value="">Select</option>
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
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Shift<span
                                                class="text-red">*</span></label>
                                        <select class="form-select" name="shift">
                                            <option value="">Select</option>
                                            <option value="Day" {{ old('shift') == 'Day' ? 'selected' : '' }}>Day
                                            </option>
                                            <option value="Night" {{ old('shift') == 'Night' ? 'selected' : '' }}>Night
                                            </option>
                                        </select>
                                        <span style="color:red">
                                            @error('shift')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Blood Group</label>
                                        <select class="form-select" name="Bgroup">
                                            <option value="">Select</option>
                                            <option value="A+" {{ old('Bgroup') == 'A+' ? 'selected' : '' }}>A+
                                            </option>
                                            <option value="A-" {{ old('Bgroup') == 'A-' ? 'selected' : '' }}>A-
                                            </option>
                                            <option value="O+" {{ old('Bgroup') == 'O+' ? 'selected' : '' }}>O+
                                            </option>
                                            <option value="O-" {{ old('Bgroup') == 'O-' ? 'selected' : '' }}>O-
                                            </option>
                                            <option value="B+" {{ old('Bgroup') == 'B+' ? 'selected' : '' }}>B+
                                            </option>
                                            <option value="B-" {{ old('Bgroup') == 'B-' ? 'selected' : '' }}>B-
                                            </option>
                                            <option value="AB+" {{ old('Bgroup') == 'AB+' ? 'selected' : '' }}>AB+
                                            </option>
                                            <option value="AB-" {{ old('Bgroup') == 'AB-' ? 'selected' : '' }}>AB-
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- ====================Employee Record======= -->

                            <h3 class="panel-title">Bank Details</h3>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> Account Number:</label>
                                        <input class="form-control" maxlength="25" type="text"
                                            value="{{ old('account_no') }}" id="number" name="account_no"
                                            data-parsley-type="number" placeholder=" Enter Account Number"
                                            oninput="this.value = this.value.toUpperCase()" />
                                        <span style="color:red">
                                            @error('account_no')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message">Confirm Account Number
                                            :</label>
                                        <input class="form-control" maxlength="25" type="text"
                                            value="{{ old('caccount_no') }}" id="number" name="caccount_no"
                                            data-parsley-type="number" placeholder=" Confirm Account Number"
                                            oninput="this.value = this.value.toUpperCase()" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> Bank Name :</label>
                                        <input class="form-control" maxlength="30" type="text"
                                            value="{{ old('bank') }}" id="number" name="bank"
                                            data-parsley-type="number" placeholder=" EnterBank Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> IFSC Code :</label>
                                        <input class="form-control" maxlength="25" type="text"
                                            value="{{ old('ifsc') }}" id="number" name="ifsc"
                                            data-parsley-type="number" placeholder=" Enter IFSC Code "
                                            oninput="this.value = this.value.toUpperCase()" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message"> UAN Number (if Exixts)
                                            :</label>
                                        <input class="form-control" maxlength="40" type="text"
                                            value="{{ old('uan') }}" id="number" name="uan"
                                            data-parsley-type="number" placeholder=" Enter UAN Number" />

                                    </div>
                                </div>
                            </div>
                            <!-- ====================Employee Record end======= -->
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
                <!-- END panel -->
            </div>
            <!-- END col-6 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->
    <script>
        $(document).ready(function() {
            $('.cand_id').on('change', (e) => {
                // console.log(e.target.value);
                let $id;
                let children = $('.cand_id').children();
                (function() {
                    if (e.target.value != "") {
                        $id = (children[e.target.value]).value;
                    } else if (e.target.value == "") {
                        $id = undefined;
                    }
                })();
                if ($id) {
                    $.ajax({
                        type: 'get',
                        url: '/emp/detail',
                        data: {
                            'id': $id
                        },
                        success: function(data) {
                            $('#candidate-data').removeClass('hide');
                            let needed = (Object.keys(data)).slice(0, 5);
                            let feilds = document.querySelectorAll('.feilds td');
                            for (let j = 0; j < needed.length; j++) {
                                feilds[j].textContent = data[needed[j]];
                            }
                        }
                    });
                } else {
                    $('#candidate-data').addClass('hide');
                }
            })
        });
    </script>
@endsection
