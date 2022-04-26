@extends('dashboard.base')
@section('content')
	<div class="container">
		<h4>Welcome, {{ auth()->user()->name }}... </h4>
		<div class="fade-in">
			<div class="row">
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-primary h-75">
						<div class="card-body pb-0 h-100">
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
							<div class="text-value-lg">Session / No Classes Allocated</div>
							<div>
								@foreach ($courses as $course)
									{{ $course->first()->session }}- {{ $course->count() }} <br>
								@endforeach
							</div>
						</div>
						<div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
							<canvas class="chart" id="card-chart1" height="70"></canvas>
						</div>
					</div>
				</div>
				<!-- /.col-->
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-info h-75">
						<div class="card-body pb-0">
							<button class="btn btn-transparent p-0 float-right" type="button">
								<svg class="c-icon">
									<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-location-pin"></use>
								</svg>
							</button>
							<div class="text-value-lg">Programme(s )</div>
							<div>{{ $classAllocations->groupBy('prog_id')->count() }}</div>
						</div>
						<div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
							<canvas class="chart" id="card-chart2" height="70"></canvas>
						</div>
					</div>
				</div>
				<!-- /.col-->
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-warning  h-75">
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
							<div class="text-value-lg">Department(s)</div>
							<div>{{ $classAllocations->groupBy('dept_id')->count() }}</div>
						</div>
						<div class="c-chart-wrapper mt-3" style="height:70px;">
							<canvas class="chart" id="card-chart3" height="70"></canvas>
						</div>
					</div>
				</div>
				<!-- /.col-->
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-danger h-75">
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
							<div class="text-value-lg">No of Students</div>
							<div>To be Computed</div>
						</div>
						<div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
							<canvas class="chart" id="card-chart4" height="70"></canvas>
						</div>
					</div>
				</div>
				<!-- /.col-->
			</div>
			<div class="row">
				<table class="table table-striped-table-bordered">
					<tr>
						<th colspan="8" class="text-center">List and details of classes that have been allocated to you...</th>
					</tr>
					<tr>
						<th>S/N</th>
						<th>Session</th>
						<th>Semester</th>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Credit Units</th>
						<th>Programme</th>
						<th>Department</th>
					</tr>
					@foreach ($classAllocations as $ca)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $ca->session }}</td>

							<td>{{ $ca->semester }}</td>
							<td>{{ $ca->courseRel->COURSE_CODE }}</td>
							<td>{{ $ca->courseRel->COURSE_NAME }}</td>
							<td>{{ $ca->courseRel->CREDIT_UNITS }}</td>
							<td>{{ $ca->progRel->PROGRAMME }}</td>
							<td>{{ $ca->deptRel->DEPARTMENT }}</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection
