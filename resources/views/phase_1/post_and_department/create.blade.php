@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('viewdetail2') }}">Post and Department</a></li>
            <li class="breadcrumb-item active">Add Department</li>
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
                        <h4 class="panel-title"><b>Post and Department Management</b></h4>
                        <td><a href={{ route('viewdetail2') }} class="btn btn-primary">List</a></td>
                    </div>
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form action="postanddep" method="POST" class="form-horizontal" data-parsley-validate="true">
                            @csrf

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label">Select Candidate<font color="red">*<br>
                                    </font> </label>
                                <div class="col-lg-8">

                                    <select name="id" class=" cand_id form-select">
                                        <option value="">Select</option>
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
                            <div class="form-group row mb-3 d-flex justify-content-end">

                                <div class="col-lg-8">
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
                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="title">Profile : <font
                                        color="red">*<br></font> </label>
                                <div class="col-lg-8">
                                    <input class="form-control" maxlength="40" type="text" id="title" name="title"
                                        placeholder="Enter Post Title" />
                                    <span style="color: red">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="department">Department : <font
                                        color="red">*<br></font> </label>
                                <div class="col-lg-8">
                                    <input class="form-control" maxlength="40" type="text" id="department" name="department"
                                        placeholder="Enter Candidate's Department" />
                                    <span style="color: red">
                                        @error('department')
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
                </div>


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
