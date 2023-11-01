@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/Excel-import-button.css') }}">

    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->

    <!-- BEGIN #app -->
    <!-- BEGIN #content -->
    <div id="content" class="app-content mt-2">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item">Candidate's Details </li>
        </ol>
        <!-- END breadcrumb -->

        <!-- BEGIN page-header -->
        <h1 class=page-header>Candidate's Details</h1>
        <!-- END page-header -->
        <!-- BEGIN panel -->
        <div class="panel panel-inverse">


            <!-- BEGIN panel-heading -->
            <div class="panel-heading ">
                <h3 class="panel-title">Candidate's Details List</h3>

                <div class="navbar-item navbar-form" style="margin-right: 16px">
                    <div class="form-group search">
                        <!-- Search input -->
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Search Here..">
                    </div>
                    <!-- Delete All Selected button (initially hidden) -->
                    {{-- <a class="btn btn-danger" id="deleteAllSelectedRecord" href="{{ route('delete.all.candidate') }}"
                            style="display: none;">Delete All Selected</a> --}}

                    <form action="{{ route('delete.all.candidate') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" id="deleteAllSelectedRecord" style="display: none;">Delete All
                            Selected</button>
                    </form>
                </div>

                <select id="itemsPerPage" onchange="changeItemsPerPage(this)"
                    style="width:70px; padding: 0.4375rem 0.75rem;border-radius: 4px; margin:0 5px;">
                    <option value="10" {{ $itemsPerPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $itemsPerPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="100" {{ $itemsPerPage == 100 ? 'selected' : '' }}>100</option>
                    <!-- Add more options as needed -->
                </select>
                <center>
                    <div class="container">
                        <a href="{{ route('export.candidate') }}">
                            <button type="submit" style="height:30%;width:80px">
                                <span>Export</span>
                                <svg viewBox="-5 -5 110 110" preserveAspectRatio="none" aria-hidden="true">
                                    <path
                                        d="M0,0 C0,0 100,0 100,0 C100,0 100,100 100,100 C100,100 0,100 0,100 C0,100 0,0 0,0" />
                                </svg>
                            </button>
                        </a>
                    </div>
                </center>

                <center>
                    <div class="container">
                        <a href="{{ route('excel.import') }}">
                            <button type="submit" style="height:30%;width:80px">
                                <span>Import</span>
                                <svg viewBox="-5 -5 110 110" preserveAspectRatio="none" aria-hidden="true">
                                    <path
                                        d="M0,0 C0,0 100,0 100,0 C100,0 100,100 100,100 C100,100 0,100 0,100 C0,100 0,0 0,0" />
                                </svg>
                            </button>
                        </a>
                    </div>
                </center>


                <td><a href={{ route('interview1') }} class="btn btn-success">Add</a></td>
            </div>
            <!-- END panel-heading -->
            <!-- BEGIN panel-body -->
            <div class="panel-body">
                <!-- Add this button below your table -->
                <table id="data-table-scroller" class="table table-panel text-nowrap align-middle mb-0">
                    <thead>
                        <tr>
                            {{-- <th><input class="form-check-input" type="checkbox" name="" id="select_all_ids">
                                </th> --}}
                            <th>S.No.</th>
                            <th class="text-nowrap">Candidate's Name</th>
                            <th class="text-nowrap">Contact Number</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Expected CTC</th>
                            <th class="text-nowrap">Action</th>

                        </tr>
                    </thead>
                    <tbody id="employe_list" class="position-relative">
                        @php
                            $counter = ($members->currentPage() - 1) * $members->perPage() + 1;
                        @endphp

                        @foreach ($members as $member)
                            <tr>
                                {{-- <td><input type="checkbox" name="ids" class="form-check-input checkbox_ids"
                                            value="{{ $member->id }}"> </td> --}}
                                <td width="1%" class="fw-bold text-dark">{{ $counter++ }}</td>
                                <td>{{ $member['fullname'] }}</td>
                                <td>{{ $member['number'] }}</td>
                                <td>{{ $member['email'] }}</td>
                                <td>{{ $member['ectc'] }}</td>
                                <td><a data-toggle="tooltip" rel="tooltip" data-placement="top" title="Edit"
                                        href={{ 'phase1/edit/' . $member['id'] }} class="far fa-edit"></a>
                                    <a data-toggle="tooltip" rel="tooltip" data-placement="top" title="View"
                                        href={{ 'viewdetail/' . $member['id'] }} style="margin-left: 10px;"
                                        class="far fa-eye"></a>
                                    <a data-toggle="tooltip" rel="tooltip" data-placement="top" title="Delete"
                                        href={{ 'interview/delete/' . $member['id'] }} input
                                        onclick="return confirm('are u sure?')" style="margin-left: 10px;" type="submit"
                                        value="Delete"class="far fa-trash-alt"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            @forelse ($members as $member)
            @empty
                <!-- Display vector image here -->
                <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="500"
                    width="900">
            @endforelse


            <div class="d-flex justify-content-center">
                {{ $members->appends(['itemsPerPage' => $itemsPerPage])->links('pagination::bootstrap-4') }}
            </div>

            <style>
                .w-5 {
                    display: none;
                }
            </style>
        </div>
    </div>
    {{-- for showing  perticular employee By id --}}
    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('search.phase.one') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        console.log(data);
                        $('#employe_list').html(data);
                        console.log($('#employe_list').html())
                    }
                });
            } else {
                $.ajax({
                    type: 'get',
                    url: '{{ route('search.phase1') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('#employe_list').html(data);
                    }
                });
            }
        });
    </script>



    {{-- JavaScript code --}}



    {{-- <script>
        $(document).ready(function() {
            // Handle select all checkboxes
            $('#select_all_ids').on('change', function() {
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
                toggleDeleteButton();
            });

            // Handle individual checkbox change
            $('.checkbox_ids').on('change', function() {
                toggleDeleteButton();
            });

            // Function to toggle the delete button and search box
            function toggleDeleteButton() {
                var anyCheckboxChecked = $('.checkbox_ids:checked').length > 0;
                if (anyCheckboxChecked) {
                    // Show the Delete All Selected button and hide the search box
                    $('#deleteAllSelectedRecord').show();
                    $('#search').hide();
                } else {
                    // Show the search box and hide the Delete All Selected button
                    $('#deleteAllSelectedRecord').hide();
                    $('#search').show();
                }
            }

            // Handle Delete All Selected button click
            $('#deleteAllSelectedRecord').on('click', function() {
                var selectedIds = [];
                $('.checkbox_ids:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    // You can now send the selectedIds to your server for deletion
                    // Implement the server-side logic to delete the selected records
                    // Example AJAX request:
                    /*
                    $.ajax({
                        url: '{{ route('delete.all.candidate') }}',
                        type: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function(response) {
                            // Handle success response
                            // Optionally, you can reload the page or update the table after deletion
                        },
                        error: function(error) {
                            // Handle error response
                        }
                    });
                    */
                }
            });
        });
    </script> --}}


    {{-- <script>
        $(document).ready(function() {
            // Handle Delete All Selected button click
            $('#deleteAllSelectedRecord').on('click', function() {
                var selectedIds = [];
                $('.checkbox_ids:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    // Send a POST request to delete the selected records
                    $.ajax({
                        url: '{{ route('delete.all.candidate') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // Add CSRF token if required
                            ids: selectedIds
                        },
                        success: function(response) {
                            // Handle success response
                            // Optionally, you can reload the page or update the table after deletion
                            alert('Selected records deleted successfully.');
                        },
                        error: function(error) {
                            // Handle error response
                            alert('An error occurred while deleting records.');
                        }
                    });
                }
            });
        });
    </script> --}}
@endsection
