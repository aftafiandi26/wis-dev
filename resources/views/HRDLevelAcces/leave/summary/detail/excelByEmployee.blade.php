<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Leave Category</th>
            <th>Nik</th>
            <th>Employee</th>
            <th>Department</th>
            <th>Positon</th>
            <th>Leave Date</th>
            <th>End Leave Date</th>
            <th>Back to Work</th>
            <th>Total Day</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $value) : ?>
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $leaveCategory->leave_category_name }}</td>
                <td>{{ $value->request_nik }}</td>
                <td>{{ $value->request_by }}</td>
                <td>{{ $value->request_dept_category_name }}</td>
                <td>{{ $value->request_position }}</td>
                <td>{{ $value->leave_date }}</td>
                <td>{{ $value->end_leave_date }}</td>
                <td>{{ $value->back_work }}</td>
                <td>{{ $value->total_day }}</td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
