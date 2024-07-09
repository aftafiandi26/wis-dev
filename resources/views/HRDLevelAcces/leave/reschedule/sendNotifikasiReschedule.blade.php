Dear {{ $data->user()->getFUllName() }},
<br>
<br>
We tell you that your leave schedule has been updated.
<br>
<br>
<table class="table" border="1">
   <tbody>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $data->user()->nik }}</td>
        </tr>
        <tr>
            <td>Employee</td>
            <td>:</td>
            <td>{{ $data->user()->getFUllName() }}</td>
        </tr>
        <tr>
            <td>Position</td>
            <td>:</td>
            <td>{{ $data->user()->position }}</td>
        </tr>
        <tr>
            <td>Department</td>
            <td>:</td>
            <td>{{ $data->request_dept_category_name }}</td>
        </tr>
        <tr>
            <td>Category</td>
            <td>:</td>
            <td>{{ $data->leaveName()->leave_category_name }}</td>
        </tr>
        <tr>
            <td>Start Leave</td>
            <td>:</td>
            <td>{{ $data->leave_date }}</td>
        </tr>
        <tr>
            <td>End Leave</td>
            <td>:</td>
            <td>{{ $data->end_leave_date }}</td>
        </tr>
        <tr>
            <td>Back to work</td>
            <td>:</td>
            <td>{{ $data->back_work }}</td>
        </tr>
        <tr>
            <td>Request Day</td>
            <td>:</td>
            <td>{{  $data->total_day }}</td>
        </tr>
        <tr>
            <td>Coordinator</td>
            <td>:</td>
            <td>{{  $coordinator }}</td>
        </tr>
        <tr>
            <td>Supervisor</td>
            <td>:</td>
            <td>{{ $spv }}</td>
        </tr>
        <tr>
            <td>Project Manager</td>
            <td>:</td>
            <td>{{ $projectManager }}</td>
        </tr>
        <tr>
            <td>Producer</td>
            <td>:</td>
            <td>{{ $producer }}</td>
        </tr>
   </tbody>
</table>
<br>
<br>
Please follow the link below to verify the request. 
<br>
<a href="{{ route('index') }}">click here to login </a>
<br>
<br>
Regard's, 
<br>
-WIS - 

