<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nik</th>
            <th>Employee</th>
            <th>Department</th>
            <th>Position</th>
            <th>Status</th>
            <th>Expired</th>
            <th>Initial Exdo</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $a => $d)
            <tr>
                <td>{{ ++$a }}</td>
                <td>{{ $user->nik }}</td>
                <td>{{ $user->first_name.' '.$user->last_name }}</td>
                <td>{{ $dept }}</td>
                <td>{{ $user->position }}</td>
                <td>{{ $user->emp_status }}</td>
                <td>{{ $d->expired }}</td>
                <td>{{ $d->initial }}</td>
                <td>{{ $d->note }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Total Initial Exdo</th>
            <th>{{ $data->pluck('initial')->sum() }}</th>
            <th></th>
        </tr>
    </tfoot>
</table>