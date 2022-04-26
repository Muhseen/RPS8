@extends('dashboard.base')
@section('content')
	<div class="container">
		<div class="fade-in">
			<div class="row my-2 pl-3">
				<h4 class=" text-center">Department of {{ auth()->user()->staff->department }}</h4>
			</div>
			<div class="row mb-2">
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-primary h-100">
						<div class="card-body pb-0">
							<div class="btn-group float-right">
								<button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
									<svg class="c-icon">
										<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
									</svg>
								</button>

							</div>
							<div class="text-value-lg">{{ $studentCount }}</div>
							<p>
							<h4>Total No of Students</h4>
							</p>
						</div>

					</div>
				</div>
				<!-- /.col-->
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-info h-100">
						<div class="card-body pb-0">
							<button class="btn btn-transparent p-0 float-right" type="button">
								<svg class="c-icon">
									<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-location-pin"></use>
								</svg>
							</button>
							<div class="text-value-lg">{{ $totalCourses }}</div>
							<h4>Total Courses in the Department</h4>
						</div>

					</div>
				</div>
				<!-- /.col-->
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-warning h-100">
						<div class="card-body pb-0">
							<div class="btn-group float-right">
								<button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
									<svg class="c-icon">
										<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
									</svg>
								</button>
								<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a
										class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
								</div>
							</div>
							<div class="text-value-lg">{{ $progCount }}</div>
							<h4>Programmes</h4>
						</div>

					</div>
				</div>
				<!-- /.col-->
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-danger h-100">
						<div class="card-body pb-0">
							<div class="btn-group float-right">
								<button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
									<svg class="c-icon">
										<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
									</svg>
								</button>
								<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a
										class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
								</div>
							</div>
							<div class="text-value-lg">{{ 0 }}</div>
							<h4>Department's Percentage Pass:To be computed</h4>
						</div>

					</div>
				</div>
				<!-- /.col-->
			</div>

		</div>
		@include('dashboard.shared.recentUploadsTable')
	</div>
@endsection
