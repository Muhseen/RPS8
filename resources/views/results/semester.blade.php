@extends('dashboard.base')
@section('content')
	<style>
		table {
			page-break-after: always;
			overflow: :unset;
		}

		* {
			overflow: :none !important;
		}

		.stickyTH {
			position: sticky !important;
			top: 300px;
			background: red;

		}

		#resultTable thead tr th {
			position: sticky;
			top: -1px;
		}

		tr:hover {
			background: black !important;
			color: white !important;
			/* font-size: 25px; */
		}
	</style>
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
			<tr>
				<td>Below 40%</td>
				<td>F</td>
				<td>0.00</td>
			</tr>

		</table>
		<div class="row my-2" style="position:sticky !important;top:0 !important;">
			<div class="col-lg-6 col-sm-12"><label for="" class="text-bold"><b>Search by Name</b></label>
				<input type="text" class="form-control" id="param" onkeyup="mySearchFunction()">
			</div>
		</div>
		{!! $table !!}

		{!! $sTable !!}
		AE = ABSENT WITH EXCUSE NA = ATTENDANCE FALL SHORT EX = EXEMPTED
		NR = COURSE NOT REGISTERED FOR SK = SICK EM = EXAMINATION MALPRACTICE
		CP = COURSE IN PROGRESS DE = EXEMPTED DIRECT STUDENT STD DEV = STANDARD DEVIATION
		OP = OPTIONAL (NOT TAKEN) CO = CONDONNED AW = ABSENT WITHOUT EXCUSE
		PI = PROJECT INCOMPLETE SI = SIWES NOT COMPLETED TOTAL = TOTAL No. OF STUDENTS
		PC = PAPER CANCELLED DF = DEFERRED COURSE


		<table class="table table-striped table-bordered">
			<tr>
				<th colspan="3" class="text-center">Legend</th>
			</tr>
			<tr>
				<th>AE = ABSENT WITH EXCUSE</th>
				<th>NA = ATTENDACE FALL SHORT</th>
				<th>EX = EXEMPTED</th>
			</tr>
			<tr>
				<th>NR = COURSE NOT REGISTERED FOR</th>
				<th>SK = SICK</th>
				<th>EM = EXAMINATION MALPRACTICE</th>
			</tr>
			<tr>
				<th>CP = COURSE IN PROGRESS</th>
				<th>DE = EXEMPTED DIRECT STUDENT</th>
				<th>STD DEV = STANDARD DEVIATION</th>
			</tr>
			<tr>
				<th>OP = OPTIONAL(NOT TAKEN)</th>
				<th>CO = CONDONED</th>
				<th>AW = ABSENT WITHOUT EXCUSE</th>
			</tr>
			<tr>
				<th>PI = PROJECT INCOMPLETE</th>
				<th>SI = SIWES NOT COMPLETED</th>
				<th>TOTAL = TOTAL NO OF STUDENTS</th>
			</tr>
			<tr>
				<th>PC = PAPER CANCELLED</th>
				<th>DF = DEFERRED COURSE</th>
				<th></th>
			</tr>
		</table>


	</div>
	<script>
		function mySearchFunction() {
			// Declare variables
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("param");
			filter = input.value.toUpperCase();
			table = document.getElementById("resultTable");
			tr = table.getElementsByTagName("tr");

			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[2];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	</script>
@endsection
