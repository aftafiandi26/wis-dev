<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Leave Category</th>
            <th>Nik</th>
            <th>Employee</th>
            <th>Leave Date</th>
            <th>End Leave Date</th>
            <th>Back to Work</th>
            <th>Total Day</th>
            <th>Status Form</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d => $t)
        <tr>
            <td>{{ ++$d }}</td>
            <td>Exdo</td>
            <td>{{ $user->nik }}</td>
            <td>{{ $user->first_name.' '.$user->last_name }}</td>
            <td>{{ $t->leave_date }}</td>
            <td>{{ $t->end_leave_date }}</td>
            <td>{{ $t->back_work }}</td>
            <td>{{ $t->total_day }}</td>
            <td>
                @if ($user->hd == 0)
                @if ($t->ap_koor == 0)
                    Pending Coordinator
                @else
                    @if ($t->ap_spv == 0)
                        Pending SPV
                    @else
                        @if ($t->ap_pm == 0)
                            Pending PM
                        @else
                            @if ($t->ap_hd == 0)
                                Pending Head of Department
                            @else
                                @if ($t->ver_hr == 0)
                                    Pending HR Verification
                                @else
                                    @if ($t->ap_hrd == 0)
                                        Pending HR Manager
                                    @else
                                        Completed
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endif
                @endif
              @else
                @if ($t->ap_gm == 0)
                    Pending GM
                @else
                    @if ($t->ver_hr == 0)
                        Pending HR Verification
                    @else
                        @if ($t->ap_hrd == 0)
                            Pending HR Manager
                        @else
                            Completed
                        @endif
                    @endif
                @endif                  
              @endif
            </td>
        </tr>
            
        @endforeach
    </tbody>
</table>