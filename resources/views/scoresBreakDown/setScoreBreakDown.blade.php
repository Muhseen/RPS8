@extends('dashboard.base')
@section('content')
	<div class="container card p-3">
		@include('partials.messages')
		<form method="POST" action="/scoresBreakDown">
			@csrf
			@method('PATCH')
			<script src="{{ asset('/js/rps/scoreBreakDown.js') }}" defer type="text/javascript"></script>
			<div class="card-header" style="text-align:center;">
				<h2>Set Score Breakdown for : {{ $course->COURSE_CODE }}:{{ $course->COURSE_NAME }},
					{{ $course->CREDIT_UNITS }}
					Units</h2><br>
			</div>

			<input type="hidden" name="course_id" value="{{ $course->COURSE_ID }}">
			<div class="row mt-2">
				<div class="col-lg-6 col-sm-12">
					<div class="input-group mb-3 ">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<b>Test total</b>
							</span>
						</div>
						<input type="number" min="0" max="100" value="40" id="testTotal" class="form-control"
							placeholder="">
						<div class="input-group-append">
							<button id="subTest" type="button" onclick="incExamDecTest();" class="input-group-text">-</button>
						</div>
						<div class="input-group-append">
							<button id="addTest" type="button" onclick="incTestDecExam();" class="input-group-text">+</button>
						</div>
					</div>

				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="input-group mb-3 ">
						<div class="input-group-prepend">
							<span class="input-group-text"><b>Exam total</b></span>
						</div>
						<input type="number" min="0" max="100" value="60" id="examTotal" class="form-control">
						<div class="input-group-append">
							<button id="subExam" type="button" onclick="incTestDecExam();" class="input-group-text">-</button>
						</div>
						<div class="input-group-append">
							<button id="addExam" type="submit" onclick="incExamDecTest();" class="input-group-text">+</button>
						</div>
					</div>

				</div>
			</div>
			<div class="row mx-2">
				<table class="table table-responsive table-striped">
					<thead>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<h2>Number of Practicals to be conducted</h2>
							</td>
							<td><input type="number" name="practical_count" value="{{ $sbr->practical_count }}" id="practicalCount">
							</td>
						</tr>
						<br>
						<tr>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td>
								<h4>First Test Score</h4>
							</td>
							<td><input type="number" name="test1Score" id="test1" value="{{ $sbr->test1Score }}"></td>

							<td>
								<h4>Second Test Score</h4>
							</td>
							<td><input type="number" name="test2Score" id="test2" value="{{ $sbr->test2Score }}"></td>
						</tr>
						<tr>
							<td>
								<h4>First Assignment Score</h4>
							</td>
							<td><input type="number" name="assignment1Score" value="{{ $sbr->assignment1Score }}" id="assignment1">
							</td>

							<td>
								<h4>Second Assignment Score</h4>
							</td>
							<td><input type="number" name="assignment2Score" value="{{ $sbr->assignment2Score ?? 10 }}" value=0
									id="assignment2">
							</td>
						</tr>
						<tr>
							<td>
								<h4>Total Practical Score(Average or Sum of all collections)</h4>
							</td>
							<td><input type="number" name="practicalScore" value="{{ $sbr->practicalScore ?? 0 }}" id="practicalAvg">
							</td>
							<td>
								<h4>Practical Computation Type
							</td>
							</h4>
							<td>
								<form-group>
									<select name="practical_type" id="" class="form-control">
										<option value="">Select type</option>
										<option value="sum" {{ $sbr->practical_type == 'sum' ? 'selected' : '' }}>Sum of all scores</option>
										<option value="average" {{ $sbr->practical_type == 'average' ? 'selected' : '' }}>Average of all Scores
										</option>
									</select>
								</form-group>
							</td>
						</tr>
						<tr>
							<td>
								<h4>Examination Score</h4>
							</td>
							<td><input type="number" name="examination" id="exam" value="{{ $sbr->examination ?? 60 }}"></td>
						</tr>

					</tbody>
				</table>

			</div>
			<button type="submit" id="submit" class="btn btn-success">Set Breakdown</button>
			<button type="reset" class="btn btn-outline-danger">Cancel</button>
		</form>
	</div>
@endsection
