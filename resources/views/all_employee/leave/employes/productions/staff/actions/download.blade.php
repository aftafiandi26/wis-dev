<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $header }}</title>
    <link href="{!! URL::route('assets/css/bootstrap') !!}" rel="stylesheet">
</head>
<style>
    .headline {
        text-align: center;
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 20px;
    }

    td, th {
        border: none;
    }
    img {
        width: 200px;
        height: 80px;
    }
    ul li {
        font-style: italic; 
    }
    .tengah th, .tengah td {
        text-align: center;
    }
</style>
<body>
    <div class="row">
        <div class="col-lg-12">
            <img src="{!! URL::route('assets/img/kinema') !!}" class="img" alt="image">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            
            <h2 class="headline">LEAVE APPLICATION FORM</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed table-borderless">
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
        <div class="col-lg-12">
            <table class="table table-condensed tengah">
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
        <div class="col-lg-12">
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
                    @if ($leave->user()->dept_category_id === 6)
                        @if ($foreachStatment['coordinator'] !== Null)
                                <li>{{ $foreachStatment['coordinator'] }}</li>                            
                        @endif
                        @if ($foreachStatment['spv'] !== Null)
                                <li>{{ $foreachStatment['spv'] }}</li>                            
                        @endif
                        @if ($foreachStatment['projectManager'] !== Null)
                                <li>{{ $foreachStatment['projectManager'] }}</li>                            
                        @endif
                        @if ($foreachStatment['producer'] !== Null)
                                <li>{{ $foreachStatment['producer'] }}</li>                            
                        @endif
                        <li>{{ $foreachStatment['hod'] }}</li>
                    @else
                        <li>{{ $foreachStatment['hod'] }}</li>
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
                    <li>{{ $foreachStatment['frontdesk'] }}</li>
                    <li>{{ $foreachStatment['hrdManager'] }}</li>
                </ul>
            </p>
        </div>
    </div>
</body>
</html>