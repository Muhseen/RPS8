@extends('dashboard.base')
@section('content')
	<div class="container">
		<form action="/statementOfResult" method="POST">
			@csrf
			<div class="row">
				<div class="col-lg-8 col-sm-12">
					<div class="form-group">
						<label for="">Registration Number</label>
						<input name="REG_NUMBER" type="text" required class="form-control">
					</div>
				</div>
				<div class="col-lg-4 col-sm-2 mt-4">
					<button type="submit" class="btn btn-success">Process statement of Result</button>
				</div>
			</div>
		</form>
	</div>
@endsection
