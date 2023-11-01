@extends('layouts.main')

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            @if (Auth::user()->role == '1')
                <div class="col-xl-14">
                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Add Leave Request</h4>
                        </div>
                        <!-- END panel-heading -->
                        <!-- BEGIN panel-body -->
                        <div class="panel-body">
                            <form action="{{ route('holiday.store') }}" method="POST" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="form-group row mb-3">
                                    <div class="col-lg-3">
                                        <label class="col-form-label form-label" for="holiday_date">Date <font
                                                color="red">*<br></font></label>
                                        <input class="form-control" type="date" id="holiday_date" name="holiday_date"
                                            value="{{ old('holiday_date') }}" placeholder="Enter Start Date" />
                                        <span style="color: red">
                                            @error('holiday_date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-form-label form-label" for="holiday_name">Holiday Name <font
                                                color="red">*<br></font></label>
                                        <input class="form-control" type="text" id="holiday_name" name="holiday_name"
                                            value="{{ old('holiday_name') }}" placeholder="Enter Holiday Name">
                                        <span style="color: red">
                                            @error('holiday_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-lg-3">
                                        <label class="form-group col"></label>
                                        <div class="col-form-label form-label mt-2">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- END panel-body -->
                    </div>
                    <!-- END panel -->
                </div>
            @endif
            <div class="col-xl-14">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Holiday List</h4>
                    </div>
                    <!-- END panel-heading -->
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <table id="data-table-default" class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">No.</th>
                                    <th class="text-nowrap">Date</th>
                                    <th class="text-nowrap">Name</th>
                                    <th class="text-nowrap">Day</th>
                                    @if (Auth::user()->role == '1')
                                        <th class="text-nowrap">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="data-table-default" class="position-relative">
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($holidays as $holiday)
                                    @php
                                        $date = $holiday->holiday_date; // Replace with your date
                                        $carbonDate = \carbon\Carbon::parse($date);
                                        $dayOfWeek = $carbonDate->dayOfWeek;
                                    @endphp
                                    <tr>
                                        <td width="1%" class="fw-bold text-dark">{{ $counter++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($holiday['holiday_date'])) }}</td>
                                        <td>{{ $holiday['holiday_name'] }}</td>
                                        <td>{{ $carbonDate->englishDayOfWeek }}</td>
                                        @if (Auth::user()->role == '1')
                                            <td class="with-btn">
                                                <div class="d-flex align-items-center">
                                                    <!-- Edit Button -->
                                                    <a data-toggle="tooltip" rel="tooltip" data-placement="top"
                                                        title="Edit" href="{{ route('holiday.edit', $holiday->id) }}"
                                                        class="far fa-edit" style="color: blue; text-decoration: none;"></a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('holiday.destroy', $holiday->id) }}"
                                                        method="POST" style="display: inline-block; margin-right: 6px;">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button data-toggle="tooltip" rel="tooltip" data-placement="top"
                                                            title="Delete" class="far fa-trash-alt"
                                                            style="color: blue;background: none; border: none; padding: 5; cursor: pointer;"
                                                            onclick="return confirm('Are you sure you want to delete this field?');"
                                                            type="submit"></button>

                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END panel-body -->
                </div>
                <!-- END panel -->
            </div>
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->
@endsection
