@extends('dashboard.base')
@section('content')
	<script src="{{ asset('js/rps/studentList.js') }}" defer type="text/javascript"></script>
	<div class="container-fluid card-header">
		@include('partials.messages')
		<div class="row">
		</div>
		<div class="card">
			<div class="card-header">
				<h3><strong>Upload Scores</strong> for {{ $scoreType ?? 'First C.A' }}</h3>
			</div>
			<div class="card-body">
				<form action="/uploadScores" method="POST" enctype="multipart/form-data">
					@csrf

					<div class="container">
						<div class="row">
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="mr-1" for="exampleInputName2"><b>Programme Type</b></label>
									<select class="form-control" onchange="getDept()" id="programme_type" name="programme_type">
										<option value="">Select Programme Type</option>
										<option value="regular">Regular</option>
										<option value="evening">Evening</option>
									</select>

								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="mx-1" for="exampleInputEmail2"><b>Department</b></label>
									<select class="form-control" id="dept_id" onchange="getProgramme()" name="dept_id">
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="mx-1" for="exampleInputEmail2"><b>Programme</b></label>
									<select class="form-control" id="prog_id" onchange="getSession()" name="prog_id">
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-md-6 col-sm-12">
								<label for=><b>Session</b></label>
								<select name="session" id="session" onchange="getSemester()" class="form-control  mb-2">
								</select>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<label for=><b>Semester</b></label>
								<select name="semester" id="semester" onchange="getCourses()    " class="form-control mb-2">
								</select>

							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="mx-1" for="exampleInputEmail2"><b>Course</b></label>
									<select class="form-control" id="course_id" name="course_id">
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="form-group">
									<label for=""><b>Test, Assignment and Exams Practical</b></label>
									<input type="file" placeholder="Select Scores Excelsheet" class="form-control" required name="scoresFile">
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12 pt-4">
								<button class="btn btn-success" type="submit">Upload Scores</button>
								<button class="btn btn-warning" type="reset">Clear </button>
							</div>
						</div>
					</div>
					<input type="hidden" value="{{ $scoreType }}" name="type" id="type">
				</form>
			</div>

		</div>
	@endsection
