{{ $data['message'] }}
<br>
<br>
Username: {{ $freelance->fullname() }}
<br>
By {{ auth()->user()->getFullName() }}
