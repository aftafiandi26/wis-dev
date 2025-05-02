<p>Dear {{ $data['to'] }}</p>
<br>
<p>This is reminder, please follow up about this</p>
<p>Employee said : {{ $data['message'] }}</p>
<table class="table table-hover" border="1" style="text-align: center">
    <tbody>
        <tr>
            <td>Leave Category</td>
            <td>:</td>
            <th>{{ $category->leave_category_name }}</th>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <th>{{ $leave->request_nik }}</th>
        </tr>
        <tr>
            <td>Employee</td>
            <td>:</td>
            <th>{{ $leave->request_by }}</th>
        </tr>
        <tr>
            <td>Position</td>
            <td>:</td>
            <th>{{ $leave->request_position }}</th>
        </tr>
        <tr>
            <td>Department</td>
            <td>:</td>
            <th>{{ $leave->request_dept_category_name }}</th>
        </tr>
        <tr>
            <td>Leave Date</td>
            <td>:</td>
            <th>{{ $leave->leave_date }} until {{ $leave->end_leave_date }}</th>
        </tr>
        <tr>
            <td>Back to Work</td>
            <td>:</td>
            <td>{{ $leave->back_work }}</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>:</td>
            <th>{{ $leave->total_day }}</th>
        </tr>
    </tbody>
</table>
