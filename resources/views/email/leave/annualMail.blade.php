<style>
    a {
        padding: 8px 12px;      
        border: 1px solid #a8aba6;     
        border-radius: 30px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;     
      
        text-decoration: none;
        font-weight: bold;
        display: inline-block;  
    }  

    a:hover {
        color: rgb(225, 222, 222);       
    }
    
    a:active {        
        box-shadow: 0 5px #666;
        transform: translateY(4px); 
    }
</style>
<div class="row">   
    <div class="col-lg-12">
        Dear Sir/Madam, <br><br>
        There is leave application by: <b>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</b> <i>({{ Auth::user()->position}})</i> that requires approvement.<br>
        Please follow the link below for verify the request.<br><br>
        <table style="text-align: center;">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Start Leave</th>
                    <th>End Leave</th>
                    <th>Request Day</th>
                    <th>Back to Work</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $leave->request_nik }}</td>
                    <td>{{ $leave->request_by }}</td>
                    <td>{{ $leave->request_position }}</td>
                    <td>{{ $leave->request_dept_category_name }}</td>
                    <td>{{ $leave->leave_date }}</td>
                    <td>{{ $leave->end_leave_date }}</td>
                    <td>{{ $leave->total_day }}</td>
                    <td>{{ $leave->back_work }}</td>
                </tr>
            </tbody>          
        </table>
        <br>
        <table>
            <tbody>
                <tr>
                    <td>Start Leave</td>
                    <td>:</td>
                    <th>{{ $leave->leave_date }}</th>
                </tr>
                <tr>
                    <td>End Leave</td>
                    <td>:</td>
                    <th>{{ $leave->end_leave }}</th>
                </tr>
                <tr>
                    <td>Back to Work</td>
                    <td>:</td>
                    <th>{{ $leave->back_work }}</th>
                </tr>
            </tbody>
        </table>

        <br>        
        
        <a href="{{ route('mail.approved', [$leave->id]) }}" class="button">Approved</a>
        <a href="#" class="button">Disappvored</a>
        <br>
        <br>
        <a href="{!! route('index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>