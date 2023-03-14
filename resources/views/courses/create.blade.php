@extends('dashboard.base')
@section('content')
	<form action="/courses" method="POST">
		@csrf
		<style>
			label {
				font-weight: bolder !important;
			}
		</style>
		<div class="container card p-3 m-3">
			@include('partials.messages')
			<div class="row ml-2">
				<h2>Add New Course</h2>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">Programme</label>
					<select name="PROG_ID" id="prog_id" class="form-control">
						@foreach ($progs as $p)
							<option value="{{ $p->PROG_ID }}">{{ $p->PROGRAMME . '-' . $p->PROG_TYPE }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">Course Code</label>
					<input name="COURSE_CODE" type="text" class="form-control">
				</div>
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">Credit Units </label>
					<input name="CREDIT_UNITS" type="number" class="form-control">
				</div>
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">Course Name</label>
					<input name="COURSE_NAME" type="text" class="form-control">

				</div>
				<div class="col-lg-4 col-sm-12 col-md-6">
					<label for="">LEVEL</label>
					<select name="LEVEL" class="form-control">
						<option value="100">ND I</option>
						<option value="200">ND II</option>
						<option value="300">HND I</option>
						<option value="400">HND II</option>
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
			<div class="col-lg-4 col-sm-12 col-md-6 pt-4">
				<button class="btn btn-success mt-1">Add Course</button>
			</div>


		</div>
	</form>
@endsection
