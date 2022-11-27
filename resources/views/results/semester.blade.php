@extends('dashboard.base')
@section('content')
	<div class="container" style="overflow:scroll;">
		<table class="table table-striped table-bordered">
			<tr>
				<th>Marks Range</th>
				<th>Letter Grade</th>
				<th>Weight</th>
			</tr>
			<tr>
				<td>75% and above</td>
				<td>A</td>
				<td>4.00</td>
			</tr>
			<tr>
				<td>70% -74%</td>
				<td>AB</td>
				<td>3.50</td>
			</tr>
			<tr>
				<td>65% -69%</td>
				<td>B</td>
				<td>3.25</td>
			</tr>
			<tr>
				<td>60% -64%</td>
				<td>BC</td>
				<td>3.00</td>
			</tr>
			<tr>
				<td>55% -59%</td>
				<td>C</td>
				<td>2.75</td>
			</tr>

			<tr>
				<td>50%-54%</td>
				<td>CD</td>
				<td>2.50</td>
			</tr>
			<tr>
				<td>45%-49%</td>
				<td>D</td>
				<td>2.25</td>
			</tr>
			<tr>
				<td>40%-44%</td>
				<td>E</td>
				<td>2.00</td>
			</tr>
		</table>
		{!! $table !!}
		{!! $sTable !!}



	</div>
@endsection
