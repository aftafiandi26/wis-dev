Dear {{ $data->getFullName() }},
<br>
<p>
    We inform you, {{ $leave->request_by }} leave form has been in your WIS for too long, for that HRD has taken a policy
    agree, we hope that in the future you will agree.   
</p>
<table class="table" border="1">
    <tbody>
         <tr>
             <td>NIK</td>
             <td>:</td>
             <td>{{ $leave->user()->nik }}</td>
         </tr>
         <tr>
             <td>Employee</td>
             <td>:</td>
             <td>{{ $leave->request_by }}</td>
         </tr>
         <tr>
             <td>Position</td>
             <td>:</td>
             <td>{{ $leave->user()->position }}</td>
         </tr>
         <tr>
             <td>Department</td>
             <td>:</td>
             <td>{{ $leave->request_dept_category_name }}</td>
         </tr>
         <tr>
             <td>Category</td>
             <td>:</td>
             <td>{{ $leave->leaveName()->leave_category_name }}</td>
         </tr>
         <tr>
             <td>Start Leave</td>
             <td>:</td>
             <td>{{ $leave->leave_date }}</td>
         </tr>
         <tr>
             <td>End Leave</td>
             <td>:</td>
             <td>{{ $leave->end_leave_date }}</td>
         </tr>
         <tr>
             <td>Back to work</td>
             <td>:</td>
             <td>{{ $leave->back_work }}</td>
         </tr>
         <tr>
             <td>Request Day</td>
             <td>:</td>
             <td>{{  $leave->total_day }}</td>
         </tr>        
    </tbody>
 </table>
 <br>
 <br>
Please follow the link below to check this. 
<br>
<a href="{{ route('index') }}">click here to login </a>
<br>
<br>
Regard's, 
<br>
-WIS - 