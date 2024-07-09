<div class="row">
    <div class="col-lg-12">
        Dear Sir/Madam, <br><br>
        There is leave application by: <b>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</b> <i>({{ Auth::user()->position}})</i> has been verificated.<br>
        Please follow the link below for check again.<br>
        <a href="{!! route('index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>