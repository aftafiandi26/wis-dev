<!DOCTYPE html>
<html>

<head>
    <title>Attendnance</title>
</head>

<body>
    <p>Hi HRD,</p>
    <p>Please these attendance employee :</p>
    <table class="table" border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Employee</th>
                <th>Position</th>
                <th>Feel</th>
                <th>Heatlh</th>
                <th>Why?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pasData as $data)
                <tr>
                    <td>{{ $data['no'] }}</td>
                    <td>{{ $data['nik'] }}</td>
                    <td>{{ $data['fullname'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['feel'] }}</td>
                    <td>{{ $data['health'] }}</td>
                    <td>{{ $data['why'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <p>Regard's</p>
    <p>-WIS-</p>
</body>

</html>
