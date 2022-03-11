@extends('dashboard.authbase')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card text-center">
					<div class="card-header">{{ __('TWO FACTOR AUTHENTICATION') }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route('TFA') }}">
							@csrf
							<h3>{{ __('Please enter the code sent to your Phone number') }}</h3>
							<div class="form-group row">
								<div class="col-3">

								</div>

								<div class="col-6  col-offet-3">
									<input type="text" class="form-control @error('2FACODE') is-invalid @enderror" name="2FACODE"
										value="{{ old('fileno') }}" required autofocus>

									@error('2FACODE')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>



							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<button type="submit" class="btn btn-success">
										{{ __('Submit') }}
									</button>

								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
