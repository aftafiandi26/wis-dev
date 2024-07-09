<p>Dear {{ $user->getFullName() }}</p>
<p>For your information  of the <b>{{ Illuminate\Support\Str::lower($data->getLeaveCategory()) }} leave</b> deductions that have been created.</p>
<table class="table table-bordered table-condensed table-strip" style="text-align: center; border: 5px;" border="true">
    <tr>
        <th>NIK</th>
        <th>Employee</th>
        <th>Request</th>
    </tr>
    <tr>
        <td>  {{ $user->nik }} </td>
        <td>  {{ $user->getFullName() }}  </td>
        <td>{{ $data['total_day'] }}</td>
    </tr>
</table>
<br>
<table style="text-align: left;">
    <tr>
        <td>Leave Date</td>
        <td>:</td>
        <th>{{ date('F, d Y', strtotime($data['leave_date'])) }}</th>
        <td><small>until</small></td>
        <th>{{ date('F, d Y', strtotime($data['end_leave_date'])) }}</th>
    </tr>
    <tr>
        <td>Back to Work</td>
        <td>:</td>
        <th colspan="3">{{ date('F, d Y', strtotime($data['back_work'])) }}</th>
    </tr>
    <tr>
        <td>Reason</td>
        <td>:</td>
        <td colspan="3">{{ $data['reason_leave'] }}</td>
    </tr>
</table>
<p>Please follow the link below to check your leave.
<br><a href="{{ route('index') }}">click here to login</a></br>
<br>
<p>Regard's, <br> -WIS-</p>
