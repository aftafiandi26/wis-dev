<div class="row">
    <div class="col-lg-12">
        Dear Sir/Madam, <br><br>
        There is leave application by: <b>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</b> <i>({{ Auth::user()->position}})</i> project <b> <?php $f = DB::table('users')->where('users.id', '=', Auth::user()->id)->join('project_category', 'users.project_category_id_1', '=', 'project_category.id')->value('project_category.project_name'); echo $f;?></b> that requires approved.<br>
        Please follow the link below for verify the request.<br>
        <a href="{!! route('index') !!}">click here to login</a><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
</div>
