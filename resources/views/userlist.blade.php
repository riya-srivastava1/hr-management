@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Manager / HR</li>
        </ol>
        <!-- END breadcrumb -->
        <h3 class=" page-header">Manager / HR</h3>
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->

                <div class="panel panel-inverse" data-sortable-id="table-basic-7">

                    <!-- BEGIN panel-heading -->


                    <!-- END panel-heading -->
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <!-- BEGIN table-responsive -->
                        <div class="pb-3">
                            <table class="table table-striped mb-0 align-middle ">
                                <thead>
                                    <tr>

                                        <th> Name</th>
                                        <th>Email </th>
                                        <th>Status</th>
                                        <th>role</th>
                                        <th>Action</th>
                                        <th width="1%"></th>
                                    </tr>
                                </thead>
                                <tbody id='emp-list' class="position-relative">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->status == 'Active')
                                                    <a href="{{ route('user.status', ['id' => $user->id]) }}"
                                                        onclick="return confirm('Inactive?')" class="btn btn-success">Active
                                                    </a>
                                                @else
                                                    <a href="{{ route('user.status', ['id' => $user->id]) }}"
                                                        onclick="return confirm('Active?')"
                                                        class="btn btn-danger">Inactive</a>
                                                @endif
                                            </td>
                                            @if ($user->role == '1')
                                                <td>
                                                    HR
                                                </td>
                                            @elseif ($user->role == '0')
                                                <td>
                                                    TL
                                                </td>
                                            @else
                                                <td>
                                                    Employee
                                                </td>
                                            @endif
                                           <td> <a data-toggle="tooltip" rel="tooltip" data-placement="top"
                                            title="Edit" href="{{ route('users.edit', $user->id) }}"
                                            style="margin-left: 10px;" class="far fa-edit"></a></td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- END table-responsive -->
                    </div>
                    <!-- END panel-body -->
                </div>
                @forelse ($users as $user)
                @empty
                    <!-- Display vector image here -->
                    <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="500"
                        width="900">
                @endforelse
                <!-- END panel -->
            </div>
            <!-- END col-6 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->
@endsection
