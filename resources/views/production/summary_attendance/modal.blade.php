<div class='modal-header'>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
    <h2 class='modal-title text-center' id='showModalLabel'>Attendance</h2>
</div>
<div class='modal-body'>
   <div class="row">
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td rowspan="9">
                    <img src="{{ asset('storage/app/prof_pict/'.$user->prof_pict.'') }}" class="img-fluid img img-circle" alt="img" height="250px" width="250px">
                </td>
                <td>Name :</td>
                <td>{{ $user->first_name.' '.$user->last_name }}</td>
            </tr>
            <tr>
                <td>Nick Name :</td>
                <td><b>{{ $user->nickname }}</b></td>
            </tr>
            <tr>
                <td>Position :</td>
                <td>{{ $user->position }}</td>
            </tr>
            <tr>
                <td>Department :</td>
                <td>{{ $dept->dept_category_name }}</td>
            </tr>
            <tr>
                <td>Time IN :</td>
                <td>{{ $absences->timeIN }}</td>
            </tr>
            <tr>
                <td>Time Out :</td>
                <td>{{ $absences->timeOUT }}</td>
            </tr>
            <tr>
                <td>Date Attendance :</td>
                <td>{{ $absences->date_check_in }}</td>
            </tr>
            <tr>
                <td>Working Hours :</td>
                <td>{{ $waktu }}</td>
            </tr>
            <tr>
                <td>Phone :</td>
                <td>
                    @if ($user->dept_category_id == 6)
                        {{ $user->phone }}
                    @endif
                    @if ($user->dept_category_id == 4)
                        {{ $user->phone }}
                    @endif
                </td>
            </tr>
        </tbody>
        <
    </table>
   </div>
</div>
<div class='modal-footer'>
    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
</div>
