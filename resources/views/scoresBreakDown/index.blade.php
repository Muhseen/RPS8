@extends('dashboard.base')
@section('content')
	<div class="container">
		<script src="{{ asset('/js/rps/search.js') }}" defer type="text/javascript"></script>
		@include('partials.messages')
		@if (session('success'))
			<div class="alert  alert-success alert-dismissible alert">
				<li><b>{{ session('success') }}</b></li>
			</div>
		@endif

		<div class="card-header" style="text-align:center;">
			<h1>Set Score Breakdown for a Course</h1><br>
			<strong>NOTE: THE default breakdown 10 marks(each) for First test, Second test, First Assignment, Second Assignment
				will be applied if no specific breakdown is given for a Course.</strong>
			<br>
			<strong>No scores for First and Second Practicals </strong>
		</div>
		<div class="form-group">
			<label class="prepend-text"><b>Search Course : </b>
			</label>
			<input type="text" id="course_code" class="form-control ">
		</div>
		<div id="table" class="col-12">
		</div>
		@if ($sbr->count() > 0)
			<table class="table  text-center table-responsive table-striped">
				<tr>
					<th>Course Code</th>
					<th>Course title</th>
					<th>Test 1</th>
					<th>Test 2</th>
					<th>Assignment 1</th>
					<th>Assignment 2</th>
					<th>No of Practicals to be conducted</th>
					<th>Practical Score</th>
					<th>Exam</th>
					<th>Edit</th>
					<th>DELETE</th>
				</tr>
				@foreach ($sbr as $s)
					<tr>
						<td>{{ $s->course->COURSE_CODE }}</td>
						<td>{{ $s->course->COURSE_NAME }}</td>
						<td>{{ $s->test1Score }}</td>
						<td>{{ $s->test2Score }}</td>
						<td>{{ $s->assignment1Score }}</td>
						<td>{{ $s->assignment2Score }}</td>
						<td>{{ $s->practical_count }}</td>
						<td>{{ $s->practicalScore }}</td>
						<td>{{ $s->examination }}</td>
						<td><a href="./scoresBreakDown/{{ $s->course->COURSE_ID }}" class="btn btn-primary">Edit</a></td>
						<td><a href="./setScoresLimit/destroy/{{ $s->id }}" class="btn btn-danger">DELETE</a></td>
					</tr>
				@endforeach
			</table>
		@endif
	</div>
@endsection
