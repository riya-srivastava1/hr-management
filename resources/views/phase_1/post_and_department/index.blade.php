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
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active">Post and Department</li>
        </ol>
        <!-- End breadcrumb start-->

        <!-- BEGIN page-header -->
        <h1 class="page-header">Post and Department </h1>
        <!-- END page-header -->
        <!-- BEGIN panel -->
        <div class="panel panel-inverse">

            <!-- BEGIN panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title">Post and Department List</h4>
                <select id="itemsPerPage" onchange="changeItemsPerPage(this)"
                    style="width:100px; padding: 0.4375rem 0.75rem;border-radius: 4px; margin:0 5px;">
                    <option value="10" {{ $itemsPerPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $itemsPerPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="100" {{ $itemsPerPage == 100 ? 'selected' : '' }}>100</option>
                    <!-- Add more options as needed -->
                </select>
                <center>
                    <div class="container">
                        <a href="{{ route('export.post.dep') }}">
                            <button type="submit" style="height:30%;width:120px">
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
                <td><a href={{ route('dep') }} class="btn btn-success">Add</a></td>
            </div>
            <!-- END panel-heading -->
            <!-- BEGIN panel-body -->
            <div class="panel-body">
                <table id="data-table-scroller" class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th class="text-nowrap">No.</th>
                            <th class="text-nowrap">Employee Name</th>
                            <th class="text-nowrap">Post</th>
                            <th class="text-nowrap">Department</th>
                            <th class="text-nowrap">Action</th>

                        </tr>
                    </thead>
                    <tbody id="employe_list" class="position-relative">
                        @php
                            $counter = ($postanddeps->currentPage() - 1) * $postanddeps->perPage() + 1;
                        @endphp
                        @foreach ($postanddeps as $postanddep)
                            <tr>
                                <td width="1%" class="fw-bold text-dark">{{ $counter++ }}</td>
                                <td>{{ $postanddep->getMember->fullname ?? '' }}</td>
                                <td>{{ $postanddep['title'] }}</td>
                                <td>{{ $postanddep['department'] }}</td>
                                <td><a data-toggle="tooltip" rel="tooltip" data-placement="top" title="Edit"
                                        href={{ 'edit2/' . $postanddep['id'] }} class="far fa-edit"></a>
                                    <a data-toggle="tooltip" rel="tooltip" data-placement="top" title="View"
                                        href={{ 'viewdetail2/' . $postanddep['id'] }} style="margin-left: 10px;"
                                        class="far fa-eye"></a>

                                    <a data-toggle="tooltip" rel="tooltip" data-placement="top" title="Delete"
                                        href={{ 'interview/delete2/' . $postanddep['id'] }} input
                                        onclick="return confirm('are u sure?')" style="margin-left: 10px;" type="submit"
                                        value="Delete"class="far fa-trash-alt"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @forelse ($postanddeps as $postanddep)
            @empty
                <!-- Display vector image here -->
                <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="500"
                    width="900">
            @endforelse

            <div class="d-flex justify-content-center">
                {{ $postanddeps->appends(['itemsPerPage' => $itemsPerPage])->links('pagination::bootstrap-4') }}
            </div>

            <style>
                .w-5 {
                    display: none;
                }
            </style>
        </div>
    </div>


    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('post.dep.search') }}',
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
                    url: '{{ route('post.search2') }}',
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
@endsection
