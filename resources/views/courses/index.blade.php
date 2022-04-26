@extends('dashboard.base')
@section('content')
	<div class="container card">
		<div class="row">
			<h3>List of Courses in the Department Grouped by Programmes</h3>
		</div>
		<div class="row">
			<table class="table table-striped table-bordered">
				@foreach ($deptCourses->groupBy('PROG_ID') as $progCourses)
					<tr>
						<th colspan="8" class="text-center">
							{{ $progCourses->first()->programme->PROGRAMME . ' - ' . $progCourses->first()->programme->PROG_TYPE }}</th>
					</tr>
					<tr>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Credit Units</th>
						<th>Level</th>
						<th>Semester</th>
						<th>Programme</th>
						<th>Programme Types</th>
						<th>Edit</th>

					</tr>
					@foreach ($progCourses->sortBy(['LEVEL', 'SEMESTER']) as $course)
						<tr>
							<td>{{ $course->COURSE_CODE }}</td>
							<td>{{ $course->COURSE_NAME }}</td>
							<td>{{ $course->CREDIT_UNITS }}</td>
							<td>{{ $course->LEVEL }}</td>
							<td>{{ $course->SEMESTER }}</td>
							<td>{{ $course->programme->PROGRAMME }}</td>
							<td>{{ $course->programme->PROG_TYPE }}</td>
							<td> <a href="/courses/{{ $course->COURSE_ID }}/edit" class="btn btn-success"> Edit</a></td>

						</tr>
					@endforeach
				@endforeach
			</table>
		</div>
	</div>
@endsection
