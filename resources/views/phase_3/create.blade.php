@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('phase3') }}">Interview Phase 3</a></li>
            <li class="breadcrumb-item active"> Add Phase 3 detail</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-heading -->
        <h1 class="page-heading">Interview Phase 3</h1>
        <!-- END page-heading -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-14">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Interview Phase 3</h4>
                        <td><a href={{ route('phase3') }} class="btn btn-primary">List</a></td>
                    </div>
                    <!-- END panel-heading -->

                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('phase3form') }}" method="POST" name="demo-form">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label">Select Candidate<font color="red">*<br>
                                            </font> </label>
                                        <select name="id" class="cand_id form-select">
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
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" class="form-check-input" for="hrround">HR
                                            Round<font color="red">*<br></font></label>
                                        <div class="col-lg-8">
                                            <input class="form-check-input" type="radio" id="html" name="hrround"
                                                value="Done">
                                            <label lass="form-check-label" for="Done">Done</label>
                                            <input class="form-check-input" type="radio" id="css" name="hrround"
                                                value="Pending">
                                            <label class="form-check-label" for="Pending">Pending</label>
                                            <span style="color:red">
                                                @error('hrround')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group row mb-3">
                                        <label class="col-form-label form-label" class="form-check-input"
                                            for="radio">Background Verification<font color="red">*<br></font></label>
                                        <div class="col-lg-8">
                                            <input class="form-check-input" type="radio" id="html" name="bgv"
                                                value="Done">
                                            <label class="form-check-label" for="Done">Done </label>
                                            <input class="form-check-input" type="radio" id="html" name="bgv"
                                                value="Pending">
                                            <label class="form-check-label" for="Pending">Pending</label><br>
                                            <span style="color:red">
                                                @error('bgv')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group row mb-3 d-flex justify-content-end">
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

                            <div class="row mb-3">
                                <div class="col-lg-4">

                                </div>
                                <div class="col-lg-4">

                                </div>
                                <div class="col-lg-4">

                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group row mb-3">
                                        <label class="col-form-label form-label" class="form-check-input"
                                            for="radio">Offer Letter<font color="red">*<br></font></label>
                                        <div class="col-lg-8">
                                            <input class="form-check-input" type="radio" id="html" name="offerletter"
                                                value="Issued">
                                            <label class="form-check-label" for="Issued">Issued </label>
                                            <input class="form-check-input" type="radio" id="html"
                                                name="offerletter" value="Not Issued">
                                            <label class="form-check-label" for="Not Issued">Not Issued</label><br>
                                            <span style="color:red">
                                                @error('offerletter')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label form-label" for="message">CTC(As mentioned in the
                                            offer letter)<font color="red">*<br></font></label>
                                        <input class="form-control" type="text" name="ctc"
                                            value="{{ old('ctc') }}" placeholder="Enter CTC Here" />
                                        <span style="color:red">
                                            @error('ctc')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group row mb-3">
                                        <label class="col-form-label form-label" for="date">Date of Joining<font
                                                color="red">*<br></font></label>
                                        <input class="form-control" type="date" name="jdate" placeholder="date" />
                                        <span style="color:red">
                                            @error('jdate')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group ">
                                        <label class="col-form-label form-label" for="repomanager">Reporting Manager<font
                                                color="red">*<br></font></label>
                                        <input class="form-control" type="text" name="repomanager"
                                            value="{{ old('repomanager') }}"
                                            placeholder="Enter Reporting Manager Name" />
                                        <span style="color:red">
                                            @error('repomanager')
                                                {{ $message }}
                                            @enderror
                                        </span>
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
