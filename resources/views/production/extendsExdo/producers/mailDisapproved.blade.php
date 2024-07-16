<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $coor->getFullName() }}</b>, <br><br>
        There is extended of exdo expired application has been <b>disapproved</b>.<br>
        <br>
        <table class="table table-bordered table-condensed" border="1" style="text-align: center;">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Amount</th>
                    <th>Expired</th>
                    <th>Change Expired</th>
                    <th>Producer</th>
                    <th>Create By Coordinator</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->getFullName() }}</td>
                    <td>{{ $init->initial }}</td>
                    <td>{{ $init->expired }}</td>
                    <td>{{ $data['expired'] }}</td>
                    <td>{{ $producer->getFullName() }}</td>
                    <td>{{ $coor->getFullName() }}</td>
                </tr>
            </tbody>
        </table>
        <br>
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