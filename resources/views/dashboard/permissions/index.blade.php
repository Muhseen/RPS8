@extends('dashboard.base')

@section('content')
	<div class="container-fluid">
		<div class="fade-in">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<h4 class="text-center">Staff Roles<br>
								process-result -> User/Model can process Result<br>
								add-class-allocation -> The role/user with this permission should be able to add new class allocation <br>
								TTO ->Timetable Officer<br>

							</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<a class="btn btn-lg btn-primary" href="{{ route('permissions.create') }}">Add new Permission</a>
							</div>
							<br>
							<table class="table table-striped table-bordered datatable">
								<thead>
									<tr>
										<th>Name</th>
										<th>Created at</th>
										<th>Updated at</th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($permissions as $permission)
										<tr>
											<td>
												{{ $permission->name }}
											</td>
											<td>
												{{ $permission->created_at }}
											</td>
											<td>
												{{ $permission->updated_at }}
											</td>
											<td>
												<a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-primary">Show</a>
											</td>
											<td>
												<a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary">Edit</a>
											</td>
											<td>
												<form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
													@method('DELETE')
													@csrf
													<button class="btn btn-danger">Delete</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
@endsection

@section('javascript')
@endsection
