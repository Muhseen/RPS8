@extends('dashboard.base')

@section('content')
	<script defer src="{{ asset('js/rps/register.js') }}" type="text/javascript"></script>
	<div class="container">
		@include('partials.messages')
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card mx-4">
					<div class="card-body p-4">
						<form method="POST" action="{{ route('register') }}">
							@csrf
							<h1>{{ __('Create new user profile') }}</h1>
							<p class="text-muted">Add new User</p>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-envelope-open"></use>
										</svg>
									</span>
								</div>
								<input class="form-control" type="text" id="file_no" onkeyup="getName();" placeholder="{{ __('File No') }}"
									name="file_no" value="{{ old('file_no') }}" required>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-"></use>
										</svg>
									</span>
								</div>
								<input class="form-control" type="text" id="ippis_no" placeholder="{{ __('IPPIS No') }}" name="ippis_no"
									value="{{ old('ippis_no') }}" required>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-phone"></use>
										</svg>
									</span>
								</div>
								<input class="form-control" type="text" id="phone_no" placeholder="{{ __('Phone No') }}" name="phone_no"
									value="{{ old('phone_no') }}" required>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
										</svg>
									</span>
								</div>
								<input class="form-control" id="staff_name" type="text" placeholder="{{ __('Name') }}" name="name"
									value="{{ old('name') }}" required autofocus>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
										</svg>
									</span>
								</div>
								<select class="form-control" type="text" placeholder="{{ __('Department') }}" name="department_id"
									value="{{ old('department_id') }}" required autofocus>
									@foreach ($depts as $d)
										<option value="{{ $d->DEPT_ID }}">{{ $d->DEPARTMENT }}</option>
									@endforeach
								</select>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-envelope-open"></use>
										</svg>
									</span>
								</div>
								<input class="form-control" type="text" id="email" placeholder="{{ __('E-mail Address') }}"
									name="email" value="{{ old('email') }}" required>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
										</svg>
									</span>
								</div>
								<input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" required>
							</div>
							<div class="input-group mb-4">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
										</svg>
									</span>
								</div>
								<input class="form-control" type="password" placeholder="{{ __('Confirm Password') }}"
									name="password_confirmation" required>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
										</svg>
									</span>
								</div>
								<select class="form-control" type="text" placeholder="{{ __('Role') }}" name="menuroles"
									value="{{ old('menuroles') }}" required autofocus>
									<option value="NIL">No Role(Just Lecturer)</option>
									<option value="TTO">Time Table Officer</option>
									<option value="EO">Exam Officer</option>
									<option value="HOD">Head of Department</option>
								</select>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<svg class="c-icon">
											<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
										</svg>
									</span>
								</div>
								<select class="form-control" type="text" placeholder="{{ __('Rank') }}" name="rank"
									value="{{ old('rank') }}" required autofocus>
									<option value="Assistan Lecturer">Assistant Lecturer</option>
									<option value="Lecturer III">Lecturer III</option>
									<option value="Lecturer II">Lecturer II</option>
									<option value="Lecturer I">Lecturer I</option>
									<option value="Senior Lecturer">Senior Lecturer</option>
									<option value="Principal Lecturer">Principal Lecturer</option>
									<option value="Chief Lecturer">Chief Lectcurer</option>
								</select>
							</div>

							<button class="btn btn-block btn-success" type="submit">{{ __('Add User') }}</button>
						</form>
					</div>
					<div class="card-footer p-4">
						<!-- <div class="row">
																																																																			<div class="col-6">
																																																																					<button class="btn btn-block btn-facebook" type="button">
																																																																							<span>facebook</span>
																																																																					</button>
																																																																			</div>
																																																																			<div class="col-6">
																																																																					<button class="btn btn-block btn-twitter" type="button">
																																																																							<span>twitter</span>
																																																																					</button>
																																																																			</div>
																																																																	</div>
																																																															-->
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
@endsection
