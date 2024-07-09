<div class="row">
    <div class="col-lg-12">
        Dear {{ $email->first_name }} {{ $email->last_name }},<br><br>
        Your leave application has been disapproved by <b> {{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}</b>.<br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>        
    
    <div class="col-lg-12">
        <a href="{!! route('index') !!}">click here to log into WIS</a>
    </div>
</div>