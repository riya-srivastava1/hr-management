@extends('layouts.main')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- Begain breadcrumb start-->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
            <li class="breadcrumb-item active">Excel</li>
        </ol>
        <!-- End breadcrumb start-->
        <!-- BEGIN page-header -->

        <h1 class="page-header">Add Candiadate through excel sheet</h1>

        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Excel Sheet</h4>
                        <td><a href={{ route('viewdetail') }} class="btn btn-primary">List</a></td>

                    </div>
                    <!-- END panel-heading -->
                    <br>

                    <!-- BEGIN panel-body -->
                    <div class="panel-body">

                        <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf

                            <div class="form-group row mb-3">
                                <label class="col-lg-4 col-form-label form-label" for="ctc">Add Excel :<font
                                        color="red">*<br></font></label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="excel-file" name="accept_excel_format"
                                        value="{{ old('accept_excel_format') }}" placeholder="Add Excel">
                                    <span style="color: red">
                                        @error('accept_excel_format')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div id="excel-preview">

                                {{-- preview --}}
                            </div>



                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                                <div class="col-lg-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('viewdetail') }}" class="btn btn-danger"> Cancel</a>
                                </div>
                            </div>
                        </form>
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

   <script>
    function handleFileSelect(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            var data = new Uint8Array(e.target.result);
            var workbook = XLSX.read(data, { type: 'array' });
            var sheetName = workbook.SheetNames[0];
            var sheet = workbook.Sheets[sheetName];
            var jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

            // Get the header row
            var headerRow = jsonData[0];

            // Create HTML table for preview
            var table = '<h4 class="bg-primary"> <center> Preview </center></h4>';
            table += '<table class="table">';
            table += '<tr>';
            for (var i = 0; i < headerRow.length; i++) {
                table += '<th>' + headerRow[i] + '</th>';
            }
            table += '</tr>';

            // Skip the header row and display the remaining rows
            for (var j = 1; j < jsonData.length; j++) {
                table += '<tr>';
                for (var k = 0; k < jsonData[j].length; k++) {
                    table += '<td>' + jsonData[j][k] + '</td>';
                }
                table += '</tr>';
            }

            table += '</table>';

            // Add preview table to the specified container
            document.getElementById('excel-preview').innerHTML = table;
        };

        reader.readAsArrayBuffer(file);
    }

    // Attach the file input change event handler
    document.getElementById('excel-file').addEventListener('change', handleFileSelect, false);
</script>


<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>


@endsection
