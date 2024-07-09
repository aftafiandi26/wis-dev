@extends('layout')

@section('title')
    Change Password User
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1u' => 'collape in',
        'c1' => 'active', 'c15' => 'active'
    ])
@stop

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Change Password  User</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Change Password  User</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['mgmt-data/user/update-password', $users->id], 'role' => 'form', 'autocomplete' => 'off']) !!}
                        <div class="row">
                            <div class="col-lg-4">
                                @if ($errors->has('username'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('username', 'Username') !!}
                					{!! Form::text('username', $users->username, ['class' => 'form-control', 'placeholder' => 'Username', 'maxlength' => 20, 'required' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('username') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                @if ($errors->has('newpassword'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('newpassword', 'New Password') !!}<font color="red"> (*)</font>
                                    {!! Form::input('password', 'newpassword', old('newpassword'), ['class' => 'form-control', 'placeholder' => 'New Password', 'maxlength' => 30, 'autofocus' => true, 'required' => true]) !!}
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
                                    {!! Form::input('password', 'confnewpassword', old('confnewpassword'), ['class' => 'form-control', 'placeholder' => 'Confirm New Password', 'maxlength' => 30, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('confnewpassword') !!}</p>
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Change', ['class' => 'btn btn-sm btn-success']) !!}
                        <a class="btn btn-sm btn-warning" href="{!! URL::route('mgmt-data/user') !!}">Back</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
@stop