
<?php 
use App\Leave_Category;
use App\Entitled_leave_view;
 ?>
 <table class="table table-bordered">
    <thead>
        <tr>
           <th rowspan="2">NIK</th>
           <th rowspan="2">Name Employee</th>         
           <th rowspan="2">Department</th>
           <th rowspan="2">Leave Category</th>
           <th rowspan="2">Start Leave</th>
           <th rowspan="2">End Leave</th>
           <th rowspan="2">Back to Work</th>
           <th rowspan="2">Total Day</th>
           <th colspan="2">Remain</th>
           <th colspan="2">Remark</th>
        </tr>
        <tr>
           <th></th>
           <th></th>         
           <th></th>
           <th></th>
           <th></th>
           <th></th>
           <th></th>
           <th></th>          
           <th>Annual</th>
           <th>Exdo</th>
           <th>Departure</th>
           <th>Reason</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($getData as $key => $data): ?>
            <?php 
            $Leave_Category = Leave_Category::find($data->leave_category_id);
            $Entitled_leave_view = Entitled_leave_view::where('nik', $data->request_nik)->first();
             ?>
        <tr>
            <td>{{$data->request_nik}}</td>
            <td>{{$data->request_by}}</td>
            <td>{{$data->request_dept_category_name}}</td>
            <td>{{$Leave_Category->leave_category_name}}</td>
            <td>{{date('M, d Y', strtotime($data->leave_date))}}</td>
            <td>{{date('M, d Y', strtotime($data->end_leave_date))}}</td>
            <td>{{date('M, d Y', strtotime($data->back_work))}}</td>
            <td>{{$data->total_day}}</td>
            <td>{{$Entitled_leave_view->annual_leave_balance}}</td>
            <td>{{$Entitled_leave_view->day_off_balance}}</td>
            <td>{{strtolower($data->r_departure)}}</td>
            <td>{{strtolower($data->reason_leave)}}</td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>