@if ($errors->any())
	@foreach ($errors->all() as $e)
		<div class="alert alert-danger">
			<strong>
				{{ $e }}
			</strong>
		</div>
	@endforeach
@endif
@if (session()->has('message'))
	<div class="alert alert-success">
		<strong>
			{{ session('message') }}
		</strong>
	</div>
@endif
