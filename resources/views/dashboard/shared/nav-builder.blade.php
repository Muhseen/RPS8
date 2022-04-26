<div class="c-sidebar-brand" style="background-color: rgb(12, 141, 12)">
	<span class="h2">Menu</span>
</div>
<ul class="c-sidebar-nav" style="background-color: rgb(39, 66, 39)">
	<li class="c-sidebar-nav-item">
		<a class="c-sidebar-nav-link c-active" href="{{ route('dashboard') }}">
			<i class="cil-speedometer c-sidebar-nav-icon"></i>
			Dashboard
		</a>
	</li>
	<li class="c-sidebar-nav-dropdown">
		<a class="c-sidebar-nav-dropdown-toggle" href="#">
			<i class="cil-spreadsheet  c-sidebar-nav-icon"></i>
			Capture/Upload Scores</a>
		<ul class="c-sidebar-nav-dropdown-items">
			<li class="nav-item"><a class="c-sidebar-nav-link c-active" href="/uploadScores/firstCA">
					<i class="cil-notes  c-sidebar-nav-icon"></i>
					First Test Scores
				</a>
			</li>
			<li class="nav-item">
				<a class="c-sidebar-nav-link c-active" href="/uploadScores/secondCA">
					<i class="cil-notes c-sidebar-nav-icon"></i>
					Second Test Scores
				</a>
			</li>
			<li class="nav-item">
				<a class="c-sidebar-nav-link c-active" href="/uploadScores/firstAssignment">
					<i class="cil-notes c-sidebar-nav-icon"></i>
					First Assignment Scores
				</a>
			</li>
			<li class="nav-item">
				<a class="c-sidebar-nav-link c-active" href="/uploadScores/secondAssignment">
					<i class="cil-notes c-sidebar-nav-icon"></i>
					Second Assignment Scores
				</a>
			</li>
			<li class="nav-item">
				<a class="c-sidebar-nav-link c-active" href="/uploadScores/examination">
					<i class="cil-notes c-sidebar-nav-icon"></i>
					Examination Scores
				</a>
			</li>
			<li class="nav-item">
				<a class="c-sidebar-nav-link c-active" href="/practicals">
					<i class="cil-notes c-sidebar-nav-icon"></i>
					Practical Scores
				</a>
			</li>

		</ul>
	</li>
	<li class="c-sidebar-nav-item">
		<a class="c-sidebar-nav-link c-active" href="{{ route('studentsListView') }}">
			<i class="cil-data-transfer-down c-sidebar-nav-icon"></i>
			Download Students' list
		</a>
	</li>
	@if (auth()->user()->can('process-result'))
		<li class="c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-dropdown-toggle" href="#">
				<i class="cil-calculator  c-sidebar-nav-icon"></i>
				Results Processing</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="nav-item"><a class="c-sidebar-nav-link c-active" href="/processResults">
						<i class="cil-settings  c-sidebar-nav-icon"></i>
						Process Results
					</a>
				</li>

				<li class="nav-item"><a class="c-sidebar-nav-link c-active" href="/processResults">
						<i class="cil-spreadsheet  c-sidebar-nav-icon"></i>
						Result Reports
					</a>
				</li>
				<li class="nav-item">
					<a class="c-sidebar-nav-link c-active" href="/specialCases">
						<i class="cil-data-transfer-up c-sidebar-nav-icon"></i>
						Update Absentee info
					</a>
				</li>
				<li class="nav-item">
					<a class="c-sidebar-nav-link c-active" href="/statementOfResult">
						<i class="cil-spreadsheet c-sidebar-nav-icon"></i>
						Statement of Result
					</a>
				</li>

			</ul>
		</li>
	@endif
	@if (auth()->user()->can('allocate-class'))
		<li class="c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-dropdown-toggle" href="#">
				<i class="cil-playlist-add c-sidebar-nav-icon"></i>
				Class Allocations</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="nav-item"><a class="c-sidebar-nav-link c-active" href="{{ route('classAllocation.create') }}">
						<i class="cil-spreadsheet  c-sidebar-nav-icon"></i>
						Allocate Class to lecturer
					</a>
				</li>
				<li class="nav-item">
					<a class="c-sidebar-nav-link c-active" href="{{ route('classAllocation.index') }}">
						<i class="cil-update c-sidebar-nav-icon"></i>
						View Class Allocations
					</a>
				</li>

			</ul>
		</li>
	@endif
	@if (auth()->user()->can('allocate-class'))
		<li class="c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-dropdown-toggle" href="#">
				<i class="cil-playlist-add c-sidebar-nav-icon"></i>
				Manage Courses</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="nav-item"><a class="c-sidebar-nav-link c-active" href="{{ route('courses.index') }}">
						<i class="cil-spreadsheet  c-sidebar-nav-icon"></i>
						View Courses
					</a>
				</li>
				<li class="nav-item">
					<a class="c-sidebar-nav-link c-active" href="{{ route('courses.create') }}">
						<i class="cil-update c-sidebar-nav-icon"></i>
						Add New Course
					</a>
				</li>

			</ul>
		</li>
	@endif
	@if (auth()->user()->can('set-breakdown'))
		<li class="c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-dropdown-toggle" href="#">
				<i class="cil-sort-numeric-up  c-sidebar-nav-icon"></i>
				Course Breakdowns</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="nav-item"><a class="c-sidebar-nav-link c-active" href="/scoresBreakDown">
						<i class="cil-spreadsheet  c-sidebar-nav-icon"></i>
						Set course score-breakdown
					</a>
				</li>
				<li class="nav-item">
					<a class="c-sidebar-nav-link c-active" href="{{ route('dashboard') }}">
						<i class="cil-update c-sidebar-nav-icon"></i>
						View course score-breakdown
					</a>
				</li>

			</ul>
		</li>
	@endif
	@if (auth()->user()->hasRole('admin'))
		<li class="c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-dropdown-toggle" href="#">
				<i class="cil-settings  c-sidebar-nav-icon"></i>
				Admin</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="nav-item"><a class="c-sidebar-nav-link c-active" href="/register">
						<i class="cil-user c-sidebar-nav-icon"></i>
						Add a new User
					</a>
				</li>
				<li class="nav-item">
					<a class="c-sidebar-nav-link c-active" href="/roles">
						<i class="cil-people c-sidebar-nav-icon"></i>
						Roles
					</a>
				</li>
				<li class="nav-item">
					<a class="c-sidebar-nav-link c-active" href="/permissions">
						<i class="cil-lock-unlocked c-sidebar-nav-icon"></i>
						Permissions
					</a>
				</li>

				<li class="nav-item">
					<a class="c-sidebar-nav-link c-active" href="#">
						<i class="cil-notes c-sidebar-nav-icon"></i>
						View Reports
					</a>
				</li>

			</ul>
		</li>
	@endif
</ul>

</div>
<style>
	.c-sidebar-nav-link:hover {
		background: gray !important;
	}

	.c-sidebar-nav-link:hover {
		background: rgb(5, 5, 5) !important;
	}

	.c-sidebar-nav-dropdown-toggle:hover {
		background: gray !important;
	}

</style>
