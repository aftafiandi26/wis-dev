<div class="row">
    <div class="col-lg-12">    	
    	<p>Dear All,</p>
    	<p>{{$getData->created_by}} has been inputting inventory data to the system, for the sake of data validation it is expected to complete it, <br>thank you</p>

   	<table border="1" style="text-align: center;">
   		<thead>
   			<tr>
   				<th>ID</th>
   				<th>Department</th>
   				<th>Instansi</th>
   				<th>Asset Category</th>
   				<th>Brand</th>
   				<th>PO</th>
   				<th>Tracking Number</th>
   				<th>Created</th>
   			</tr>
   		</thead>
   		<tbody>
   			<tr>
   				<td>{{$getData->id}}</td>
   				<td>{{$getData->dept_name}}</td>
   				<td>{{$getData->instansi_name}}</td>
   				<td>{{$getData->asset_category_name}}</td>
   				<td>{{$getData->brand}}</td>
   				<td>{{$getData->po_number1}}/{{$getData->po_number2}}-{{$getData->po_number3}}/{{$getData->po_number4}}/{{$getData->po_number5}}</td>
   				<td><?php if ($getData->tracking_number === null): ?>
   						Null
   					<?php else: ?>
   						$getData->tracking_number
   					<?php endif ?></td>
   				<td>{{$getData->created_by}}</td>
   			</tr>
   		</tbody>
   	</table>
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