@extends('dashboard.base')

@section('content')
	<div class="container-fluid">
		<div class="fade-in">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<h4 class="text-center">Staff Roles<br>
								HOD=>HEAD OF DEPARTMENT<br>
								EO -> Examination Officer <br>
								TTO ->Timetable Officer<br>

							</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<a class="btn btn-lg btn-primary" href="{{ route('roles.create') }}">Add new role</a>
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
									@foreach ($roles as $role)
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
											<td>
												<a href="{{ route('roles.show', $role->id) }}" class="btn btn-primary">Show</a>
											</td>
											<td>
												<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
											</td>
											<td>
												<form action="{{ route('roles.destroy', $role->id) }}" method="POST">
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
