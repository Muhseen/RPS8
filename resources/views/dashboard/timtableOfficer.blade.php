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
							<div class="text-value-lg"></div>
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
				<table class="table table-striped bordered">
					<tr>
						<th colspan="6"> Class Allocations</th>
					</tr>
					<tr>
						<th>Course Code and Title</th>
						<th> Lecturer</th>
						<th>Can Upload Exam Scores</th>
						<th>Programme</th>
						<th>Department</th>
						<th>Allocated Since</th>
					</tr>
					<tbody>
						@foreach ($classAllocations as $ca)
							<tr>
								<td>{{ $ca->courseRel->COURSE_CODE . '-' . $ca->courseRel->COURSE_NAME }}</td>
								<td>{{ $ca->file_no . '-' . $ca->staff_name }}</td>
								<td>{{ $ca->isLeadLec ? 'Yes' : 'No' }}</td>
								<td>{{ $ca->progRel->PROGRAMME }}</td>
								<td>{{ $ca->deptRel->DEPARTMENT }}</td>
								<td>{{ $ca->created_at->diffForHumans() }}</td>
							</tr>
						@endforeach

					</tbody>
					<tr>
						<td colspan="6">{{ $classAllocations->links() }}</td>
					</tr>
				</table>

			</div>

		</div>
	</div>
@endsection
