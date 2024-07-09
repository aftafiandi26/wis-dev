<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Details FOrm</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed">
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <th>{{ $leave->user()->nik }}</th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <th>{{ $leave->user()->getFullName() }}</th>
                </tr>
                <tr>
                    <td>Position</td>
                    <td>:</td>
                    <th>{{ $leave->user()->position }}</th>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>:</td>
                    <th>{{ $leave->user()->getDepartment() }}</th>
                </tr>
                <tr>
                        <td>Contact Address</td>
                        <td>:</td>
                        <th>{{ $leave->user()->address . ", " . $leave->user()->area . ", " . $leave->user()->city }}</th>
                </tr>
                <tr>
                    <td>Leave Category</td>
                    <td>:</td>
                    <th>{{ $leave->leaveName()->leave_category_name }}</th>
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
                    <td>Back to Work</td>
                    <td>:</td>
                    <th>{{ $leave->back_work }}</th>
                </tr>
                <tr>
                    <td>Total Annual</td>
                    <td>:</td>
                    <th>{{ $leave->pending }}</th>
                </tr>
                <tr>
                    <td>Request Day</td>
                    <td>:</td>
                    <th>{{ $leave->total_day }}</th>
                </tr>
                <tr>
                    <td>Total Balance</td>
                    <td>:</td>
                    <th>{{ $leave->remain }}</th>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed table-hover table-striped">
                <tr>
                    <td>Destionation</td>
                    <td>:</td>
                    <th>{{ $leave->r_departure." - ".$leave->r_after_leaving }}</th>
                </tr>
                <tr>
                    <td>Reason</td>
                    <td>:</td>
                    <td>{{ $leave->reason_leave }}</td>
                </tr>
                <tr>
                    <td>Status Form</td>
                    <td>:</td>
                    <th>{{ $status }}</th>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
