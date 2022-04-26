@extends('dashboard.base')
@section('content')
	<script src="{{ asset('js/rps/studentList.js') }}" defer type="text/javascript"></script>
	<div class="container ">
		@include('partials.messages')
		<form action="/capturePracticalsScores" method="POST" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="type" id="type" value="practicals">
			<div class="card-header">
				<h1>Upload Practical Scores for this semester</h1>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for="progType"><b>Programme Type (Step1)</b></label>
					<select onChange="getDept()" required id="programme_type" name="programme_type" class="form-control form-control-sm">
						<option value="">select programme Type</option>
						<option value="regular">Regular</option>
						<option value="evening">Evening</option>
						<option value="partTime">Part Time</option>
					</select>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=><b>Dept (Step 2)</b></label>
					<select onchange="getProgramme()" id="dept_id" name="dept_id" class="form-control form-control-sm ">
						<option value=>Select Department</option>
					</select>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-12">

					<label for=""><b>Programme (Step 3)</b></label>

					<select onchange="getSession()" class=" custom-select-sm custom-select" name="prog_id" id="prog_id">
						<option value="">select Programme</option>
					</select>
				</div>

			</div>
			<div class="row">

				<div class="col-lg-4 col-md-6 col-sm-12">

					<label for=""><b>Session (Step 4)</b></label>

					<select onchange="getSemester()" class=" custom-select-sm custom-select" name="session" id="session">
						<option value="">select session</option>
					</select>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=""><b>Semester (Step 5)</b></label>
					<select onchange="getCourses()" class="custom-select custom-select-sm" name="semester" id="semester">
						<option value="1">Select Semester</option>
					</select>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">

					<label for="" class="text-capitalize text-bold "><b>Course Code</b></label>
					<select id="course_id" class="practical form-control form-control-sm" name="course_id">
						<option>Course</option>
					</select>
				</div>

			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">

					<label for=""><b>Practical No</b></label>
					<select class=" custom-select custom-select-sm" name="practicalNo" id="practicalNo">
					</select>

				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 pt-4">
					<div class="custom-file">
						<label for="file" class=" custom-file-label">Select Excel Scores
							file</label>
						<input id="scoresFile" type="file" required name="scoresFile" class=" mt-3 form-control custom-file-input">
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="btn-group my-4">
						<button type="submit" class="btn btn-success ">Upload Data</button>
						<button class="btn btn-danger">Cancel</button>
						<button class="btn btn-secondary">Reset</button>
					</div>
				</div>
			</div>
	</div>

	</form>
	</div>
@endsection
