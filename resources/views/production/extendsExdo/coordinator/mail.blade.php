<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $producer->getFullName() }}</b>, <br><br>
        There is extended of exdo expired application need requires your approval.<br>
        <br>
        Please follow the link below to verify the request approval.<br>
        <br>
        <table class="table table-bordered table-condensed" border="1" style="text-align: center;">
            <thead>
                <tr>
                    <th>Form ID</th>
                    <th>Employee</th>
                    <th>Amount</th>
                    <th>Expired</th>
                    <th>Change Expired</th>
                    <th>Create By</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $init->initial_leave_id }}</td>
                    <td>{{ $user->getFullName() }}</td>
                    <td>{{ $init->initial }}</td>
                    <td>{{ $init->expired }}</td>
                    <td>{{ $data['expired'] }}</td>
                    <td>{{ $coor->getFullName() }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        Please follow the link below to check.<br>
        <i>production form -> extend of exdo</i>
        <br>
        <br>
        <a href="{!! route('coordinator/exdo-extends/index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>