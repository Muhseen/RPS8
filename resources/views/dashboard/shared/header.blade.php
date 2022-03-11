<div class="c-wrapper">
	<header class="c-header c-header-light c-header-fixed c-header-with-subheader"
		style="background-color: green; color:white">
		<button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
			data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
		<a class="c-header-brand d-sm-none" href="#">
		</a>
		<button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
			data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
		<?php
		use App\MenuBuilder\FreelyPositionedMenus;
		if (isset($appMenus['top menu'])) {
		    FreelyPositionedMenus::render($appMenus['top menu'], 'c-header-', 'd-md-down-none');
		}
		?>
		<img src="{{ asset('/images/logo.jpg') }}" alt="Poly Logo" width="35px" height="35px" class="img-rounded mt-3">
		<span class="h2 mt-3">Kaduna Polytechnic RPS</span>
		<ul class="c-header-nav ml-auto mr-4">
			<li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link">
					<strong style="color: white">{{ auth()->user()->staff->fullname }}</strong></a></li>
			<li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
					aria-haspopup="true" aria-expanded="false">
					<div class="c-avatar"><img class="c-avatar-img" src="{{ url('/assets/img/avatars/6.jpg') }}"
							alt="user@email.com"></div>
				</a>
				<div class="dropdown-menu dropdown-menu-right pt-0">
					<div class="dropdown-header bg-light py-2"><strong>Account</strong></div><a class="dropdown-item" href="#">
						<svg class="c-icon mr-2">
							<use xlink:href="{{ url('/icons/sprites/free.svg#cil-bell') }}"></use>
						</svg> Updates<span class="badge badge-info ml-auto">42</span></a><a class="dropdown-item" href="#">
						<svg class="c-icon mr-2">
							<use xlink:href="{{ url('/icons/sprites/free.svg#cil-envelope-open') }}"></use>
						</svg> Messages<span class="badge badge-success ml-auto">42</span></a>
					<div class="dropdown-header bg-light py-2"><strong>Settings</strong></div><a class="dropdown-item" href="#">
						<svg class="c-icon mr-2">
							<use xlink:href="{{ url('/icons/sprites/free.svg#cil-user') }}"></use>
						</svg> Profile</a><a class="dropdown-item" href="#">
						<svg class="c-icon mr-2">
							<use xlink:href="{{ url('/icons/sprites/free.svg#cil-settings') }}"></use>
						</svg> Settings</a><a class="dropdown-item" href="#">
						<a class="dropdown-item" href="#">
							<a href="{{ route('logout') }}"
								onclick="event.preventDefault();document.getElementById('logout-form').submit();"
								class="btn btn-ghost-dark btn-block">Logout</a>

						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>

				</div>
			</li>
		</ul>
		<div class="c-subheader px-3">
			<ol class="breadcrumb border-0 m-0">
				<li class="breadcrumb-item"><a href="/">Home</a></li>
				<?php $segments = ''; ?>
				@for ($i = 1; $i <= count(Request::segments()); $i++)
					<?php $segments .= '/' . Request::segment($i); ?>
					@if ($i < count(Request::segments()))
						<li class="breadcrumb-item">{{ Request::segment($i) }}</li>
					@else
						<li class="breadcrumb-item active">{{ Request::segment($i) }}</li>
					@endif
				@endfor
			</ol>
		</div>
	</header>
