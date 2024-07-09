<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $email->first_name}} {{ $email->last_name}}</b>,<br><br>
        Your leave application has been approved by <b>{{ $user->first_name }} {{ $user->last_name }}</b>.<br>
        this form will be forwarded to <b>{{ $hr->first_name }} {{ $hr->last_name }}</b><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>

    <div class="col-lg-12">
        <a href="{!! route('index') !!}">click here to login to WIS</a>
    </div>
</div>
