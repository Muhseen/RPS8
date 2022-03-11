@extends('dashboard.base')

@section('content')
	<div class="container-fluid">
		<div class="fade-in">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<h4>Menu roles</h4>
						</div>
						<div class="card-body">

							<button class="btn btn-primary btn-pill my-2" data-toggle="modal" data-target="#bookingModal">Add
								Permission</button>

							<table class="table table-striped table-bordered datatable">
								<thead>
									<tr>
										<th>Name</th>
										<th>Created at</th>
										<th>Updated at</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											{{ $role->name }}
										</td>
										<td>
											{{ $role->created_at }}
										</td>
										<td>
											{{ $role->updated_at }}
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-striped table-bordered">
								<tr>
									<th>Permissions</th>
								</tr>
								@foreach ($role->permissions as $permission)
									<tr>
										<td>{{ 'Can-' . $permission->name }}</td>
										<td>{{ 'Remove' }}</td>
										<td></td>
									</tr>
								@endforeach
							</table>
							<a class="btn btn-primary" href="{{ route('roles.index') }}">Return</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog h-100 modal-success" role="document">
			<div class="modal-content" height>
				<form action="/role/{{ $role->id }}/addPermission">
					<div class="modal-header">
						<h4 class="modal-title">Add Permission To role</h4>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
								aria-hidden="true">×</span></button>
					</div>
					<div action="" class="group">
						<label for="">Permissions</label>
						<select name="permission" class="form-control">
							@foreach ($permissions as $permission)
								<option value="{{ $permission->name }}">{{ 'can-' . $permission->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
						<button class="btn btn-warning" type="submit">Add Permission</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content-->
		</div>

		<!-- /.modal-dialog-->
	</div>
	</div>
@endsection

@section('javascript')
@endsection
