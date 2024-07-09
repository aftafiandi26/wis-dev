<!DOCTYPE html>
<html>
<head>
    <title>Transportaion</title>
</head>
<body>
<?php use App\Dept_Category; ?>
<table>
    <thead>
        <tr>
            <th colspan="4" rowspan="2" style="text-align: center;">LIST OF TRANSPORTATION BOOKING NAMES</th>
        </tr>
    </thead>
</table>
<table>
    <thead>
        <tr>
            <th>NIK</th>
            <th>Name Employee</th>
            <th>Department</th>
            <th>Date</th>
            <th>Time</th>
            <th>Destination</th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach ($getData as $value): ?>
            <tr>
                <td>{{$value->nik}}</td>
                <td>{{$value->name_employee}}</td>
                <td><?php $k = Dept_Category::where('id', $value->department)->value('dept_category_name'); echo $k; ?></td>
                <td>{{date('M, d Y', strtotime($value->date_booking))}}</td>
                <td>{{$value->time_booking}}</td>
                <td>{{$value->destination}}</td>
                <td>{{date('M, d Y H:i:s', strtotime($value->created_at))}}</td>
            </tr>
        <?php endforeach ?>
    </tbody>   
</table>
</body>
</html>