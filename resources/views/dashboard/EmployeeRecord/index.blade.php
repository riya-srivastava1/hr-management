@extends('layouts.main')
@section('content')
    {{-- @if (Auth::user()->role == 0) --}}
    <link rel="stylesheet" href="{{ asset('css/Excel-import-button.css') }}">


    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Employee Record</li>
        </ol>
        <!-- END breadcrumb -->
        <h3 class="page-header"> Employee Record</h3>
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->

                <div class="panel panel-inverse" data-sortable-id="table-basic-7">

                    <!-- BEGIN panel-heading -->

                    <div class="panel-heading">
                        <h4 class="panel-title">Employee Record </h4>
                        <select id="itemsPerPage" onchange="changeItemsPerPage(this)"
                            style="width:100px; padding: 0.4375rem 0.75rem;border-radius: 4px; margin:0 5px;">
                            <option value="10" {{ $itemsPerPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $itemsPerPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="100" {{ $itemsPerPage == 100 ? 'selected' : '' }}>100</option>
                            <!-- Add more options as needed -->
                        </select>
                        <center>
                            <div class="container">
                                <a href="{{ route('export.employee.record') }}">
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
                                <input type="text" name="search" id="empsearch" class="form-control"
                                    placeholder="Search Here..">
                            </div>
                        </div>

                        <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary w-60px mb-2">Add</a>
                    </div>
                    <!-- END panel-heading -->
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <!-- BEGIN table-responsive -->
                        <div class="table-responsive mb-3">
                            <table class="table table-panel text-nowrap align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th> No.</th>
                                        <th> Name</th>
                                        <th>Contact Number</th>
                                        <th>Designation</th>
                                        <th> Type</th>
                                        <th>Leave Available</th>
                                        <th> Status</th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody id='emp-list' class="position-relative">
                                    @php
                                        $counter = ($employes->currentPage() - 1) * $employes->perPage() + 1;
                                    @endphp
                                    @foreach ($employes as $employe)
                                        <tr>
                                            <td width="1%" class="fw-bold text-dark">{{ $counter++ }}</td>
                                            <td>{{ $employe->employee_name }}</td>
                                            <td>{{ $employe->contact_no }}</td>
                                            <td>{{ $employe->designation }}</td>
                                            <td>{{ $employe->employment_type }}</td>
                                            <td>{{ isset($employe->total_leaves, $employe->taken_leaves) ? $employe->total_leaves - $employe->taken_leaves : ' ' }}</td>
                                            <td>
                                                @if ($employe->status == 'Active')
                                                    <a href="{{ route('status.employee', ['id' => $employe->id]) }}"
                                                        onclick="return confirm('Are you sure want to Inactive this field?')"
                                                        style="font-size: 20px; color:green; text-decoration: none;"
                                                        class="fas fa-toggle-on">
                                                    </a>
                                                @else
                                                    <a href="{{ route('status.employee', ['id' => $employe->id]) }}"
                                                        onclick="return confirm('Are you sure want to Active this field?')"
                                                        style="font-size: 20px; color:red; text-decoration: none;"
                                                        class="fas fa-toggle-off"></a>
                                                @endif

                                            <td class="with-btn">
                                                <div class="d-flex align-items-center">

                                                    <a data-toggle="tooltip" rel="tooltip" data-placement="top"
                                                        title="Attendance Log"
                                                        href="{{ route('attendance.log', $employe->id) }}"
                                                        class="	far fa-calendar-check"></a>
                                                    <a data-toggle="tooltip" rel="tooltip" data-placement="top"
                                                        title="View" href="{{ route('employee.show', $employe->id) }}"
                                                        style="margin-left: 10px;" class="far fa-eye"></a>
                                                    <a data-toggle="tooltip" rel="tooltip" data-placement="top"
                                                        title="Edit" href="{{ route('employee.edit', $employe->id) }}"
                                                        style="margin-left: 10px;" class="far fa-edit"></a>
                                                    <form action="{{ route('employee.destroy', $employe->id) }}"
                                                        method="POST">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button data-toggle="tooltip" rel="tooltip" data-placement="top"
                                                            title="Delete" class="far fa-trash-alt"
                                                            style="margin-right: 6px; color: blue;"
                                                            onclick="return confirm('Are you sure you want to delete this field?');"
                                                            type="submit"> </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- END table-responsive -->
                    </div>
                    @forelse ($employes as $employe)
                    @empty
                        <!-- Display vector image here -->
                        <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="500"
                            width="900">
                    @endforelse

                    <div class="d-flex justify-content-center">
                        {{ $employes->appends(['itemsPerPage' => $itemsPerPage])->links('pagination::bootstrap-4') }}
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

    <script type="text/javascript">
        $(document).on('keyup', "#empsearch", function() {
            $value = $(this).val();
            if ($value) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('search') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('#emp-list').html(data);
                    }
                });
            } else {
                $.ajax({
                    type: 'get',
                    url: '{{ route('emp.search') }}',
                    success: function(data) {
                        $('#emp-list').html(data);
                    }
                });
            }
        });
    </script>
    {{-- @endif --}}
@endsection
