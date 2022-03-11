@extends('dashboard.base')
@section('content')
	<div class="container">
		@include('partials.messages')
		<a href="{{ route('classAllocation.create') }}" class="btn btn-dark btn-lg float-right">Add New Entry</a>
		<h2>
			<caption> Class Allocations</caption>
		</h2>
		<table class="table table-striped  table-bordered table-hover ">
			<thead>
				<tr>
					<th>Staff No</th>
					<th>Staff Name</th>
					<th>Course</th>
					<th>Dept</th>
					<th>Programme Type</th>
					<th>Programme</th>
					<th>Edit </td>
					<th>Deelete</th>
				</tr>

			</thead>
			<tbody>
				@foreach ($allocations as $allocation)
					<tr>
						<td>{{ $allocation->file_no }}</td>
						<td>{{ $allocation->staff_name }}</td>
						<td>{{ $allocation->courseRel->COURSE_CODE }} : {{ $allocation->courseRel->COURSE_NAME }}</td>
						<td>{{ $allocation->deptRel->DEPARTMENT }}</td>
						<td>{{ $allocation->progRel->PROG_TYPE }}</td>
						<td>{{ $allocation->progRel->PROGRAMME }}</td>
						<td><a class="btn btn-primary" href="/allocateClass/{{ $allocation->id }}/edit"><span
									class=" glyphicon glyphicon-edit">Edit</span></a></td>
						<td>
							<form action="/allocateClass/{{ $allocation->id }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Delete</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection
