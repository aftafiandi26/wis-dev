<div class="row">
    <p>Dear {{ $data['fullName']}},</p>
    <br>
    <p>You have checked {{ $data['status'] }} at <b>{{ $data['date'] }}</b>.</p>
    <br>
    <br>
    <a href="{!! route('index') !!}">click here to login</a>
    <br><br>
    Regard's,
    <br>
    - WIS -
    <br><br>
</div>