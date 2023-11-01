<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>CRM</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    {{-- dropzone --}}
    {{-- <script src="{{ asset('assets/plugins/dropzone/dist/min/dropzone.min.js') }}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ================== END page-js ================== -->
    <!-- ================== BEGIN page-css ================== -->

    <script src="{{ asset('js/pagination.js') }}"></script>
    <script src="{{ asset('js/tool-tip.js') }}"></script>
    <script src="{{ asset('assets/plugins/d3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/nvd3/build/nv.d3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/gritter/js/jquery.gritter.js') }}"></script>


    <!-- ================== BEGIN core-css ================== -->
    <link href="{{ asset('assets/plugins/nvd3/build/nv.d3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('assets/plugins/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" /> --}}

    <!-- ================== END core-css ================== -->
    <!--===================  toaster css and js ================== -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <!--===================  Optional Theme for buttons ================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!--===================  END Optional Theme for buttons ================== -->

    <link href="../assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables.net-scroller-bs5/css/scroller.bootstrap5.min.css" rel="stylesheet" />


    <!--===================  end  toaster css and js ================== -->
    <script>
        function text(y) {
            if (y == 0) {
                document.getElementById("mycode").style.display = "flex";
                document.getElementById("mycode1").style.display = "flex";
            }
            if (y == 1) {
                document.getElementById("mycode").style.display = "none";
                document.getElementById("mycode1").style.display = "none";
                document.getElementById("mcode").value = '';
                document.getElementById("mcode1").value = '';
            }
            return;
        }
    </script>
</head>

<body id="bodee" class='pace-top'>
    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->

    <!-- BEGIN #app -->
    <div id="app" class="app app-header-fixed app-sidebar-fixed">



        <!-- BEGIN #header -->
        @include('layouts.includes.header')
        <!-- END #header -->

        {{-- !!Side Bar --}}
        @include('layouts.includes.sidebar')
        @yield('content')

        {{-- Side Bar --}}
        <!-- BEGIN #content -->
        <div id="content" class="app-content">
            @yield('main')
            <!-- BEGIN scroll to top btn -->
            <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top"
                data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
            <!-- END scroll to top btn -->
        </div>
        <!-- END #app -->
    </div>

    <!-- END #sidebar -->


    <script type="text/javascript">
        $(document).on("click", ".delete", function() {

            var r = confirm("Are you Sure ? Want To Delete");
            if (r == true) {
                var url = $(this).attr('id');
                var token = $(this).data("token");
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: "JSON",
                    data: {
                        "_method": 'DELETE',
                        "_token": token,
                    },
                    success: function(response) {

                        toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            },
                            toastr.success('' + response.success + '');
                        setTimeout(function() {
                            location.reload();
                        }, 4020);

                    }

                });
            }

        });
    </script>
    </div>
    <!-- END #app -->

    <!-- ================== BEGIN core-js ================== -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- ================== END core-js ================== -->
    <!-- ================== BEGIN page-js ================== -->
    <script src="{{ asset('assets/plugins/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/@highlightjs/cdn-assets/highlight.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/render.highlight.js') }}"></script>
    <!-- ================== END page-js ================== --->

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    <style>
        .form-group.search {
            position: relative;
        }

        .form-group.search button {
            position: absolute;
            right: 0;
            top: 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script src="../assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="../assets/plugins/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../assets/plugins/datatables.net-scroller-bs5/js/scroller.bootstrap5.min.js"></script>

    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>


</body>

</html>
