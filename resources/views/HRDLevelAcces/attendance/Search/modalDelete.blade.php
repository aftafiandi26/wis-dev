<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Attendance</h4>
</div>
<div class="modal-body">
    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <table class="table table-condensed table-stripe">
                <tbody>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <th>{{ $data->getUser()->nik }}</th>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <th>{{ $data->getUser()->getFullName() }}</th>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td>:</td>
                        <th>{{ $data->getUser()->getDepartment() }}</th>
                    </tr>
                    <tr>
                        <td>Check In</td>
                        <td>:</td>
                        <th>{{ $data->timeIN }}</th>
                    </tr>
                    <tr>
                        <td>Check Out</td>
                        <td>:</td>
                        <th>{{ $data->timeOUT }}</th>
                    </tr>
                    <tr>
                        <td>Total Time</td>
                        <td>:</td>
                        <th>{{ $waktu }}</th>
                    </tr>
                </tbody>
            </table>
            <h4>Are u sure delete this data?</h4>
        </div>



    </div>
</div>
<div class="modal-footer">
    <form action="{{ route('editGetListDataAttendance/modalDelete/post', $data->id) }}" method="post">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-sm btn-danger">delete</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </form>
</div>
