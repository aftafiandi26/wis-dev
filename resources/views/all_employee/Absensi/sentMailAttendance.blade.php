<!DOCTYPE html>
<html>

<head>
    <title>Email</title>
</head>

<body>
    <p>Hi Administrator,</p>
    <p>There is a new presence, we can check below:</p>
    <ul>
        <li><strong>Employee:</strong> {{ $user->getFullName() }}</li>
        @foreach ($attendance as $key => $value)
            <li><strong>{{ $key }}:</strong> {{ $value }}</li>
        @endforeach
    </ul>
    <br>
    <p>Regard's</p>
    <p>-WIS-</p>
</body>

</html>
