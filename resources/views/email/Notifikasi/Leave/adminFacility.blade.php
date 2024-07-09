<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $adminFacility->first_name}} {{ $adminFacility->last_name}}</b>, <br><br>
        <b>{{ Auth::user()->first_name }} {{ Auth::user()->limitations }} ({{ Auth::user()->position }})</b> have submitted a leave form.
        <br>
        You can find it in the leave menu -> summary leave (Facility).

       <br>
       <br>
        Please follow the link below to check your leave.<br>
        <a href="{!! route('index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>