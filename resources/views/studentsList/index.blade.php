@extends('dashboard.base')
@section('content')
	<script src="{{ asset('/js/rps/studentList.js') }}" defer type="text/javascript"></script>
	<div class="container-fluid card-header">
		@include('partials.messages')
		<div class="row">
		</div>
		<div class="card">
			<div class="card-header">
				<h3><strong>Download/Export </strong>Student List</h3>
			</div>
			<div class="card-body">
				<form action="{{ route('downloadStudentsList') }}" method="POST">
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
									<select class="form-control" id="prog_id" name="prog_id" onchange="getSession()">
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-md-6 col-sm-12">
								<label for=><b>Session</b></label>
								<select name="session" id="session" class="form-control form-control-sm MB-2" onchange="getSemester()">
								</select>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<label for=><b>Semester</b></label>
								<select name="semester" id="semester" class="form-control form-control-sm MB-2" onchange="getCourses()">
								</select>

							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="mx-1" for="exampleInputEmail2"><b>Course</b></label>
									<select class="form-control form-control-sm" id="course_id" name="course_id">
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="form-group">
									<label for=""><b>Test, Assignment and Exams Practical</b></label>
									<select onchange="getSemester()" id="listType" class="custom-select-sm custom-select" name="listType" id="">
										<option value="practical">For Practical</option>
										<option value="normal" selected>For Test, Assignment and Examinations</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12 pt-4">
								<button class="btn btn-success" type="submit">Download List</button>
								<button class="btn btn-warning" type="reset">Clear </button>
							</div>
						</div>
					</div>
				</form>
			</div>

		</div>
	@endsection
