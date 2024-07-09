<!DOCTYPE html>
<html lang="en">
<head>
	


</head>

<b>
<img style="width:210px; height:60px;" src="{!! URL::route('assets/img/kinema') !!}">
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
				<td><b>{{ $select->request_by }}</b></td>
				<td></td>
				<td>NIK</td>
				<td>:</td>
				<td><b>{{ $select->request_nik}}</b></td>
			</tr>
			<tr>
				<td>Period</td>
				<td>:</td>
				<td><b>{{ $select->period }}</b></td>
				<td></td>
				<td>Position</td>
				<td>:</td>
				<td><b>{{ $select->request_position}}</b></td>
			</tr>
			<tr>
				<td>Join Date</td>
				<td>:</td>
				<td><b>{{ date("M d, Y", strtotime($select->request_join_date)) }}</b></td>
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
	<?php if (Auth::user()->dept_category_id !=6 ) {
		
	?>
	<ul>
		<li>HR Department <i>({{ date("M d, Y", strtotime($select->date_ver_hr)) }})</i></li>
	</ul>
	
	<b>Approved by: </b>
	<ul>
		<li>Department Head : <?php $hd = DB::table('users')->select(db::raw('*'))->where('dept_category_id', '=', auth::user()->dept_category_id)->where('hd', '=', 1)->first(); echo $hd->first_name; echo " "; echo $hd->last_name; ?> <i>({{ date("M d, Y", strtotime($select->date_ap_hd)) }})</i></li>
		<!--<li>General Manager <i>({{ date("M d, Y", strtotime($select->date_ap_gm)) }})</i></li>-->
	</ul>
<?php } else {
?>
	<ul>
		<li>HR Department <i>({{ date("M d, Y", strtotime($select->date_ver_hr)) }})</i></li>
	</ul>
	
	<b>Approved by: </b>
	<ul>
		<li>Department Head : <?php $hd = DB::table('users')->select(db::raw('*'))->where('dept_category_id', '=', auth::user()->dept_category_id)->where('hd', '=', 1)->first(); echo $hd->first_name; echo " "; echo $hd->last_name; ?>  <i>({{ date("M d, Y", strtotime($select->date_ap_hd)) }})</i></li>
		@if(auth::user()->level_hrd === 0)
		<li>Producer : {{ $select->producer_name }}  <i>({{ date("M d, Y", strtotime($select->date_producer)) }})</i></li>
		<li>Project Manager : {{$select->pm_name}} <i>({{ date("M d, Y", strtotime($select->date_ap_pm)) }})</i></li>		
		<li>Coordinator : {{$select->koor_name}} <i>({{ date("M d, Y", strtotime($select->date_ap_koor)) }})</i></li>
		<li>Supervisor : {{$select->spv_name}} <i>({{ date("M d, Y", strtotime($select->date_ap_spv)) }})</i></li>
		@endif

		@if(auth::user()->level_hrd === 'Junior Pipeline')
		<li>Supervisor Pipeline : <i>({{ date("M d, Y", strtotime($select->date_ap_pipeline)) }})</i></li>
		<li>Supervisor Technical Director : <i>({{ date("M d, Y", strtotime($select->date_ap_spv)) }})</i></li></li>
		@endif

		@if(auth::user()->level_hrd === 'Senior Pipeline' or auth::user()->level_hrd === 'Senior Technical')		
		<li>Supervisor Technical Director : 
			<?php $Director = DB::table('users')->select(db::raw('*'))->where('dept_category_id', '=', auth::user()->dept_category_id)->where('level_hrd', '=', 'Technical Director')->first();
			echo $Director->first_name;
			echo " ";
			echo $Director->last_name; ?>
			<i>({{ date("M d, Y", strtotime($select->date_ap_spv)) }})</i></li></li>
		@endif

		@if(auth::user()->level_hrd === 'Technical Director')
		
		@endif

	</ul>
<?php }  ?>
	
</html>