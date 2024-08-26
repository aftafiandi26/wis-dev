<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $extended->getUser($extended->create_by)->getFullName() }}</b>, <br><br>
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
                    <td>{{ $extended->getUser($extended->user_id)->getFullName() }}</td>
                    <td>{{ $extended->initial_leave()->initial }}</td>
                    <td>{{ $extended->expired }}</td>
                    <td>{{ $extended->change_to }}</td>
                    <td>{{ $extended->getUser($extended->producer_id)->getFullName() }}</td>
                    <td>{{ $extended->getUser($extended->create_by)->getFullName() }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        Please follow the link below to check.<br>
        <i>production form -> extend of exdo</i>
        <br>
        <br>
        <a href="{{ route('coordinator/exdo-extends/index') }}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>