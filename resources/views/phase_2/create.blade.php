@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('templist') }}">Interview Phase 2</a></li>
            <li class="breadcrumb-item active">Add Interview Detail</li>
        </ol>
        <!-- End breadcrumb start-->
        <!-- BEGIN page-header -->

        <h1 class="page-header">Interview Phase 2 </h1>

        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Interview Detail Management</h4>
                        <td><a href={{ route('templist') }} class="btn btn-primary">List</a></td>

                    </div>
                    <!-- END panel-heading -->
                    <br>

                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('phase2form') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-lg-4">
                                    <label class="col-form-label form-label">Select Candidate<font color="red">*<br>
                                        </font> </label>
                                    <select name="id" class="cand_id form-select  table.cand-table" required>
                                        <option value="select" {{ old('id') == 'select' ? 'selected' : '' }}>Select
                                        </option>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->fullname }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">
                                        @error('id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="col-form-label form-label">Interview Mode<font color="red">*<br>
                                        </font> </label>

                                    <select name="intmode" value="{{ old('intmode') }}" class="form-select">
                                        <option value="">Select</option>
                                        <option value="Virtual" {{ old('intmode') == 'Virtual' ? 'selected' : '' }}>
                                            Virtual
                                        </option>
                                        <option value="Face-To-Face"
                                            {{ old('intmode') == 'Face-To-Face' ? 'selected' : '' }}>Face-To-Face
                                        </option>
                                        <option value="Telephonic" {{ old('intmode') == 'Telephonic' ? 'selected' : '' }}>
                                            Telephonic</option>
                                    </select>
                                    <span style="color:red">
                                        @error('intmode')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <div id="mycode1" class="form-group">
                                        <label class="col-form-label form-label" for="month">Interview Link </label>
                                        <input class="form-control" type="text" value="{{ old('intlink') }}"
                                            name="intlink" placeholder="Enter Interview Link" />
                                        <span style="color:red">
                                            @error('intlink')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group row d-flex justify-content-end">
                                        <div id="candidate-data" class='hide'>
                                            <table class='cand-table'>
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>NAME</th>
                                                        <th>EMAIL</th>
                                                        <th>NUMBER</th>
                                                        <th>CURR. ORG.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class='feilds'>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <style>
                                                table.cand-table {
                                                    width: 100%;
                                                }

                                                table.cand-table tr th,
                                                table.cand-table tr td {
                                                    padding: 0 10px;
                                                }

                                                .hide {
                                                    display: none;
                                                }
                                            </style>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Interview Type<font color="red">*<br>
                                            </font></label>
                                        <select name="inttype" class="form-select" value="{{ old('inttype') }}">
                                            <option value="">Select</option>
                                            <option value="Technical"
                                                {{ old('inttype') == 'Technical' ? 'selected' : '' }}>
                                                Technical</option>
                                            <option value="Non-Technical"
                                                {{ old('inttype') == 'Non-Technical' ? 'selected' : '' }}>
                                                Non-Technical
                                            </option>
                                        </select>
                                        <span style="color:red">
                                            @error('inttype')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="date">Interview Date<font
                                                color="red">
                                                *<br></font></label>
                                        <input class="form-control" value="{{ old('date') }}" type="date"
                                            name="date" placeholder="Required" />
                                        <span style="color:red">
                                            @error('date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Interviewer's Name<font color="red">
                                                *<br></font></label>
                                        <input class="form-control" type="text" maxlength="40" value="{{ old('intname') }}"
                                            name="intname"placeholder="Enter Interviewer Name Here" />
                                        <span style="color:red">
                                            @error('intname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Interview Status<font color="red">*<br>
                                            </font></label>
                                        <select name="intstatus"class="form-select">
                                            <option value="{{ old('intstatus') }}">Select</option>
                                            <option value="Selected"
                                                {{ old('intstatus') == 'Selected' ? 'selected' : '' }}>
                                                Selected</option>
                                            <option value="Rejected"
                                                {{ old('intstatus') == 'Rejected' ? 'selected' : '' }}>
                                                Rejected</option>
                                            <option value="Hold" {{ old('intstatus') == 'Hold' ? 'selected' : '' }}>Hold
                                            </option>
                                        </select>

                                        <span style="color:red">
                                            @error('intstatus')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="feedback">Feedback From Interviwer
                                        </label>
                                        <textarea class="form-control" maxlength="100" type="message" value="{{ old('feedback') }}" name="feedback"
                                            placeholder="Feedback From Interviwer"></textarea>
                                        <span style="color:red">
                                            @error('feedback')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div id="mycode" class="form-group">
                                        <label class="col-form-label form-label" for="rdate">Rescheduled Date and
                                            Time</label>
                                        <input class="form-control" value="{{ old('rdate') }}" type="datetime-local"
                                            name="rdate" />
                                        <span style="color:red">
                                            @error('rdate')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Reschedule</label>
                                        <div class="col-lg-8">
                                            <input type="radio" name="reschedule" value="Yes" onclick="text(0)">Yes
                                            <input type="radio" name="reschedule" value="No" onclick="text(1)">No
                                            <span style="color:red">
                                                @error('reschedule')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
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
                $id = e.target.value;
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
