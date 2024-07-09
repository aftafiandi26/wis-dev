<!-- <div class="row">
    <div class="col-lg-12">
        Dear Sir/Madam, <br><br>
        There is leave application by: <b>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</b> <i>({{ Auth::user()->position}})</i> that requires verification.<br>
        Please follow the link below for verify the request.<br>
        <a href="{!! route('index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div> -->
<div class="row">
    <div class="col-lg-12">
        Dear Sir, <br><br>
        Data has been upload by {{Auth::user()->first_name}} {{Auth::user()->last_name}}
        <br>
        <a href="{!! route('index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>