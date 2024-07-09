<div class="row">
    <div class="col-lg-12">
       <b>Dear Sir/Madam</b>
       <br>
       <p>This is a list of employee schedules:</p>
      	<?php if ($key === "1"): ?>
      	<table class="table-bordered" border="1">
       	<thead>
       		<tr>       		
       			<th colspan="2" style="text-align: center;">{{$dated}}</th>
       		</tr>
       		<tr>       		
       			<th colspan="2" style="text-align: center;">Dormitory To Studio</th>
       		</tr>
       		<tr>
       			<th style="text-align: center;">Time</th>
       			<th style="text-align: center;">Employee</th>
       		</tr>
       	</thead>
       	<tbody>
       		<tr>
       			<td style="text-align: center;">08:00 AM</td>
       			<td style="text-align: center;">{{$time_0800}}</td>
       		</tr>
       		<tr>
       			<td style="text-align: center;">08:20 AM</td>
       			<td style="text-align: center;">{{$time_0820}}</td>
       		</tr>
       		<tr>
       			<td style="text-align: center;">08:40 AM</td>
       			<td style="text-align: center;">{{$time_0840}}</td>
       		</tr>
       		<tr>
       			<td style="text-align: center;">09:00 AM</td>
       			<td style="text-align: center;">{{$time_0900}}</td>
       		</tr>
       		<tr>
       			<td style="text-align: center;">09:20 AM</td>
       			<td style="text-align: center;">{{$time_0920}}</td>
       		</tr>
       		<tr>
       			<td style="text-align: center;">09:40 AM</td>
       			<td style="text-align: center;">{{$time_0940}}</td>
       		</tr>
       	</tbody>
       	<tfoot>
       		<tr>
       			<th style="text-align: center;">Total</th>
       			<th style="text-align: center;">{{$time_0800+$time_0820+$time_0840+$time_0900+$time_0920+$time_0940}}</th>
       		</tr>
       	</tfoot>
       </table>
      <?php elseif ($key === "2"): ?>
      	<table class="table-bordered" border="1">
       	<thead>
       		<tr>       		
       			<th colspan="2" style="text-align: center;">{{$dated}}</th>
       		</tr>
       		<tr>       		
       			<th colspan="2" style="text-align: center;">From Studio To Dormitory</th>
       		</tr>
       		<tr>
       			<th style="text-align: center;">Time</th>
       			<th style="text-align: center;">Employee</th>
       		</tr>
       	</thead>
       	<tbody>  
                <?php if (date('D') === "Sat" or date('D') === "Sun"): ?>
                  <tr>
                        <td style="text-align: center;">05:00 PM</td>
                        <td style="text-align: center;">{{$time_I700}}</td>
                  </tr> 
                <?php endif ?>
       		<tr>
       			<td style="text-align: center;">07:00 PM</td>
       			<td style="text-align: center;">{{$time_I900}}</td>
       		</tr>
       		<tr>
       			<td style="text-align: center;">09:00 PM</td>
       			<td style="text-align: center;">{{$time_Z100}}</td>
       		</tr>
       		<tr>
       			<td style="text-align: center;">11:00 PM</td>
       			<td style="text-align: center;">{{$time_Z300}}</td>
       		</tr>
       	</tbody>
       	<tfoot>
       		<tr>
       			<th style="text-align: center;">Total</th>
       			<th style="text-align: center;">{{$time_I700+$time_I900+$time_Z100+$time_Z300}}</th>
       		</tr>
       	</tfoot>
       </table>
      <?php endif ?>
    </div>
</div>
<div class="row">
<footer>
	<div style="width: 50px;">
	  <p>Regard's,<br>
        - WIS -<br><br></p>
	</div>
</footer>
</div>