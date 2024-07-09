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
            <th colspan="9" rowspan="2" style="text-align: center; font-size: 14px;">Sick Employee Summary ({{$category}})<br> <b>{{ date("d-M-Y", strtotime($dateFrom)) }}</b> to <b>{{ date("d-M-Y", strtotime($dateToo)) }}</b></th>
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
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->nik }} </td>
				<td>{{ $data->first_name.' '.$data->last_name }} </td>
				<td>{{ App\Dept_Category::where('id', $data->dept_category_id)->value('dept_category_name') }}</td>
                <td>{{ $data->position }} </td>
                <td>{{ $data->age }}</td>
                <td>{{ date('d-M-Y', strtotime($data->sicked_date)) }}</td>
                <td><?php 
                        $disease = App\MedicalDisease::where('medic_id', $data->id)->pluck('category');
                            $returnDisease = null;
                                foreach ($disease as $diss) {
                                    $returnDisease = $diss;
                                }

                           echo $returnDisease.' - ';                              
                    ?>                    	
                </td>
                <td><?php 
                       $disease = App\MedicalDisease::where('medic_id', $data->id)->pluck('disease');
                            $returnDisease = null;
                                foreach ($disease as $diss) {
                                    $returnDisease = $diss;
                                }

                            echo $returnDisease.' - ';                             
                    ?>
                </td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
</body>
</html>