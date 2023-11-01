@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/Excel-import-button.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/hrcrm/tool-tip.js') }}">



    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active">Interview Phase 2</li>

        </ol>
        <!-- End breadcrumb start-->
        <!-- BEGIN page-header -->
        <h1 class="page-header">Interview Phase 2</h1>

        <!-- END page-header -->
        <!-- BEGIN panel -->
        <div class="panel panel-inverse">

            <!-- BEGIN panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title">Interview Details Management</h4>

                <select id="itemsPerPage" onchange="changeItemsPerPage(this)"
                    style="width:90px; padding: 0.4375rem 0.75rem;border-radius: 4px; margin:0 5px;">
                    <option value="10" {{ $itemsPerPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $itemsPerPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="100" {{ $itemsPerPage == 100 ? 'selected' : '' }}>100</option>
                    <!-- Add more options as needed -->
                </select>

                <center>
                    <div class="container">
                        <a href="{{ route('export.phase2') }}">
                            <button type="submit" style="height:30%;width:110px">
                                <span>Export Excel</span>
                                <svg viewBox="-5 -5 110 110" preserveAspectRatio="none" aria-hidden="true">
                                    <path
                                        d="M0,0 C0,0 100,0 100,0 C100,0 100,100 100,100 C100,100 0,100 0,100 C0,100 0,0 0,0" />
                                </svg>
                            </button>
                        </a>
                    </div>
                </center>


                <div class="navbar-item navbar-form" style="margin-right: 16px">
                    <div class="form-group search">
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Search Here..">
                    </div>
                </div>
                <div class="panel-heading-btn">
                    <p align="right">
                    <div class="form-group row">
                        {{-- <label class="col-lg-4 col-form-label form-label">&nbsp;</label> --}}
                        <div class="col-lg-6">
                            <a href="{{ route('phase2form') }}">
                                <button type="submit" class="btn btn-primary"> Add</button>
                            </a>
                        </div>
                    </div>
                    </p>
                </div>
            </div>
            <!-- END panel-heading -->
            <!-- BEGIN panel-body -->
            <div class="panel-body">
                <table id="data-table-scroller" class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th class="text-nowrap">No.</th>
                            <th class="text-nowrap">Candidate Name</th>
                            <th class="text-nowrap">Mode</th>
                            <th class="text-nowrap">Date</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Reschedule</th>
                            <th class="text-nowrap">Action</th>

                        </tr>
                    </thead>
                    <tbody id="emp_list" class="position-relative">
                        <tr class="odd gradeX">
                            @php
                                 $counter = ($students->currentPage() - 1) * $students->perPage() + 1;
                            @endphp
                            @foreach ($students as $student)
                        <tr>
                            <td width="1%" class="fw-bold text-dark">{{ $counter++ }}</td>
                            <td>{{ $student->showI->fullname ?? '' }}</td>
                            <td>{{ $student['intmode'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($student->date)) }}</td>
                            <td>{{ $student['intname'] }}</td>
                            <td>{{ $student['intstatus'] }}</td>
                            <td>{{ $student['reschedule'] }}</td>
                            <td><a data-toggle="tooltip" rel="tooltip" data-placement="top" title="View"
                                    href={{ 'view1/' . $student['id'] }} class="far fa-eye"></a>
                                <a data-toggle="tooltip" rel="tooltip" data-placement="top" title="Edit"
                                    href={{ 'update1/' . $student['id'] }} style="margin-left: 10px;"
                                    class="far fa-edit"></a>
                                <a data-toggle="tooltip" rel="tooltip" data-placement="top" title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this field?');"
                                    href={{ 'delete1/' . $student['id'] }} style="margin-left: 10px;"
                                    class="far fa-trash-alt"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- </form> -->
            </div>
            <!-- END panel-body -->
            @forelse ($students as $student)
            @empty
                <!-- Display vector image here -->
                <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="500"
                    width="900">
            @endforelse

            <div class="d-flex justify-content-center">
                {{ $students->appends(['itemsPerPage' => $itemsPerPage])->links('pagination::bootstrap-4') }}
            </div>

            <style>
                .w-5 {
                    display: none;
                }
            </style>
        </div>
        <!-- END panel -->
    </div>
    <!-- END #content -->
    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('phase2.search') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        console.log(data);
                        $('#emp_list').html(data);
                    }
                });
            } else {
                $.ajax({
                    type: 'get',
                    url: '{{ route('phase2.search2') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('#emp_list').html(data);
                    }
                });
            }

        });
    </script>
@endsection
