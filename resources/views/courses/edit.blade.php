@extends('dashboard.base')
@section('content')
	<form action="{{ route('courses.update', $course->COURSE_ID) }}" method="POST">
		@csrf
		@method('PATCH')
		<div class="container card p-3 mx-3">
			<div class="row justify-content-end px-4 pt-3">
				<a href="/courses/create" class="btn btn-success">Add New Course</a>
			</div>
			<div class="row mx-3">
				<h1>Edit Details of {{ $course->COURSE_CODE }} : {{ $course->COURSE_NAME }}</h1>
			</div>
			<hr>
			@include('partials.messages')
			<div class="row">
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">Programme</label>
					<select name="PROG_ID" id="prog_id" class="form-control">
						@foreach ($progs as $p)
							<option value="{{ $p->PROG_ID }}" {{ $p->PROG_ID == $course->PROG_ID ? 'selected' : '' }}>
								{{ $p->PROGRAMME . '-' . $p->PROG_TYPE }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">Course Code</label>
					<input name="COURSE_CODE" value="{{ $course->COURSE_CODE }}" type="text" class="form-control">
				</div>
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">Credit Units Code</label>
					<input name="CREDIT_UNITS" type="number" value="{{ $course->CREDIT_UNITS }}" class="form-control">
				</div>

				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">Course Name</label>
					<input name="COURSE_NAME" type="text" class="form-control" value="{{ $course->COURSE_NAME }}">

				</div>
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">LEVEL</label>
					<select name="LEVEL" class="form-control">
						<option value="100" {{ $course->LEVEL == '100' ? 'selected' : '' }}>ND I</option>
						<option value="200" {{ $course->LEVEL == '200' ? 'selected' : '' }}>ND II</option>
						<option value="300" {{ $course->LEVEL == '300' ? 'selected' : '' }}>HND I</option>
						<option value="400" {{ $course->LEVEL == '400' ? 'selected' : '' }}>HND II</option>
					</select>
				</div>
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">SEMESTER</label>
					<select name="SEMESTER" class="form-control">
						<option value="FIRST">FIRST</option>
						<option value="SECOND">SECOND</option>

					</select>
				</div>
			</div>
			<div class="row">

				<div class="col-lg-4 col-sm-12 col-md-6 pt-4">
					<button class="btn btn-success mt-1">Update Course</button>
				</div>


			</div>
		</div>
	</form>
@endsection
