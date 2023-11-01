@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">

    <!-- ================== END page-js ================== -->

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active">Attendance Sheet</li>
        </ol>
        <!-- End breadcrumb start-->
        <!-- BEGIN page-header -->

        <h1 class="page-header">Attendance Sheet </h1>

        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" style='z-index:44'>
                            <table class="table table-responsive table-bordered table-sm">
                                <thead>
                                    <tr class='header-row'>
                                        <th class='em-name'>Employee Name</th>
                                        <th class='em-pos'>Designation</th>
                                        @php
                                            $today = today();
                                            $dates = [];
                                            for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                                                $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('d-m-Y');
                                            }

                                        @endphp

                                        @foreach ($dates as $key => $date)
                                            <th>
                                                {{ \Carbon\Carbon::parse($date)->format('l') }} <br>
                                                {{ $date }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('check_store') }}" method="post">
                                        <div class="d-flex justify-content-between align-items-center title-row">

                                            <b class='current-date' style='font-size:18px;'>{{ now()->format('d-m-Y') }}
                                            </b>
                                            <button type="submit" class="btn btn-success"
                                                style="display: flex; margin:10px">submit</button>
                                            @csrf
                                        </div>
                                        @foreach ($employes as $employe)
                                            {{-- <input type="hidden" name="emp_id" value="{{ $employe->id }}"> --}}
                                            <tr>
                                                @if ($employe->status == 'Active')
                                                    <td>{{ $employe->employee_name }}</td>
                                                    <td>{{ $employe->designation }}</td>
                                                    @for ($i = 1; $i < $today->daysInMonth + 1; ++$i)
                                                        @php
                                                            $date_picker = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                                            $check_attd = \App\Models\Attendance::query()
                                                                ->where('emp_id', $employe->id)
                                                                ->where('attendance_date', $date_picker)
                                                                ->first();

                                                            $check_leave = \App\Models\Leave::query()
                                                                ->where('emp_id', $employe->id)
                                                                ->where('leave_date', $date_picker)
                                                                ->first();

                                                            $check_sickleave = \App\Models\SickLeave::query()
                                                                ->where('emp_id', $employe->id)
                                                                ->where('sick_leave_date', $date_picker)
                                                                ->first();
                                                            $check_paidleave = \App\Models\PaidLeave::query()
                                                                ->where('emp_id', $employe->id)
                                                                ->where('paid_leave_date', $date_picker)
                                                                ->first();
                                                        @endphp

                                                        <td>
                                                            @if ($date_picker == now()->format('Y-m-d'))
                                                                <div class="form-check form-check-inline">
                                                                    <label> <b>P</b> </label>
                                                                    <input class="form-check-input present emp_id"
                                                                        id="check_box"
                                                                        name="attd[{{ $date_picker }}][{{ $employe->id }}]"
                                                                        type="radio" data-name='emp_id'
                                                                        @if (isset($check_attd)) checked @endif
                                                                        id="inlineCheckbox1" value="P"
                                                                        onclick="copyAttribute(this)">


                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <label> <b>A</b> </label>
                                                                    <input class="form-check-input absent emp_leave"
                                                                        id="check_box"
                                                                        name="attd[{{ $date_picker }}][{{ $employe->id }}]"
                                                                        type="radio" data-name='emp_leave'
                                                                        @if (isset($check_leave)) checked @endif
                                                                        id="inlineCheckbox2" value="A"
                                                                        onclick="copyAttribute(this)">

                                                                </div>
                                                                <div class="form-check form-check-inline ">
                                                                    <label> <b>SL</b> </label>
                                                                    <input class="form-check-input sick-leave emp_sick"
                                                                        id="check_box"
                                                                        name="attd[{{ $date_picker }}][{{ $employe->id }}]"
                                                                        type="radio" data-name='emp_sick'
                                                                        @if (isset($check_sickleave)) checked @endif
                                                                        id="inlineCheckbox3" value="SL"
                                                                        onclick="copyAttribute(this)">

                                                                </div>
                                                                <div class="form-check form-check-inline ">
                                                                    <label> <b>PL</b> </label>
                                                                    <input class="form-check-input paid-leave emp_paid"
                                                                        id="check_box"
                                                                        name="attd[{{ $date_picker }}][{{ $employe->id }}]"
                                                                        type="radio"data-name='emp_paid'
                                                                        @if (isset($check_paidleave)) checked @endif
                                                                        id="inlineCheckbox4" value="PL"
                                                                        onclick="copyAttribute(this)">
                                                                </div>
                                                            @else
                                                                {{-- for not today --}}
                                                                <div class="form-check form-check-inline">
                                                                    <label> <b>P</b> </label>
                                                                    <input class="form-check-input present emp_id"
                                                                        data-bs-toggle="modal"
                                                                        data-date="{{ $date_picker }}"
                                                                        data-id="{{ $employe->id }}"
                                                                        data-bs-target="#staticBackdrop" id="check_box"
                                                                        name="attd[{{ $date_picker }}][{{ $employe->id }}]"
                                                                        type="radio" data-name='emp_id'
                                                                        @if (isset($check_attd)) checked @endif
                                                                        id="inlineCheckbox1" value="P"
                                                                        onclick="copyAttribute(this)">


                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <label> <b>A</b> </label>
                                                                    <input class="form-check-input absent emp_leave"
                                                                        data-bs-toggle="modal"
                                                                        data-date="{{ $date_picker }}"
                                                                        data-id="{{ $employe->id }}"
                                                                        data-bs-target="#staticBackdrop" id="check_box"
                                                                        name="attd[{{ $date_picker }}][{{ $employe->id }}]"
                                                                        type="radio" data-name='emp_leave'
                                                                        @if (isset($check_leave)) checked @endif
                                                                        id="inlineCheckbox2" value="A"
                                                                        onclick="copyAttribute(this)">

                                                                </div>
                                                                <div class="form-check form-check-inline ">
                                                                    <label> <b>SL</b> </label>
                                                                    <input class="form-check-input sick-leave emp_sick"
                                                                        data-bs-toggle="modal"
                                                                        data-date="{{ $date_picker }}"
                                                                        data-id="{{ $employe->id }}"
                                                                        data-bs-target="#staticBackdrop" id="check_box"
                                                                        name="attd[{{ $date_picker }}][{{ $employe->id }}]"
                                                                        type="radio" data-name='emp_sick'
                                                                        @if (isset($check_sickleave)) checked @endif
                                                                        id="inlineCheckbox3" value="SL"
                                                                        onclick="copyAttribute(this);">

                                                                </div>
                                                                <div class="form-check form-check-inline ">
                                                                    <label> <b>PL</b> </label>
                                                                    <input class="form-check-input paid-leave emp_paid"
                                                                        data-bs-toggle="modal"
                                                                        data-date="{{ $date_picker }}"
                                                                        data-id="{{ $employe->id }}"
                                                                        data-bs-target="#staticBackdrop" id="check_box"
                                                                        name="attd[{{ $date_picker }}][{{ $employe->id }}]"
                                                                        type="radio"data-name='emp_paid'
                                                                        @if (isset($check_paidleave)) checked @endif
                                                                        id="inlineCheckbox4" value="PL"
                                                                        onclick="copyAttribute(this);">
                                                                </div>
                                                            @endif
                                                            {{-- for today --}}
                                                        </td>
                                                    @endfor
                                                @endif
                                            </tr>
                                        @endforeach
                                    </form>
                                </tbody>
                            </table>
                            @forelse ($employes as $employe)
                            @empty
                                <!-- Display vector image here -->
                                <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found"
                                    height="500" width="900">
                            @endforelse
                        </div>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">
                                            Required Changes reason</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('attendance-reason') }}" method="POST"
                                            enctype="multipart/form-data" id='modal-form'>
                                            @csrf
                                                <div class="form-group row mb-3">
                                                    <label class="col-lg-4 col-form-label form-label" for="reason">Reason
                                                        :</label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control" id="reason" name="reason" rows="4" data-parsley-maxlength="100"
                                                            value="{{ old('reason') }}" placeholder="Range from 20 - 200"></textarea>
                                                            <span style="color: red">
                                                                @error('reason')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                    </div>
                                                    {{-- create some inputs --}}
                                                    <input type="hidden" name="emp_id" value='' id='emp-id'>
                                                    <input type="hidden" name="attendance_date" value=''
                                                    id='target-date'>
                                                    <input type="hidden" name="attendance_type" value=''
                                                    id='attendance-type'>
                                                </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success"
                                                    style="display: flex; margin:10px">submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END panel -->
            </div>
            <!-- END col-6 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->



    <script>
        function copyAttribute(clickInput) {

            //date - data-date
            //id - data-id
            //attendance - value
            let form = document.getElementById('modal-form');
            let dateInput = form.querySelector('#target-date');
            let idInput = form.querySelector('#emp-id');
            let attendanceInput = form.querySelector('#attendance-type');
            dateInput.value = clickInput.getAttribute('data-date');
            idInput.value = clickInput.getAttribute('data-id');
            attendanceInput.value = clickInput.getAttribute('value');

            // document.getElementById('emp_unique_id').innerHTML = emp_id;

        };
    </script>


    <script>
        let headerRow = document.querySelector('.header-row');
        let theads = headerRow.children;
        let currentDate = document.querySelector('.current-date').textContent.trim();
        let index = 0;

        for (index; index < theads.length; index++) {
            let headContent = theads[index].textContent.trim();
            if (headContent.includes(currentDate)) {
                console.log(index);
                break;
            }
        }

        let rows = document.querySelectorAll('.table-responsive  tr');
        console.log(rows[0].children[9])
        rows.forEach((row) => {
            let cells = row.children;
            cells[index].classList.add('active-cell');
        })
    </script>


@endsection
