@extends('layout')

@section('title')
    Change Password 
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left')
@stop

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Change Password </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Change Password </b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'post_change-password', 'role' => 'form', 'autocomplete' => 'off']) !!}
                        <div class="row" style="margin: 0 -15px;">
                            <div class="col-lg-4">
                                @if ($errors->has('oldpassword'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('oldpassword', 'Old Password') !!}<font color="red"> (*)</font>
                                    {!! Form::input('password', 'oldpassword', old('oldpassword'), ['class' => 'form-control', 'placeholder' => 'Old Password', 'maxlength' => 30, 'autofocus' => true, 'required' => true, 'id' => 'myInput']) !!}
                                    <p class="help-block">{!! $errors->first('oldpassword') !!}</p>
                                    <p><input type="checkbox" onclick="myFunction()">Show Password</p>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                @if ($errors->has('newpassword'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('newpassword', 'New Password') !!}<font color="red"> (*)</font>
                                    {!! Form::input('password', 'newpassword', old('newpassword'), ['class' => 'form-control' , 'placeholder' => 'New Password', 'maxlength' => 30, 'required' => true, 'id' => 'myInput1']) !!}
                                    <p class="help-block">{!! $errors->first('newpassword') !!}</p>                                    
                                </div>
                            </div>

                            <div class="col-lg-4">
                                @if ($errors->has('confnewpassword'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('confnewpassword', 'Confirm New Password') !!}<font color="red"> (*)</font>
                                    {!! Form::input('password', 'confnewpassword', old('confnewpassword'), ['class' => 'form-control', 'placeholder' => 'Confirm New Password', 'maxlength' => 30, 'required' => true, 'id' => 'myInput2']) !!}
                                    <p class="help-block">{!! $errors->first('confnewpassword') !!}</p>                                    
                                </div>
                            </div>
                        </div>
                        {!! Form::submit('Change', ['class' => 'btn btn-sm btn-success']) !!}
                        <a class="btn btn-sm btn-warning" href="{!! URL::route('index') !!}">Back</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  var x = document.getElementById("myInput1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  var x = document.getElementById("myInput2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
@stop

@section('bottom')
    @include('assets_script_1')
@stop