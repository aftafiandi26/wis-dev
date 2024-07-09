<!DOCTYPE html>
<html lang="en">
<head>
	
<link href="{!! URL::route('assets/css/bootstrap') !!}" rel="stylesheet">

</head>

<b>
<img style="width:160px; height:80px;" src="{!! URL::route('assets/img/kinema') !!}">
</b>

<i class="pull-right"><h6>printed on: <?php echo date("M d, Y"); ?></h6></i>
<h1 align="center">LEAVE APPLICATION FORM</h1>
	<table>
			<tr style="color: white;">
			<!-- <tr> -->
				<th width="82">1</th>
				<th width="7">2</th>
				<th width="170">3</th>
				<th width="40">4</th>
				<th width="60">5</th>
				<th width="7">6</th>
				<th>7</th>
			</tr>
			<tr style="vertical-align: top;">
				<td>Request by</td>
				<td>:</td>
				<td><b>{{ $select->first_name }} {{ $select->last_name}}</b></td>
				<td></td>
				<td>NIK</td>
				<td>:</td>
				<td><b>{{ $select->nik}}</b></td>
			</tr>
			<tr>
				<td>Period</td>
				<td>:</td>
				<td><b>{{ $select->period }}</b></td>
				<td></td>
				<td>Position</td>
				<td>:</td>
				<td><b>{{ $select->position}}</b></td>
			</tr>
			<tr>
				<td>Join Date</td>
				<td>:</td>
				<td><b>{{ date("M d, Y", strtotime($select->join_date)) }}</b></td>
				<td></td>
				<td>Department</td>
				<td>:</td>
				<td><b>{{ $select->request_dept_category_name }}</b></td>
			</tr>
			<tr style="vertical-align: top;">
				<td>Contact Address</td>
				<td>:</td>
				<td colspan="5"><b>{{ $select->address }}</b></td>
			</tr>
			<tr style="color: white;">
				<td>x</td>				
			</tr>
			<tr>
				<td>Leave Category</td>
				<td>:</td>
				<td><b>{{ $select->leave_category_name }}</b></td>
			</tr>
	</table>

	<br>
	<br>

	<p align="center"><b>PERSONAL VERIFICATION</b></p>

	<table class="table table-striped table-bordered table-hover" width="100%">
		<thead>
			<tr>
				<th>Period</th>
				<th>Entitlement</th>
				<th>Taken</th>
				<th>Pending</th>
				<th>Requested</th>
				<th>Balance</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ $select->period }}</td>
				<td>{{ $select->entitlement }}</td>
				<td>{{ $select->taken }}</td>
				<td>{{ $select->pending }}</td>
				<td>{{ $select->total_day }}</td>
				<td>{{ $select->remain }}</td>
			<tr>
		</tbody>
	</table>

	<table>
			<tr style="color: white;">
				<th width="150">1</th>
				<th width="7">2</th>
				<th width="80">3</th>
				<th width="40">4</th>
				<th width="7">5</th>
				<th width="5">6</th>
				<th>7</th>
			</tr>
			<tr>
				<td>Approved Leave from</td>
				<td>:</td>
				<td><b>{{ date("M d, Y", strtotime($select->leave_date)) }}</b></td>
				<td>until</td>
				<td><b>{{ date("M d, Y", strtotime($select->end_leave_date)) }}</b></td>
				<td></td>
				<td></b></td>
			</tr>
			<tr>
				<td>Back to Work on</td>
				<td>:</td>
				<td><b>{{ date("M d, Y", strtotime($select->back_work)) }}</b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Contact phone during leave</td>
				<td>:</td>
				<td><b>{{ $select->phone }}</b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
	</table>

	<br>
	<br>
	<br>

	<b>Verified by: </b>
	<ul>
		<li>HR  Department <i>({{ date("M d, Y", strtotime($select->date_ver_hr)) }})</i></li>
	</ul>
	
	<b>Approved by: </b>
	<ul>
		<li>HR Manager  <i>({{ date("M d, Y", strtotime($select->date_ap_hrd)) }})</i></li>
		<!--<li>General Manager <i>({{ date("M d, Y", strtotime($select->date_ap_gm)) }})</i></li>-->
	</ul>

	
</html>