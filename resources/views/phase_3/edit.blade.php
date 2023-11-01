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
            <!-- BEGIN breadcrumb -->
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="/viewdetail">Home</a></li>
                <li class="breadcrumb-item active"><a href="/phase3">Interview Phase 3</a></li>
                <li class="breadcrumb-item active"> Edit Phase 3 detail</li>
            </ol>
            <!-- END breadcrumb -->
            <!-- BEGIN pagel-heading -->
            <h1 class="panel-title">Interview Phase 3</h1>
            <!-- END page-heading -->
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="col-xl-14">
                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Interview Phase 3</h4>
                            <td><a href={{ route('phase3') }} class="btn btn-primary">List</a></td>
                        </div>
                        <!-- END panel-heading -->
                        <!-- BEGIN panel-body -->
                        <div class="panel-body">
                            <form action="{{ route('update2', $data['id']) }}" method="POST">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="fullname">Candidate Name :
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="col-lg-4 col-form-label form-label"
                                            for="fullname">{{ $data->getPhase3->fullname ?? ''}}</label>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" class="form-check-input" for="hrround"
                                        for="hrround">HR Round<font color="red">*<br></font></label>
                                    <div class="col-lg-8">
                                        <input class="form-check-input" type="radio" name="hrround" value="Done"
                                            {{ $data['hrround'] == 'Done' ? 'checked' : '' }}>Done</label>
                                        <input class="form-check-input" type="radio" name="hrround" value="Pending"
                                            {{ $data['hrround'] == 'Pending' ? 'checked' : '' }}>Pending</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" class="form-check-input" for="bgv"
                                        for="radio">Background Verification<font color="red">*<br></font></label>
                                    <div class="col-lg-8">
                                        <input class="form-check-input" type="radio" name="bgv" value="Done"
                                            {{ $data['bgv'] == 'Done' ? 'checked' : '' }}>Done</label>
                                        <input class="form-check-input" type="radio" name="bgv" value="Pending"
                                            {{ $data['bgv'] == 'Pending' ? 'checked' : '' }}>Pending</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" class="form-check-input"
                                        for="radio">Offer Letter<font color="red">*<br></font></label>
                                    <div class="col-lg-8">
                                        <input class="form-check-input" type="radio" name="offerletter" value="Issued"
                                            {{ $data['offerletter'] == 'Issued' ? 'checked' : '' }}>Issued</label>
                                        <input class="form-check-input" type="radio" name="offerletter" value="Not Issued"
                                            {{ $data['offerletter'] == 'Not Issued' ? 'checked' : '' }}>Not Issued</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="message">CTC(As mentioned in the
                                        offer letter)<font color="red">*<br></font></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="number" name="ctc"
                                            placeholder="Enter CTC Here" value="{{ $data['ctc'] }}" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="date">Date of Joining<font
                                            color="red">*<br></font></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="date" name="jdate" placeholder="date"
                                            value="{{ $data['jdate'] }}" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="repomanager">Reporting Manager
                                        <font color="red">*<br></font></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="repomanager"
                                            placeholder="Enter Reporting Manager Name" value="{{ $data['repomanager'] }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                {{-- {{ dd($data) }} --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END row -->
        </div>
    </div>
    <!-- END #app -->
@endsection
