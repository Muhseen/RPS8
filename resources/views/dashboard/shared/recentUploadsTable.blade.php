<div class="row">
	<table class="table table-striped table-bordered">
		<tr>
			<th colspan="5" class=" text-center justify-content-center">Most Recent Scores Uploads</th>

		</tr>
		<tr>
			<th>Course Code and Title</th>
			<th>Uploaded By</th>
			<th>Score Type</th>
			<th>Uplaoded</th>

		</tr>
		<tbody>
			@foreach ($scoresUpload as $sc)
				<tr>
					<td>{{ $sc->course->COURSE_CODE . '-' . $sc->course->COURSE_NAME }}</td>
					<td>{{ $sc->staff->file_no . '-' . $sc->staff->fullname }}</td>
					<td>{{ Str::upper($sc->score_type) }}</td>
					<td>{{ $sc->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
			<tr>
				<th colspan="4">{{ $scoresUpload->links() }}</th>
			</tr>
		</tbody>
	</table>
</div>
