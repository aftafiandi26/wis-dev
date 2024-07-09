<!DOCTYPE html>
<html>
<head>
    <title>Summary Leave</title>
</head> 
<body>
<div class="cointainer-fluid">
    <div class="row">
        <div class="col-lg-12">
            <table>
                <thead>
                    <tr>
                        <th colspan="10" style="text-align: center;">
                            <b>Summary Leave Report</b>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="10" style="text-align: center;">
                            <b>{{ $started }}  -   {{ $ended }}</b>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="row">
       <div class="col-lg-12">
        <table class="table table-sm table-striped table-bordered table-hover table-confidend" width="100%" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Leave Category</th>
                    <th>Nik</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Back to Work</th>
                    <th>Status</th>                 
                </tr>            
            </thead>
            <tbody>
                <?php foreach ($leave as $data): ?>
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->leave_category_name }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->first_name.' '.$data->last_name }}</td>
                        <td>{{ $data->request_dept_category_name }}</td>
                        <td>{{ $data->request_position }}</td>
                        <td>{{ $data->leave_date }}</td>
                        <td>{{ $data->end_leave_date }}</td>
                        <td>{{ $data->back_work }}</td>
                        <td>
                            <?php if ($data->ap_hrd === 1): ?>
                                Confirmed
                            <?php elseif ($data->ap_hrd === 0): ?>
                               Pending
                            <?php else: ?>
                                Disapproved
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    </div>   
</div>
</body>
</html>