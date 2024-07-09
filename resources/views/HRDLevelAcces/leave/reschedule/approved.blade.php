<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td>Leave Category</td>
                <td>:</td>
                <th>{{ $leave->leaveName()->leave_category_name }}</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>:</td>
                <th>{{ $leave->user()->getFullName() }}</th>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <th>{{ $leave->request_nik }}</th>
            </tr>
            <tr>
                <td>Position</td>
                <td>:</td>
                <th>{{ $leave->user()->position }}</th>
            </tr>
            <tr>
                <td>Department</td>
                <td>:</td>
                <th>{{ $leave->request_dept_category_name }}</th>
            </tr>
            <tr>
                <td>Start Leave</td>
                <td>:</td>
                <th>{{ $leave->leave_date }}</th>
            </tr>
            <tr>
                <td>End Leave</td>
                <td>:</td>
                <th>{{ $leave->end_leave_date }}</th>
            </tr>
            <tr>
                <td>Request Day</td>
                <td>:</td>
                <th>{{ $leave->total_day }}</th>
            </tr>
        </tbody>
    </table>
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td>Status : <b>{{ $status }}</b></td>                
            </tr>
            <tr>
                <th>{{ $returnName }}</th>
            </tr>           
        </tbody>
    </table>
    <br>
    <p>
        <b>Are you sure approve this?</b>
    </p>
    <form action="{{ route('leave/reschedule/approved/post', [$leave->id]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $leave->id }}">
        <button type="submit" class="btn btn-sm btn-success">Yes</button>
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
    </form>
    <br>   
</div>
<div class="modal-footer">
    
</div>