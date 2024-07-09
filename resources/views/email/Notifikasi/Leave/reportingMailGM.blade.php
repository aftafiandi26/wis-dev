 <div class="row">
    <div class="col-lg-12">
        Dear Mr. {{ $mike->first_name.' '.$mike->last_name }}, <br><br>
        <p>We need your approval, for HOD's leave with details below :</p>
        <br>     
        <table border="1">
            <tr>
                <td>Employee Name</td>
                <td>:</td>
                <td><b>{{ $email->first_name.' '.$email->last_name }}</b></td>
            </tr>
            <tr>
                <td>Position</td>
                <td>:</td>
                <td><i>{{ $email->position }}</i></td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td>:</td>
                <td>{{ date('D, d F Y', strtotime($email->leave_date)) }}</td>
            </tr>
            <tr>
                <td>End Date</td>
                <td>:</td>
                <td>{{ date('D, d F Y', strtotime($email->end_leave_date)) }}</td>
            </tr>
            <tr>
                <td>Back to Work</td>
                <td>:</td>
                <td>{{ date('D, d F Y', strtotime($email->back_work)) }}</td>
            </tr> 
            <tr>
                <td>Total Days</td>
                <td>:</td>
                <td>{{ $email->total_day }} 
                    <?php if ($email->total_day > 1): ?>
                        Days
                    <?php else: ?>
                        Day
                    <?php endif ?>
                </td>
            </tr>           
            <tr>
                <td>Reason</td>
                <td>:</td>
                <td>{{ $email->reason_leave }}</td>
            </tr>
        </table>
    <br>
    Checked and Verified by : 
    <br>
        Wahyuni Hasan (HR Manager)
    <br>  
    <?php if ($email->dept_category_id === 2): ?>
        Approved by :
        <br>
        Oh Sow Kim (ifw)
    <?php elseif ($email->dept_category_id === 6): ?>
        Approved by :
        <br>
        Seng Choonmeng (ifw)
    <?php elseif ($email->dept_category_id === 5): ?>
        Approved by :
        <br>
        John Radel (Head of Studio - Production Services (LS))
    <?php else: ?>
        
    <?php endif ?>
    <br>
    <br>
    Thank you.
    <br>
    <br>
    Please follow the link below for check again.<br>
    <a href="{!! route('index') !!}">click here to login</a><br><br> 
     <br>
        Regard's,<br>
        - WIS -<br><br>
    </div>  
</div>