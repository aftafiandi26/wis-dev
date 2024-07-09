<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title text-center">Leave Application Form</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-condensed" border="0">
                <tr>
                    <td>Request by</td>
                    <td>:</td>
                    <th>{{ $leave->request_by }}</th>
                    <td></td>
                    <td></td>
                    <td>NIK</td>
                    <td>:</td>
                    <th>{{ $leave->request_nik }}</th>
                </tr>
                <tr>
                    <td>Period</td>
                    <td>:</td>
                    <th>{{ $leave->period }}</th>
                    <td></td>
                    <td></td>
                    <td>Position</td>
                    <td>:</td>
                    <th>{{ $leave->request_position }}</th>
                </tr>
                <tr>
                    <td>Join Date</td>
                    <td>:</td>
                    <th>{{ $leave->user()->join_date }}</th>
                    <td></td>
                    <td></td>
                    <td>Department</td>
                    <td>:</td>
                    <th>{{ $leave->request_dept_category_name }}</th>
                </tr>
                <tr>
                    <td>Contact Address</td>
                    <td>:</td>
                    <th colspan="5">{{ $leave->user()->address }}</th>
                </tr>
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr>
                    <td>Leave Category</td>
                    <td>:</td>
                    <th colspan="5">{{ $leave->leaveName()->leave_category_name }}</th>
                </tr>
            </table>
        </div>
    </div>  
    <div class="row">
        <div class="col-lg-12">
            <h4 class="text-center">Personal Verification</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-condensed">
                <tr>
                    <th>Period</th>
                    <th>Entitlement</th>
                    <th>Taken</th>
                    <th>Pending</th>
                    <th>Requested</th>
                    <th>Balance</th>
                </tr>
                <tr>
                    <td>{{ $leave->period }}</td>
                    <td>{{ $leave->entitlement }}</td>
                    <td>{{ $leave->taken }}</td>
                    <td>{{ $leave->pending }}</td>
                    <td>{{ $leave->total_day }}</td>
                    <td>{{ $leave->remain }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-condensed">              
                <tbody>
                    <tr>
                        <td style="width: 20rem">Approved Leave From</td>
                        <td>:</td>
                        <th>{{ $leave->leave_date }}</th>
                        <td>until</td>
                        <th>{{ $leave->end_leave_date }}</th>
                    
                    </tr>
                    <tr>
                        <td>Back to Work on</td>
                        <td>:</td>
                        <th>{{ $leave->back_work }}</th>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Contact phone during leave</td>
                        <td>:</td>
                        <th>{{ $leave->user()->phone }}</th>
                        <td></td>
                        <td></td>                       
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <table class="table table-condensed">
            <tr>
                <th>Reason :</th>  
            </tr>
            <tr>
                <td>{{ $leave->reason_leave }}</td>
            </tr>
          </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p>
                <b>Status Approve :</b>
                <ul>
                    @if ($leave->user()->hd === 1)
                        <li>General Manager : {{ $foreachStatment['gm'] }}</li>
                    @endif
                </ul>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p>
                <b>Status Verify :</b>
                <ul>
                    <li>General Manager : {{ $foreachStatment['hd'] }}</li>
                    <li>{{ $foreachStatment['ver_hr'] }}</li>
                    <li>HR Manager : {{ $foreachStatment['hrd'] }}</li>
                </ul>
            </p>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
</div>