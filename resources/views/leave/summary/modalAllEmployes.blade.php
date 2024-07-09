<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <img style="width:170px; height:40px;" src="{!! URL::route('assets/img/kinema') !!}">
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
           <h4 class="text-center"><b>LEAVE APPLICATION FORM</b></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <td>Request</td>
                    <td>:</td>
                    <th>{{ $leave->user()->getFullName() }}</th>
                    <td></td>
                    <td>NIK</td>
                    <td>:</td>
                    <th>{{ $leave->user()->nik }}</th>
                </tr>
                <tr>
                    <td>Period</td>
                    <td>:</td>
                    <th>{{ $leave->period }}</th>
                    <td></td>
                    <td>Position</td>
                    <td>:</td>
                    <th>{{ $leave->user()->position }}</th>
                </tr>
                <tr>
                    <td>Join Date</td>
                    <td>:</td>
                    <th>{{ $leave->user()->join_date }}</th>
                    <td></td>
                    <td>Department</td>
                    <td>:</td>
                    <th>{{ $leave->user()->getDepartment() }}</th>
                </tr>
                <tr>
                    <td>Leave Category</td>
                    <td>:</td>
                    <th>{{ $leave->getLeaveCategory() }}</th>
                    <td colspan="4"></td>                  
                </tr>                
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <p class="text-center"><b>PERSONAL VERIFICATION</b></p>       
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table text-center">
                <tr>
                    <th class="text-center">Period</th>
                    <th class="text-center">Entitlement</th>
                    <th class="text-center">Taken</th>
                    <th class="text-center">Pending</th>
                    <th class="text-center">Request</th>
                    <th class="text-center">Balance</th>
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
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <td>Approved Leave From</td>
                    <td>:</td>
                    <th>{{ $leave->leave_date }}</th>
                    <td>until</td>
                    <th>{{ $leave->end_leave_date }}</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Back to Work at</td>
                    <td>:</td>
                    <th>{{ $leave->back_work }}</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Destination</td>
                    <td>:</td>
                    <th>{{ $leave->r_after_leaving }}</th>
                    <td>-</td>
                    <th>{{ $leave->r_departure }}</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Contact Person</td>
                    <td>:</td>
                    <th>{{ $leave->user()->phone }}</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Reason for Leave</td>
                    <td>:</td>
                    <th colspan="8">{{ $leave->reason_leave }}</th>                  
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if ($leave->ap_hrd === 1)
            <b>Verified By:</b>
            <br>
                <ul>
                    <li> <sup>({{ $leave->date_ap_hrd }})</sup> HR Department</li>
                </ul>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if ($leave->ap_hd === 1)
            <b>Approved By:</b>
            <br>
            <ul>
                <li><sup>({{ $leave->date_ap_hd }})</sup> Head of Deaprtment : {{ $hd->getFullName() }}</li>
            </ul>
            @endif  
        </div>
    </div>
</div> 
