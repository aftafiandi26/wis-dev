<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $formOvertime->user->getFullName() }}</b>.
        <br><br>
        Your form remote access request above 23:00 was not verify by {{ $formOvertime->itId->getFullName() }}.
        <br>
        <table border="1">
            <tr>
                <th>Request By</th>
                <td>:</td>
                <td>{{ $formOvertime->user->getFullName() }}</td>
            </tr>
            <tr>
                <th>NIK</th>
                <td>:</td>
                <td>{{ $formOvertime->user->nik }}</td>
            </tr>
            <tr>
                <th>Position</th>
                <td>:</td>
                <td>{{  $formOvertime->user->position  }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>:</td>
                <td>{{ $formOvertime->user->getDepartment()  }}</td>
            </tr>
            <tr>
                <th>Project</th>
                <td>:</td>
                <td>{{ $formOvertime->user->getProjectName([$formOvertime->user->project_category_id_1]) }}</td>
            </tr>
            <tr>
                <th>Started</th>
                <td>:</td>
                <td>{{ $formOvertime->startovertime }}</td>
            </tr>
            <tr>
                <th>Ended</th>
                <td>:</td>
                <td>{{ $formOvertime->endovertime }}</td>
            </tr>
            <tr>
                <th>Coordinator</th>
                <td>:</td>
                <td>{{ $formOvertime->coordinator->getFullName() }}</td>
            </tr>           
        </table>
        <br>
        <br>
        Please follow the link below to verify the request..<br><br>
        <a href="{!! route('index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>
