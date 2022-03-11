@extends('dashboard.base')
@section('content')
	<script defer src="{{ asset('js/rps/classAllocation.js') }} " type="text/javascript"></script>
	<div class="container">
		@include('partials.messages')
		<form action="/classAllocation" method="POST">
			@csrf
			<div class="row">
				<div class="col-lg-4 col-sm-12">
					<div class="form-group-sm">
						<label for="file_no"><b>Staff Number</b></label>
						<input type="text" onkeyup="getName()" id="file_no" name="file_no" class="form-control">
					</div>

				</div>
				<div class="col-lg-8 col-sm-12">
					<div class="form-group-sm">
						<label for="staffName" class="control-label"><b>Staff Name</b></label>
						<input type="text" id="staffName" name="staff_name" class="form-control" disbaled>
					</div>

				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=><b>Programme Type</b></label>
					<select name="programme_type" id="programme_type" required class="form-control form-control-sm MB-2">
						<option value="">Select Programme Type</option>
						<option value="regular">Regular</option>
						<option value="evening">Evening</option>
					</select>

				</div>

				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=><b>Programme</b></label>
					<select name="prog_id" id="prog_id" class="form-control form-control-sm MB-2">
					</select>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=><b>Level</b></label>
					<select name="level" class="form-control form-control-sm MB-2">
						<option value="100">ND I</option>
						<option value="200">ND II</option>
						<option value="300">HND I</option>
						<option value="400">HND II</option>
					</select>
				</div>

			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=><b>Session</b></label>
					<select name="session" class="form-control form-control-sm MB-2">
						<option value="2019/2020">2019/2020</option>
						<option value="2020/2021">2020/2021</option>
						<option value="2021/2022">2021/2022</option>
						<option value="2022/2023">2022/2023</option>
						<option value="2023/2024">2023/2024</option>
						<option value="2024/2025">2024/2025</option>
					</select>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=><b>Semester</b></label>
					<select name="semester" class="form-control form-control-sm MB-2">
						<option value="1">First</option>
						<option value="2">Second</option>
						<option value="3">Third</option>
						<option value="4">Fourth</option>
					</select>

				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=><b>Course Code</b></label>
					<select name="course_id" id="course_id" class="form-control form-control-sm MB-2">
					</select>

				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-12 mt-3">

					<div class="form-check-inline mt-3">
						<label class="form-check-label">
							<input value="1" name="isLeadLec" type="checkbox" class="form-check-input">
							<b>Set as lead lecturer for course</b>
						</label>
					</div>
				</div>

			</div>
			<div class="row justify-content-right mt-4 ">
				<div class="col-lg-4 col-sm-12 ">
					<div class="btn-group">
						<button type="submit" class="btn btn-success">Allocte Class</button>
						<button class="btn btn-warning">Reset</button>
						<a href="/dashboard" class="btn btn-ghost-danger">Close</a>
					</div>
				</div>
			</div>

	</div>
	</form>
	</div>
@endsection
