@extends('dashboard.base')
@section('content')
	<script src="{{ asset('js/rps/processResults.js') }}" type="text/javascript" defer></script>
	<form action="/processResults" method="POST">
		@csrf
		<div class="container">
			@include('partials.messages')
			<div class="card-header">
				<h3 class="text-uppercase">Process {{ auth()->user()?->staff->department ?? 'N/A' }} results</h3>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for="progType"><b>Programme Type</b></label>
					<select id="programme_type" name="programme_type" class="form-control form-control-sm">
						<option value="">Select Programme Type</option>
						<option value="regular">Regular</option>
						<option value="evening">Evening</option>
						<option value="partTime">Part Time</option>
					</select>

				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=""><b>Programme</b></label>
					<select id="prog_id" class=" custom-select custom-select-sm mb-2" name="prog_id">
					</select>

				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=><b>Level</b></label>
					<select id="level" name="level" class="form-control form-control-sm">
						<option value="100">ND I</option>
						<option value="200">ND II</option>
						<option value="300">HND I</option>
						<option value="400">HND II</option>
					</select>

				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=""><b>Session</b></label>

					<select class="custom-select-sm custom-select" name="session" id="">
						<option value="2020/2021">2020/2021</option>
						<option value="2021/2022">2021/2022</option>
						<option value="2022/2023">2022/2023</option>
						<option value="2023/2024">2023/2024</option>
						<option value="2024/2025">2024/2025</option>
						<option value="2024/2025">2025/2026</option>
					</select>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for=""><b>Semester</b></label>
					<select id="semester" class=" custom-select custom-select-sm " name="semester" id="">
						<option value="1">First</option>
						<option value="2">Second</option>
					</select>

				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for="" class="text-capitalize text-bold "><b>Type</b></label>
					<select class="form-control form-control-sm" name="type" id="">
						<option value="semester">Semester</option>
						<option value="continuous">Continuous</option>
						<option value="semester-1">Semester With Scores</option>
						<option value="continuous-1">Contiunous with Scores</option>

					</select>

				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">

					<div class="btn-group my-4">
						<button type="submit" class="btn btn-success ">Process</button>
						<button class="btn btn-danger">Cancel</button>
						<button class="btn btn-secondary">Reset</button>
					</div>
				</div>
			</div>
	</form>
@endsection
