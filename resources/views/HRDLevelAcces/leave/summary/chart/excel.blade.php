<table class="table">
    <thead>
        <tr style="white-space:nowrap">
            <th>No</th>
            <th>Leave Category</th>
            <th>NIK</th>
            <th>Employee</th>
            <th>Department</th>
            <th>Position</th>
            <th>Province</th>
            <th>Hometown</th>
            <th>Start Date</th>
            <th>End Data</th>
            <th>Back to Work</th>
            <th>Request Day</th>
            <th>Status</th>
        </tr>
    </thead>                
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->getLeaveCategory() }}</td>
                <td>{{ $item->getUser()->value('nik') }}</td>
                <td>{{ $item->getUser()->value('first_name') . ' ' . $item->getUser()->value('last_name') }}</td>
                <td>{{ $item->getDepartment() }}</td>
                <td>{{ $item->getUser()->value('position')}}</td>
                <td>{{ $item->r_departure }}</td>
                <td>{{ $item->r_after_leaving }}</td>
                <td>{{ $item->leave_date }}</td>
                <td>{{ $item->end_leave_date }}</td>
                <td>{{ $item->back_work }}</td>
                <td>{{ $item->total_day }}</td>
                <td>@if ($item->ap_hrd === 1)
                        Complate
                    @else
                        progress
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>    