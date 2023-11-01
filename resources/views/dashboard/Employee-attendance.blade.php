@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
    	<!-- ================== BEGIN core-js ================== -->
	<script src="../assets/js/vendor.min.js"></script>
	<script src="../assets/js/app.min.js"></script>
	<!-- ================== END core-js ================== -->


	<!-- ================== BEGIN page-js ================== -->
	<script src="../assets/plugins/nvd3/build/nv.d3.min.js"></script>
	<script src="../assets/js/demo/dashboard-v2.js"></script>
	<!-- ================== END page-js ================== -->


    {{-- Chart --}}


    @if (Auth::user()->role == '2')
        <!-- BEGIN #content -->
		<div id="content" class="app-content">

			<!-- BEGIN row -->
			<div class="row">


			</div>
			<!-- END row -->
			<!-- BEGIN row -->
			<div class="row">
				<!-- BEGIN col-8 -->
				<div class="col-xl-8">
					<div class="widget-chart with-sidebar inverse-mode">

						<div class="widget-chart-sidebar bg-gray-900">
							<div class="chart-number">
								1,225,729
								<small>Total visitors</small>
							</div>
							<div class="flex-grow-1 d-flex align-items-center">
								<div id="visitors-donut-chart" class="dark-mode" style="height: 180px" ></div>
							</div>
							<ul class="chart-legend fs-11px">
								<li><i class="fa fa-circle fa-fw text-blue fs-9px me-5px t-minus-1"></i> 34.0% <span>New Visitors</span></li>
								<li><i class="fa fa-circle fa-fw text-teal fs-9px me-5px t-minus-1"></i> 56.0% <span>Return Visitors</span></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- END col-8 -->

			</div>
			<!-- END row -->

		</div>
		<!-- END #content -->
        {{-- @include('layouts.main') --}}
    @endif
    {{-- end chart --}}



    {{-- chart 2 --}}





    {{-- !!chart 2 --}}



@endsection
