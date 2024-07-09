<div class="row">
    <div class="col-lg-12">
        Dear Sir/Madam, <br><br>
        There is leave application by: <b>{{ $email->first_name}} {{ $email->last_name}}</b> <i>({{ $email->position}})</i> that requires verification.<br>
        Please follow the link below for verify the request.<br>
        <a href="{!! route('index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>