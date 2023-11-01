@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active">Team Lead</li>
        </ol>
        <!-- End breadcrumb start-->

        <!-- BEGIN page-header -->
        <h1 class="page-header"><b>Team Leader page</b><small></small></h1>
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title"><b>Team Leader Page</b></h4>
                    </div>
                    <!-- BEGIN panel-body -->

                    <div class="pb-3">
                        <table class="table table-striped mb-0 align-middle ">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email </th>
                                    <th>Contact Number</th>
                                    <th>Designation</th>
                                    <div>
                                        <th> Attendance
                                            {{ now()->format('d-m-Y') }}
                                        </th>
                                    </div>
                                    <th width="1%"></th>
                                </tr>
                            </thead>
                            <tbody id='emp-list' class="position-relative">

                                @foreach ($employes as $employe)
                                    {{-- @if ($employes->status == 'Active') --}}
                                        <tr>

                                            <td>{{ $employe->employee_name }}</td>
                                            <td>{{ $employe->email }}</td>
                                            <td>{{ $employe->contact_no }}</td>
                                            <td>{{ $employe->designation }}</td>
                                            <td>

                                                <div class="form-check form-check-inline">
                                                    <label> <b> Present </b> </label>
                                                    <input class=" form-check-input  mycheckbox emp_id" data-name='emp_id'
                                                        emd_id="{{ $employe->id }}" name="attdence_date" type="checkbox"
                                                        value="1"
                                                        current_date="{{ $employe->getAttendace->attendance_date ?? '' }}">
                                                </div>
                                                <br>
                                                <div class="form-check  form-check-inline">
                                                    <label> <b> Absent </b> </label>
                                                    <input class="form-check-input  mycheckbox emp_leave"
                                                        data-name='emp_leave' emd_id="{{ $employe->id }}" name="leave_date"
                                                        type="checkbox" value="2"
                                                        current_date="{{ $employe->getLeave->leave_date ?? '' }}">
                                                </div>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <label> <b>Sick Leave</b> </label>
                                                    <input class="form-check-input  mycheckbox emp_sick"
                                                        data-name='emp_sick' emd_id="{{ $employe->id }}"
                                                        name="sick_leave_date" type="checkbox" value="3"
                                                        current_date="{{ $employe->getSickLeave->sick_leave_date ?? '' }}">
                                                </div>
                                                <br>
                                                <div class="form-check  form-check-inline">
                                                    <label> <b>Paid Leave </b> </label>
                                                    <input class="form-check-input  mycheckbox emp_paid"
                                                        data-name='emp_paid' emd_id="{{ $employe->id }}"
                                                        name="paid_leave_date" type="checkbox" value="4"
                                                        current_date="{{ $employe->getPaidLeave->paid_leave_date ?? '' }}">
                                                </div>
                                            </td>

                                        </tr>
                                    {{-- @endif --}}
                                @endforeach
                            </tbody>

                        </table>
                        @forelse ($employes as $employe)
                        @empty
                            <!-- Display vector image here -->
                            <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found"
                                height="500" width="900">
                        @endforelse
                    </div>
                </div>

                <script>
                    $('.emp_id').each(function() {
                        let currentDate = $(this).attr('current_date');
                        console.log(typeof currentDate, currentDate);
                        if (currentDate) {
                            $(this).prop('checked', true);
                        }

                    })


                    // for present
                    $('.emp_id').on('click', function() {

                        let checked = $(this).is(':checked');

                        $id = $(this).attr('emd_id');

                        if (checked) {
                            $.ajax({
                                type: 'get',
                                url: '/tlattendence',
                                data: {
                                    id: $id,
                                },

                            });
                        } else {
                            $.ajax({
                                type: 'get',
                                url: '/attendencedelete',
                                data: {
                                    id: $id,
                                },
                            });

                        }

                    });
                </script>

                <script>
                    $('.emp_leave').each(function() {
                        let currentDate = $(this).attr('current_date');
                        console.log(typeof currentDate, currentDate);
                        if (currentDate) {
                            $(this).prop('checked', true);
                        }

                    })

                    // for leave
                    $('.emp_leave').on('click', function() {


                        let checked = $(this).is(':checked');

                        $id = $(this).attr('emd_id');

                        if (checked) {
                            $.ajax({
                                type: 'get',
                                url: '/leave',
                                data: {
                                    id: $id,
                                },

                            });
                        } else {
                            $.ajax({
                                type: 'get',
                                url: '/leavedelete',
                                data: {
                                    id: $id,
                                },
                            });

                        }

                    });
                </script>

                <script>
                    $('.emp_sick').each(function() {
                        let currentDate = $(this).attr('current_date');
                        console.log(typeof currentDate, currentDate);
                        if (currentDate) {
                            $(this).prop('checked', true);
                        }

                    })


                    // for sickleave

                    $('.emp_sick').on('click', function() {
                        let checked = $(this).is(':checked');
                        $id = $(this).attr('emd_id');

                        if (checked) {
                            $.ajax({
                                type: 'get',
                                url: '/sickleave',
                                data: {
                                    id: $id,
                                },

                            });
                        } else {
                            $.ajax({
                                type: 'get',
                                url: '/sickleavedelete',
                                data: {
                                    id: $id,
                                },
                            });

                        }

                    });
                </script>

                <script>
                    console.log($('.emp_paid').attr('current_date'));

                    $('.emp_paid').each(function() {
                        let currentDate = $(this).attr('current_date');
                        console.log(typeof currentDate, currentDate);
                        if (currentDate) {
                            $(this).prop('checked', true);
                        }

                    })


                    // for paid leave
                    $('.emp_paid').on('click', function() {


                        let checked = $(this).is(':checked');

                        $id = $(this).attr('emd_id');

                        if (checked) {
                            $.ajax({
                                type: 'get',
                                url: '/paidleave',
                                data: {
                                    id: $id,
                                },

                            });
                        } else {
                            $.ajax({
                                type: 'get',
                                url: '/paidleavedelete',
                                data: {
                                    id: $id,
                                },
                            });

                        }

                    });
                </script>

                <script>
                    function myFunction() {
                        // Get the checkbox
                        var checkBox = document.getElementById("myCheck");
                        // Get the output text
                        var text = document.getElementById("text");

                        // If the checkbox is checked, display the output text
                        if (checkBox.checked == true) {
                            text.style.display = "block";
                        } else {
                            text.style.display = "none";
                        }
                    }
                </script>
            @endsection
