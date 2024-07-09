<div class="row">
    <div class="col-lg-12">
        Dear {{ $email2->first_name }} {{ $email2->last_name }},<br><br>
        Your leave application has been unverified by {{ $email2->ver_hr_by }} (HR).<br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>        
    
    <div class="col-lg-12">
        <a href="{!! route('index') !!}">click here to log into WIS</a>
    </div>
</div>