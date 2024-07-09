<font style="text-align: left; vertical-align: middle; font-weight: bold; font-size: 20pt;">LEAVE ENTITLED REPORT</font>

<br>
<br>
<table style="border: 1px medium #000000;">
    <tbody>
        <tr>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 5px; font-weight: bold; background-color: #D9D9D9;">No.</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 15px; font-weight: bold; background-color: #D9D9D9;">NIK</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 15px; font-weight: bold; background-color: #D9D9D9;">First Name</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 45px; font-weight: bold; background-color: #D9D9D9;">Last Name</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 20px; font-weight: bold; background-color: #D9D9D9;">Status</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 30px; font-weight: bold; background-color: #D9D9D9;">Department</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 15px; font-weight: bold; background-color: #D9D9D9;">End Contract</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 15px; font-weight: bold; background-color: #D9D9D9;">Entitled Leave</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 15px; font-weight: bold; background-color: #D9D9D9;">Entitled Day Off</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 30px; font-weight: bold; background-color: #D9D9D9;">Total Leave and Day Off</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 15px; font-weight: bold; background-color: #D9D9D9;">Leave Taken</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 15px; font-weight: bold; background-color: #D9D9D9;">Day Off Taken</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 30px; font-weight: bold; background-color: #D9D9D9;">Total Leave and Day Off Taken</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 20px; font-weight: bold; background-color: #D9D9D9;">Annual Leave Balance</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 15px; font-weight: bold; background-color: #D9D9D9;">Day Off Balance</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 30px; font-weight: bold; background-color: #D9D9D9;">Total Leave and Day Off Balance</td>
        </tr>

        @foreach($leave_data as $key => $value)
            <tr style="white-space:nowrap;">
                <td style="border: 1px solid #000000; text-align: center; vertical-align: middle;">{!! $key + 1 !!}</td>
                <td style="border: 1px solid #000000; text-align: left; vertical-align: middle;">{!! $value->nik !!}</td>
                <td style="border: 1px solid #000000; text-align: left; vertical-align: left;">{!! $value->first_name !!}</td>
                <td style="border: 1px solid #000000; text-align: left; vertical-align: left;">{!! $value->last_name !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->emp_status !!}</td>
                <td style="border: 1px solid #000000; text-align: left; vertical-align: left;">{!! App\Dept_category::find($value->dept_category_id)->dept_category_name !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! date("M d, Y", strtotime($value->end_date)) !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->entitled_leave !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->entitled_day_off !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->total_leave_and_day_off !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->leave_taken !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->day_off_taken !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->total_leave_and_day_off_taken !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->annual_leave_balance !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->day_off_balance !!}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->total_leave_and_day_off_balance !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>