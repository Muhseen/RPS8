@extends('dashboard.base')
@section('content')
	<div class="container card">
		<div class="row justify-content-end px-4 pt-3">
			<a href="/courses/create" class="btn btn-success">Add New Course</a>
		</div>

		<div class="row justify-content-center my-2">
			<h3>List of Courses in the Department Grouped by Programmes</h3>
		</div>
		<hr>
		<div class="row">
			<table class="table table-striped table-bordered table-hover table-active">
				@foreach ($deptCourses->groupBy('PROG_ID') as $progCourses)
					<tr>
						<th colspan="9" class="text-center">
							{{ $progCourses->first()->programme->PROGRAMME . ' - ' . $progCourses->first()->programme->PROG_TYPE }} <br>
							<button class="btn btn-primary process-reg" progId="{{ $progCourses->first()->PROG_ID }}"> Process Registration for
								this Programme</button>
						</th>
					</tr>
					<tr>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Credit Units</th>
						<th>Level</th>
						<th>Semester</th>
						<th>Programme</th>
						<th>Programme type</th>
						<th>Edit</th>
						<th>Delete</th>

					</tr>
					@foreach ($progCourses->sortBy(['LEVEL', 'SEMESTER']) as $course)
						<tr>
							<td>{{ $course->COURSE_CODE }}</td>
							<td>{{ $course->COURSE_NAME }}</td>
							<td>{{ $course->CREDIT_UNITS }}</td>
							<td>{{ $course->LEVEL }}</td>
							<td>{{ $course->SEMESTER }}</td>
							<td>{{ $course->programme->PROGRAMME }}</td>
							<td>{{ $course->programme->PROG_TYPE }}</td>
							<td> <a href="/courses/{{ $course->COURSE_ID }}/edit" class="btn btn-success"> Edit</a></td>
							<td>

								<form action="{{ route('courses.destroy', $course) }}" class="deleteCourse" method="POST">
									@csrf
									@method('DELETE')
									<button class="btn btn-danger">Delete</button>
								</form>
							</td>

						</tr>
					@endforeach
				@endforeach
			</table>
		</div>
	</div>
	<script defer>
		$(document).ready(function() {

			$('.deleteCourse').submit(function(e) {
				e.preventDefault();
				let link = $(this).attr("action");
				let data = $(this).serialize();

				const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'mx-1 btn btn-success',
						cancelButton: 'mx-1 btn btn-danger'
					},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes, delete it!',
					cancelButtonText: 'No, cancel!',
					reverseButtons: true
				}).then((result) => {

					if (result.isConfirmed) {
						$.ajax({
							type: "POST",
							url: link,
							data: data,
							dataType: "JSON",
							success: function(response) {
								if (response.success) {
									swalWithBootstrapButtons.fire(
										'Deleted!',
										'Course has been deleted.',
										'success'
									)


								}
								location.reload();
							},
							error: function(e) {
								console.log({
									e
								})
							}
						});
					} else if (
						/* Read more about handling dismissals below */
						result.dismiss === Swal.DismissReason.cancel
					) {
						swalWithBootstrapButtons.fire(
							'Cancelled',
							'',
							'error'
						)
					}
				})
			});


			$(".process-reg").click(function() {
				let prog_id = $(this).attr("progId")
				const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'mx-1 btn btn-success',
						cancelButton: 'mx-1 btn btn-danger'
					},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: 'Are you sure you want to process a new registration? <br> This will wipe all scores entered and start from beginning.',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes, Process New Registration!',
					cancelButtonText: 'No, cancel!',
					reverseButtons: true
				}).then((result) => {

					if (result.isConfirmed) {
						$.ajax({
							type: "GET",
							url: ("/processReg/" + prog_id),
							dataType: "JSON",
							success: function(response) {
								if (response.success) {
									swalWithBootstrapButtons.fire(
										'Registration Processed!',
										'Registration has successfully been processed. You can capture scores now.',
										'success'
									)


								}
								location.reload();
							},
							error: function(e) {
								console.log({
									e
								})
							}
						});
					} else if (
						/* Read more about handling dismissals below */
						result.dismiss === Swal.DismissReason.cancel
					) {
						swalWithBootstrapButtons.fire(
							'Cancelled',
							'',
							'error'
						)
					}
				})

			});
		});
	</script>
@endsection
