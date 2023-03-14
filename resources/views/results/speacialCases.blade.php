@extends('dashboard.base')
@section('content')
	<div class="container card p-3">
		@include('partials.messages')
		<script defer src="{{ asset('js/rps/specialCases.js') }} " type="text/javascript"></script>
		<style>
			label {
				font-weight: bold !important;
			}
		</style>
		<div class="row ml-2">
			<h2>Capture Grades for special cases like Paper Cancellation,Absent with Excuse ...etc</h2>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group"><label for="">
						Record is for
					</label>
					<select id="target" name="target" class="form-control" value="{{ old('target') }}">
						<option value="">Select Entry Target type</option>
						<option value="student">Particular Student</option>
						<option value="class">Entire Course(All Students that have registered this course)</option>
					</select>
				</div>
			</div>

		</div>
		<div class="d-none" id="entireCourseDiv">
			<form action="/classSpecialCase" method="POST">
				@csrf
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-12">
						<label for="">Select Programme
						</label>
						<select name="prog_id" id="prog_id" class="form-control" value="{{ old('prog_id') }}">
							@foreach ($progs as $p)
								<option value="{{ $p->PROG_ID }}">{{ $p->PROGRAMME . '-' . $p->PROG_TYPE }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<label for="">
							Select Course
						</label>
						<select name="course_id" id="class_course_id" value="{{ old('course_id') }}" class="form-control">

						</select>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<label for="">Grade</label>
						<select name="grade" id="grade" class="form-control" value="{{ old('grade') }}">
							<option value="">Select Grade</option>
							<option value="-100">Absent With Excuse</option>
							<option value="-150">Paper Cancelled</option>
							<option value="-200">Absent Without Excuse</option>
							<option value="-250">Paper not taken, Attendance Fall short</option>
							<option value="-300">Option Courses not taken</option>
							<option value="-400">Examination Malpractice</option>
							<option value="-500">Course Not Registered</option>
							<option value="-600">Sick(Cleared by Academic board)</option>
							<option value="-700">Course in Progress</option>
							<option value="-800">Project Incomplete</option>
							<option value="-900">Siwes Incomplete</option>
							<option value="-950">Not Required to register</option>
							<option value="-970">Deferred Course</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-12">
						<label for="">Sessions
						</label>
						<select name="session" id="session" class="form-control" value="{{ old('session') }}">
							<option value="2021/2022">2021/2022</option>
							<option value="2022/2023">2022/2023</option>
							<option value="2023/2024">2023/2024</option>
						</select>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-12  ">
						<button class="btn btn-success mt-4" type="submit">Process Case</button>
					</div>
				</div>
			</form>

		</div>
		<div class="d-none" id="particularStudent">
			<form action="/studentSpecialCase" method="POST">
				@csrf
				<div class="row">
					<div class="col-lg-3 col-sm-6 col-sm-12">
						<label for="">Registration Number</label>
						<input placeholder="Enter Student Registration number here" name="reg_number" id="reg_number" type="text"
							class="form-control">
					</div>
					<div class="col-lg-2 col-md-6 col-sm-12 mt-4">
						<button class=" btn btn-success" id="fetchDetails" type="button">Fetch Details</button>
					</div>

				</div>
				<div class="row my-3 pl-3">
					<div class="col-lg-6 col-md-6 col-sm-12">
						<strong><span id="deets">

							</span>
						</strong>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-12">
						<label for="">Grade</label>
						<select name="grade" id="grade" class="form-control">
							<option value="">Select Grade</option>
							<option value="-100">Absent With Excuse</option>
							<option value="-150">Paper Cancelled</option>
							<option value="-200">Absent Without Excuse</option>
							<option value="-250">Paper not taken, Attendance Fall short</option>
							<option value="-300">Option Courses not taken</option>
							<option value="-400">Examination Malpractice</option>
							<option value="-500">Course Not Registered</option>
							<option value="-600">Sick(Cleared by Academic board)</option>
							<option value="-700">Course in Progress</option>
							<option value="-800">Project Incomplete</option>
							<option value="-900">Siwes Incomplete</option>
							<option value="-950">Not Required to register</option>
							<option value="-970">Deferred Course</option>
						</select>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<label for="">Course</label>
						<select name="course_id" id="student_course_id" class="form-control">

						</select>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<label for="">Session
						</label>
						<select name="session" id="session" class="form-control" value="{{ old('session') }}">
							<option value="2021/2022">2021/2022</option>
							<option value="2022/2023">2022/2023</option>
							<option value="2023/2024">2023/2024</option>
						</select>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-12 mt-3">
						<button class="btn btn-success" type="submit">Process Case</button>
					</div>
				</div>
			</form>
		</div>

	</div>
@endsection
