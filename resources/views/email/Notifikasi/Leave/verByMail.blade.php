<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $email->first_name}} {{ $email->last_name}}</b>, <br><br>
        Your leave form has been approved by <b>{{$deptHead->first_name}} {{$deptHead->last_name}}</b> and will be forwarded to HRD.
       <br>
       <br>
        Please follow the link below to check your leave.<br>
        <a href="{!! route('index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>