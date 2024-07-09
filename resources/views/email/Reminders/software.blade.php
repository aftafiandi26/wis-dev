<div class="row">
    <div class="col-lg-12">    	
    	<p>Dear All,</p>
    	<p>Just want to inform that our software license to will be expired, kindly help to renew it before the date listed below <br>
        Please check before the expiration date.</p>

    	<table border="1">
    		<thead>
    			<tr>
    				<th>Product</th>
    				<th>Software Name</th>
    				<th>Version</th>
                    <th>Type</th>
                    <th>Status</th>
    				<th>Expiring Date</th>
    				<th>Time Limit</th>
                    <th>Condition</th>
    			</tr>
    		</thead>
    		<tbody class="text-center">
    			<?php foreach ($getData as $value): ?>
    			<tr>
    				<td>{{$value->product}}</td>
    				<td>{{$value->name_software}}</td>
    				<td>{{$value->version}}</td>
                    <td>{{$value->type_software}}</td>
                    <td>{{$value->status_software}}</td>
    				<td>{{date('M, d Y', strtotime($value->expiring_date))}}</td>
    				<td><?php 
    				$date1=date_create($value->expiring_date);
					$date2=date_create(date("Y-m-d"));
					$diff=date_diff($date2,$date1);
					echo $diff->format("%R%a days");
    				 ?></td>
                     <td><?php if ($value->expiring_date === date('Y-m-d', strtotime("now"))): ?>
                       Expired 
                     <?php else: ?>
                       End Soon   
                     <?php endif ?>
                    </td>
    			</tr>
    			<?php endforeach ?>
    		</tbody>    		
    	</table>

    	<p>Please click link below for more detail:<br>
        URL : <a href="{{route('index-outside', [$id])}}">List Software</a></p> 
   </div>
</div>

<!--  -->
<div class="row">
<footer>
	<div style="width: 50px;">
	  <p>Regard's,<br>
        - WIS -<br><br></p>
     
</footer>
</div>