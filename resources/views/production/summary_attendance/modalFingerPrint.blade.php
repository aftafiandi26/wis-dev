<div class='modal-header'>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
    <h2 class='modal-title text-center' id='showModalLabel'>Attendance</h2>
</div>
<div class='modal-body'>
   <div class="row">
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td rowspan="8">
                    <img src="{{ asset('storage/app/prof_pict/'.$user->prof_pict.'') }}" class="img-fluid img img-circle" alt="img" height="300px">
                </td>
                <td>Name :</td>
                <td>{{ $user->first_name.' '.$user->last_name }}</td>
            </tr>
            <tr>
                <td>Position :</td>
                <td>{{ $user->position }}</td>
            </tr>
            <tr>
                <td>Department :</td>
                <td>{{ $dept->dept_category_name }}</td>
            </tr>
        </tbody>

    </table>
   </div>
</div>
<div class='modal-footer'>
    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
</div>
