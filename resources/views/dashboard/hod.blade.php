@extends('dashboard.base')
@section('content')
	<div class="container">
		<div class="fade-in">
			<div class="row mb-2">
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-primary h-100">
						<div class="card-body pb-0">
							<div class="btn-group float-right">
								<button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
									<svg class="c-icon">
										<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
									</svg>
								</button>
								<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a
										class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
								</div>
							</div>
							<div class="text-value-lg">{{ $studentCount }}</div>
							<p>
							<h4>Total No of Students</h4>
							</p>
						</div>

					</div>
				</div>

				<!-- /.col-->
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-info h-100">
						<div class="card-body pb-0">
							<button class="btn btn-transparent p-0 float-right" type="button">
								<svg class="c-icon">
									<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-location-pin"></use>
								</svg>
							</button>
							<div class="text-value-lg">{{ $totalCourses }}</div>
							<h4>Total Courses in the Department</h4>
						</div>

					</div>
				</div>
				<!-- /.col-->
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-warning h-100">
						<div class="card-body pb-0">
							<div class="btn-group float-right">
								<button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
									<svg class="c-icon">
										<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
									</svg>
								</button>
								<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a
										class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
								</div>
							</div>
							<div class="text-value-lg">{{ $progCount }}</div>
							<h4>Programmes</h4>
						</div>

					</div>
				</div>
				<!-- /.col-->
				<div class="col-sm-6 col-lg-3">
					<div class="card text-white bg-danger h-100">
						<div class="card-body pb-0">
							<div class="btn-group float-right">
								<button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
									<svg class="c-icon">
										<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
									</svg>
								</button>
								<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a
										class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
								</div>
							</div>
							<div class="text-value-lg">{{ $staffCount }}</div>
							<h4>Staff </h4>
						</div>

					</div>
				</div>
				<!-- /.col-->
			</div>
			<!-- /.row-->
			<!-- /.card-->
			<!-- /.row-->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">Traffic & Sales</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="row">
										<div class="col-6">
											<div class="c-callout c-callout-info"><small class="text-muted">Total Course registartions</small>
												<div class="text-value-lg">{{ $courseReg ?? 0 }}</div>
											</div>
										</div>
										<!-- /.col-->
										<div class="col-6">
											<div class="c-callout c-callout-danger"><small class="text-muted">First C.A Uploaded</small>
												<div class="text-value-lg">22,643</div>
											</div>
										</div>
										<!-- /.col-->
									</div>
									<!-- /.row-->
									<hr class="mt-0">
									<div class="progress-group mb-4">
										<div class="progress-group-prepend"><span class="progress-group-text">Monday</span></div>
										<div class="progress-group-bars">
											<div class="progress progress-xs">
												<div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0"
													aria-valuemax="100"></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="progress-group mb-4">
										<div class="progress-group-prepend"><span class="progress-group-text">Tuesday</span></div>
										<div class="progress-group-bars">
											<div class="progress progress-xs">
												<div class="progress-bar bg-info" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0"
													aria-valuemax="100"></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 94%" aria-valuenow="94"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="progress-group mb-4">
										<div class="progress-group-prepend"><span class="progress-group-text">Wednesday</span></div>
										<div class="progress-group-bars">
											<div class="progress progress-xs">
												<div class="progress-bar bg-info" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0"
													aria-valuemax="100"></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 67%" aria-valuenow="67"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="progress-group mb-4">
										<div class="progress-group-prepend"><span class="progress-group-text">Thursday</span></div>
										<div class="progress-group-bars">
											<div class="progress progress-xs">
												<div class="progress-bar bg-info" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0"
													aria-valuemax="100"></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 91%" aria-valuenow="91"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="progress-group mb-4">
										<div class="progress-group-prepend"><span class="progress-group-text">Friday</span></div>
										<div class="progress-group-bars">
											<div class="progress progress-xs">
												<div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0"
													aria-valuemax="100"></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 73%" aria-valuenow="73"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="progress-group mb-4">
										<div class="progress-group-prepend"><span class="progress-group-text">Saturday</span></div>
										<div class="progress-group-bars">
											<div class="progress progress-xs">
												<div class="progress-bar bg-info" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0"
													aria-valuemax="100"></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="progress-group mb-4">
										<div class="progress-group-prepend"><span class="progress-group-text">Sunday</span></div>
										<div class="progress-group-bars">
											<div class="progress progress-xs">
												<div class="progress-bar bg-info" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0"
													aria-valuemax="100"></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 69%" aria-valuenow="69"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.col-->
								<div class="col-sm-6">
									<div class="row">
										<div class="col-6">
											<div class="c-callout c-callout-warning"><small class="text-muted">Pageviews</small>
												<div class="text-value-lg">78,623</div>
											</div>
										</div>
										<!-- /.col-->
										<div class="col-6">
											<div class="c-callout c-callout-success"><small class="text-muted">Organic</small>
												<div class="text-value-lg">49,123</div>
											</div>
										</div>
										<!-- /.col-->
									</div>
									<!-- /.row-->
									<hr class="mt-0">
									<div class="progress-group">
										<div class="progress-group-header">
											<svg class="c-icon progress-group-icon">
												<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
											</svg>
											<div>Male</div>
											<div class="ml-auto font-weight-bold">43%</div>
										</div>
										<div class="progress-group-bars">
											<div class="progress progress-xs">
												<div class="progress-bar bg-warning" role="progressbar" style="width: 43%" aria-valuenow="43"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="progress-group mb-5">
										<div class="progress-group-header">
											<svg class="c-icon progress-group-icon">
												<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user-female"></use>
											</svg>
											<div>Female</div>
											<div class="ml-auto font-weight-bold">37%</div>
										</div>
										<div class="progress-group-bars">
											<div class="progress progress-xs">
												<div class="progress-bar bg-warning" role="progressbar" style="width: 43%" aria-valuenow="43"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>

								</div>
								<!-- /.col-->
							</div>
							<!-- /.row--><br>
							<table class="table table-responsive-sm table-hover table-outline mb-0">
								<thead class="thead-light">
									<tr>
										<th class="text-center">
											<svg class="c-icon">
												<use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-people"></use>
											</svg>
										</th>
										<th>User</th>
										<th class="text-center">Country</th>
										<th>Usage</th>
										<th class="text-center">Payment Method</th>
										<th>Activity</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="text-center">
											<div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/1.jpg"
													alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
										</td>
										<td>
											<div>Yiorgos Avraamu</div>
											<div class="small text-muted"><span>New</span> | Registered: Jan 1, 2015</div>
										</td>
										<td class="text-center"><i class="flag-icon flag-icon-us c-icon-xl" id="us" title="us"></i></td>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>50%</strong></div>
												<div class="float-right"><small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</td>
										<td class="text-center">
											<svg class="c-icon c-icon-xl">
												<use xlink:href="assets/icons/brands/brands-symbol-defs.svg#cc-mastercard"></use>
											</svg>
										</td>
										<td>
											<div class="small text-muted">Last login</div><strong>10 sec ago</strong>
										</td>
									</tr>
									<tr>
										<td class="text-center">
											<div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/2.jpg"
													alt="user@email.com"><span class="c-avatar-status bg-danger"></span></div>
										</td>
										<td>
											<div>Avram Tarasios</div>
											<div class="small text-muted"><span>Recurring</span> | Registered: Jan 1, 2015</div>
										</td>
										<td class="text-center"><i class="flag-icon flag-icon-br c-icon-xl" id="br" title="br"></i></td>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>10%</strong></div>
												<div class="float-right"><small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0"
													aria-valuemax="100"></div>
											</div>
										</td>
										<td class="text-center">
											<svg class="c-icon c-icon-xl">
												<use xlink:href="assets/icons/brands/brands-symbol-defs.svg#cc-visa"></use>
											</svg>
										</td>
										<td>
											<div class="small text-muted">Last login</div><strong>5 minutes ago</strong>
										</td>
									</tr>
									<tr>
										<td class="text-center">
											<div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/3.jpg"
													alt="user@email.com"><span class="c-avatar-status bg-warning"></span></div>
										</td>
										<td>
											<div>Quintin Ed</div>
											<div class="small text-muted"><span>New</span> | Registered: Jan 1, 2015</div>
										</td>
										<td class="text-center"><i class="flag-icon flag-icon-in c-icon-xl" id="in" title="in"></i></td>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>74%</strong></div>
												<div class="float-right"><small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-warning" role="progressbar" style="width: 74%" aria-valuenow="74"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</td>
										<td class="text-center">
											<svg class="c-icon c-icon-xl">
												<use xlink:href="assets/icons/brands/brands-symbol-defs.svg#cc-stripe"></use>
											</svg>
										</td>
										<td>
											<div class="small text-muted">Last login</div><strong>1 hour ago</strong>
										</td>
									</tr>
									<tr>
										<td class="text-center">
											<div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/4.jpg"
													alt="user@email.com"><span class="c-avatar-status bg-secondary"></span></div>
										</td>
										<td>
											<div>Enéas Kwadwo</div>
											<div class="small text-muted"><span>New</span> | Registered: Jan 1, 2015</div>
										</td>
										<td class="text-center"><i class="flag-icon flag-icon-fr c-icon-xl" id="fr" title="fr"></i></td>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>98%</strong></div>
												<div class="float-right"><small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 98%" aria-valuenow="98"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</td>
										<td class="text-center">
											<svg class="c-icon c-icon-xl">
												<use xlink:href="assets/icons/brands/brands-symbol-defs.svg#cc-paypal"></use>
											</svg>
										</td>
										<td>
											<div class="small text-muted">Last login</div><strong>Last month</strong>
										</td>
									</tr>
									<tr>
										<td class="text-center">
											<div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/5.jpg"
													alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
										</td>
										<td>
											<div>Agapetus Tadeáš</div>
											<div class="small text-muted"><span>New</span> | Registered: Jan 1, 2015</div>
										</td>
										<td class="text-center"><i class="flag-icon flag-icon-es c-icon-xl" id="es" title="es"></i></td>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>22%</strong></div>
												<div class="float-right"><small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0"
													aria-valuemax="100"></div>
											</div>
										</td>
										<td class="text-center">
											<svg class="c-icon c-icon-xl">
												<use xlink:href="assets/icons/brands/brands-symbol-defs.svg#cc-apple-pay"></use>
											</svg>
										</td>
										<td>
											<div class="small text-muted">Last login</div><strong>Last week</strong>
										</td>
									</tr>
									<tr>
										<td class="text-center">
											<div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/6.jpg"
													alt="user@email.com"><span class="c-avatar-status bg-danger"></span></div>
										</td>
										<td>
											<div>Friderik Dávid</div>
											<div class="small text-muted"><span>New</span> | Registered: Jan 1, 2015</div>
										</td>
										<td class="text-center"><i class="flag-icon flag-icon-pl c-icon-xl" id="pl" title="pl"></i></td>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>43%</strong></div>
												<div class="float-right"><small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-success" role="progressbar" style="width: 43%" aria-valuenow="43"
													aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</td>
										<td class="text-center">
											<svg class="c-icon c-icon-xl">
												<use xlink:href="assets/icons/brands/brands-symbol-defs.svg#cc-amex"></use>
											</svg>
										</td>
										<td>
											<div class="small text-muted">Last login</div><strong>Yesterday</strong>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /.col-->
			</div>
			@include('dashboard.shared.recentUploadsTable')
		</div>
		<!-- /.row-->
	</div>

	</div>
@endsection
