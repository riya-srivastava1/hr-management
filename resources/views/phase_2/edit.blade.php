@extends('layouts.main')
@section('content')
    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->

    <!-- BEGIN #app -->
    <div id="app" class="app app-header-fixed app-sidebar-fixed">



        <!-- BEGIN #content -->
        <div id="content" class="app-content">
            <!-- Begain breadcrumb start-->
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="{{ ('dashboard') }}">Home </a></li>
                <li class="breadcrumb-item active"><a href="{{ route('templist') }}">Interview Phase 2</a></li>
                <li class="breadcrumb-item active">Edit Interview Detail</li>
            </ol>
            <!-- End breadcrumb start-->

            <!-- BEGIN page-heading -->
            <h1 class="page-title">Edit Interview Detail</h1>
            <!-- END page-heading -->
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="col-xl-12">
                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Edit Details</h4>
                            <td><a href={{ route('templist') }} class="btn btn-primary">List</a></td>
                        </div>
                        <!-- END panel-heading -->

                        <!-- BEGIN panel-body -->
                        <div class="panel-body">
                            <form action="{{ route('update1', $data['id']) }}" method="POST" name="demo-form">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="fullname">Candidate Name :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="fullname">{{ $data->showI->fullname ?? ''}}</label>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label">Interview Mode : </label>
                                    <div class="col-lg-8">

                                        <select name="intmode" class="form-select">
                                            <option value="{{ $data['intmode'] }}">{{ $data['intmode'] }}</option>
                                            <option value="Virtual">Virtual</option>
                                            <option value="Face-To-Face">Face-To-Face</option>
                                            <option value="Telephonic">Telephonic</option>
                                        </select>
                                        <span style="color:red">
                                            @error('intmode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label">Interview Type :</label>
                                    <div class="col-lg-8">
                                        <select name="inttype" class="form-select">
                                            <option value="{{ $data['inttype'] }}">{{ $data['inttype'] }}</option>
                                            <option value="Behavioral">Technical</option>
                                            <option value="Telephonic">Non-Technical</option>
                                        </select>
                                        <span style="color:red">
                                            @error('inttype')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="date">Interview Date
                                        :</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="date" id="website" name="date"
                                            placeholder="Required" value="{{ $data['date'] }}" />
                                        <span style="color:red">
                                            @error('date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label">Interviewer's Name :</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text"
                                            name="intname"placeholder="Enter Interviewer Name Here"
                                            value="{{ $data['intname'] }}" />
                                        <span style="color:red">
                                            @error('intname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label">Interview Status<font color="red">
                                            *<br></font></label>
                                    <div class="col-lg-8">
                                        <select name="intstatus"class="form-select">
                                            <option value="{{ $data['intstatus'] }}">{{ $data['intstatus'] }}</option>
                                            <option value="Selected">Selected</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Hold">Hold</option>
                                        </select>
                                    </div>
                                    <span style="color:red">
                                        @error('intstatus')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label">Reschedule<font color="red">*<br>
                                        </font></label>
                                    <div class="col-lg-8">
                                        <input type="radio" name="reschedule" value="Yes" onclick="text(0) "{{ ($data['reschedule']=="Yes")? "checked" : "" }}
                                            value="{{ $data['reschedule'] }}" />Yes
                                        <input type="radio" name="reschedule" value="No" onclick="text(1)"{{ ($data['reschedule']=="No")? "checked" : "" }}
                                            value="{{ $data['reschedule'] }}" />No
                                    </div>
                                </div>
                                <div  id="mycode" class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="rdate">Rescheduled Date and
                                        Time</label>
                                    <div class="col-lg-8">
                                        <input id="mcode" class="form-control" type="datetime-local" name="rdate"
                                            value="{{ $data['rdate'] }}" />
                                    </div>
                                </div>
                                <div  id="mycode1" class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="month">Interview Link
                                    </label>
                                    <div class="col-lg-8">
                                        <input id="mcode1" class="form-control" type="text" name="intlink"
                                            placeholder="Enter Interview Link" value="{{ $data['intlink'] }}" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="feedback">Feedback From
                                        Interviwer<font color="red">*<br></font> </label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" type="message" name="feedback" placeholder="Feedback From Interviwer"
                                            value="">{{ $data['feedback'] }}</textarea>
                                        <span style="color:red">
                                            @error('feedback')
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
                        <!-- END panel-body -->

                    </div>
                    <!-- END panel -->
                </div>
                <!-- END col-6 -->
                <!-- BEGIN col-6 -->
                <div class="col-xl-6">
                    <!-- BEGIN panel -->

                    <!-- END panel -->
                </div>
                <!-- END col-6 -->
            </div>
            <!-- END row -->
        </div>
        <!-- END #content -->

        <!-- BEGIN theme-panel -->

        <!-- END theme-panel -->
        <!-- BEGIN scroll-top-btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top"
            data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
        <!-- END scroll-top-btn -->
    </div>
    <!-- END #app -->

@endsection
