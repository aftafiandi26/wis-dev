<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sick Employee Summary</title>
</head>
<body>
<table>
    <thead>
        <tr>
             <th colspan="9" rowspan="2" style="text-align: center; font-size: 14px;">Sick Employee Summary ({{$category}}) <br> <b>{{ date("d-M-Y", strtotime($dateFrom)) }}</b> to <b>{{ date("d-M-Y", strtotime($dateToo)) }}</b></th>
        </tr>
    </thead>
</table>
<table>
	<thead>
		<tr style="text-align: center;">
			<th>No</th>
            <th>NIK</th>                        
            <th>Employee</th>                      
            <th>Department</th>
            <th>Position</th>
            <th>Age</th>
            <th>Date Sicked</th>
            <th>Category</th>
            <th>Disease</th>
		</tr>
	</thead>
	<tbody>
		 <?php foreach ($medic as $key => $data): ?>
            <?php 
                $disease = App\MedicalDisease::where('medic_id', $data->id)->first();
            ?>
            <?php if ($disease->category === $category): ?>
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nik }}</td>
                    <td>{{ $data->first_name.' '.$data->last_name }}</td>
                    <td>{{ App\Dept_Category::where('id', $data->dept_category_id)->value('dept_category_name') }}</td>
                    <td>{{ $data->position }}</td>
                    <td>{{ $data->age }}</td>
                    <td>{{ $data->sicked_date }}</td>
                    <td>{{ $disease->category }}</td>
                    <td>{{ $disease->disease }}</td> 
            <?php endif ?>         
		<?php endforeach ?>
	</tbody>
</table>
</body>
</html>