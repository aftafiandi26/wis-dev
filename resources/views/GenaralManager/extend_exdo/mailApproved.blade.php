<div class="row">
    <div class="col-lg-12">
        Dear <b>HRD</b>, <br><br>
        There is extended of exdo expired application need requires your verification.<br>
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
                    <td>{{ $extended->getUser($extended->user_id)->getFullName() }}</td>
                    <td>{{ $extended->initial_leave()->initial }}</td>
                    <td>{{ $extended->initial_leave()->expired }}</td>
                    <td>{{ $extended->expired }}</td>
                    <td>{{ $extended->getUser($extended->producer_id)->getFullName() }}</td>
                    <td>{{ $extended->getUser($extended->create_by)->getFullName() }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        Please follow the link below to checked.<br>
        <br>
        <a href="{{ route('gm/exdo-extended/index') }}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>