<!DOCTYPE html>
<html>
<head>
    <title>Comment - Canteen</title>
</head>
<body>
<table id="1" border="1">
    <thead>
        <tr>
            <th colspan="12" style="text-align: center;"> Comment - Canteen</th>
        </tr>
        <tr>
            <th style="text-align: center;">No</th>
            <th colspan="3" style="text-align: center;">Name Employee</th>
            <th colspan="7" style="text-align: center;">Comment</th>
            <th style="text-align: center;">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach ($data as $value): ?>
        <tr>
            <td style="text-align: center;">{{$no++}}</td>
            <td colspan="3">{{$value->name_employee}}</td>
            <td colspan="7">{{$value->comment}}</td>
            <td style="text-align: center;">{{date('M, d-Y', strtotime($value->date_entry))}}</td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
</body>
</html>