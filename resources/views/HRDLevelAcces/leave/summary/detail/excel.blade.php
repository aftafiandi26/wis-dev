<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Summary Leave</title>
</head>
<body>

<table>
    <thead>
        <tr>
             <th colspan="9" rowspan="2" style="text-align: center; font-size: 14px;">Summary of Leave ({{$category}}) <br> <b>{{ date("d-M-Y", strtotime($dateFrom)) }}</b> to <b>{{ date("d-M-Y", strtotime($dateToo)) }}</b></th>
        </tr>
    </thead>
</table>

<table>
	<thead>
		<tr>
			<th>No</th>
            <th>Leave Category</th>
            <th>NIK</th>                        
            <th>Employee</th>                      
            <th>Department</th>
            <th>Position</th>
            <th>Hometown</th>
            <th>Start Date</th>
            <th>End Data</th>
            <th>Back to Work</th>
            <th>Status</th>
		</tr>
	</thead>
	<tbody>
        <?php foreach ($leave as $key => $data): ?>
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->leave_category_name }}</td>
            <td>{{ $data->nik }}</td>
            <td>{{ $data->first_name.' '.$data->last_name }}</td>
            <td>{{ $data->dept_category_name }}</td>
            <td>{{ $data->position }}</td>
            <td>{{ $data->r_after_leaving }}</td>
            <td>{{ date('d-M-Y', strtotime($data->leave_date)) }}</td>
            <td>{{ date('d-M-Y', strtotime($data->end_leave_date)) }}</td>
            <td>{{ date('d-M-Y', strtotime($data->back_work)) }}</td>
            <td>
                <?php if ($data->ap_hrd === 1): ?>
                Confirmed                                
                <?php endif ?>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>
</html>