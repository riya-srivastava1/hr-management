@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/Excel-import-button.css') }}">

    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Interview Phase 3</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">Interview Phase 3</h1>

        <!-- BEGIN panel -->
        <div class="panel panel-inverse">
            <!-- BEGIN panel-heading -->

            <div class="panel-heading">
                <h4 class="panel-title">Interview Details Management</h4>

                <select id="itemsPerPage" onchange="changeItemsPerPage(this)"
                    style="width:100px; padding: 0.4375rem 0.75rem;border-radius: 4px; margin:0 5px;">
                    <option value="10" {{ $itemsPerPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $itemsPerPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="100" {{ $itemsPerPage == 100 ? 'selected' : '' }}>100</option>
                    <!-- Add more options as needed -->
                </select>

                <center>
                    <div class="container">
                        <a href="{{ route('export.phase3') }}">
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
                <div class="panel-heading-btn">
                    <p align="right">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                        <div class="col-lg-6">
                            <a href="{{ route('phase3form') }}">
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
                            <th class="text-nowrap">HR Round</th>
                            <th class="text-nowrap">BGV</th>
                            <th class="text-nowrap">Offer Letter</th>
                            <th class="text-nowrap">CTC</th>
                            <th class="text-nowrap">Date</th>
                            <th class="text-nowrap">Reporting Manager</th>
                            <th class="text-nowrap">Action</th>

                        </tr>
                    </thead>
                    <tbody id='employe_list' class="position-relative">
                        @php
                             $counter = ($phase3s->currentPage() - 1) * $phase3s->perPage() + 1;
                        @endphp
                        @foreach ($phase3s as $phase3)
                            <tr>
                                <td width="1%" class="fw-bold text-dark">{{ $counter++ }}</td>
                                <td>{{ $phase3->getPhase3->fullname ?? '' }}</td>
                                <td>{{ $phase3['hrround'] }}</td>
                                <td>{{ $phase3['bgv'] }}</td>
                                <td>{{ $phase3['offerletter'] }}</td>
                                <td>{{ $phase3['ctc'] }}</td>
                                <td>{{ $phase3['jdate'] }}</td>
                                <td>{{ $phase3['repomanager'] }}</td>
                                <td>{{ $phase3['view'] }} <a data-toggle="tooltip" rel="tooltip" data-placement="top" title="View" href={{ 'view/' . $phase3['id'] }} type="submit"
                                        class="far fa-eye"></a>
                                    {{ $phase3['update'] }} <a data-toggle="tooltip" rel="tooltip" data-placement="top" title="Edit" href={{ 'update2/' . $phase3['id'] }} type="submit"
                                        style="margin-left: 10px;" class="far fa-edit"></a>
                                    {{ $phase3['delete'] }}<a data-toggle="tooltip" rel="tooltip" data-placement="top" title="Delete" href={{ 'delete/' . $phase3['id'] }} type="submit"
                                        style="margin-left: 10px;" class="far fa-trash-alt"
                                        onclick="return confirm('Are you sure you want to delete this field?');"></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>



            </div>

            @forelse ($phase3s as $phase3)
            @empty
                <!-- Display vector image here -->
                <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="500"
                    width="900">
            @endforelse


            <!-- END panel-body -->
            <div class="d-flex justify-content-center">
                <!-- Display the pagination links with the selected number of items per page -->
                {{ $phase3s->appends(['itemsPerPage' => $itemsPerPage])->links('pagination::bootstrap-4') }}
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

    <!-- BEGIN scroll-top-btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i
            class="fa fa-angle-up"></i></a>
    <!-- END scroll-top-btn -->
    </div>
    <!-- END #app -->
    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('search.phase3') }}',
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
                    url: '{{ route('searchPhase3') }}',
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

