@extends('layout')

@section('title')
    Add Initial Leave
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1' => 'active'
    ])
@stop

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Entitlement  Leave</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Add Entitlement Leave</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['mgmt-data/initial/store', $users->id], 'role' => 'form', 'autocomplete' => 'off']) !!}
                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('NIK'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('nik', 'NIK') !!}
                					{!! Form::text('nik', $users->nik, ['class' => 'form-control', 'placeholder' => 'NIK', 'maxlength' => 20, 'required' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('nik') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('first_name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('first_name', 'First Name') !!}
                                    {!! Form::text('first_name', $users->first_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'maxlength' => 20, 'required' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('first_name') !!}</p>
                            </div>
                        </div>

                            <div class="col-lg-2">
                                @if ($errors->has('last_name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('last_name', 'Last Name') !!}
                					{!! Form::text('last_name', $users->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name', 'maxlength' => 20, 'required' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('last_name') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('department'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('department', 'Department') !!}
                                    {!! Form::text('department', $department, ['class' => 'form-control', 'placeholder' => 'Department', 'maxlength' => 20, 'required' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('department') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('input_date'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('input_date', 'Input Date') !!}<font color="red"> (*)</font><br>
                                    {!! Form::date('input_date', null, ['class' => 'form-control', 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('input_date') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('exp_date'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('exp_date', 'Expiry Date') !!}<font color="red"> (*)</font><br>
                                    {!! Form::date('exp_date', null, ['class' => 'form-control', 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('exp_date') !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('leave_category_id'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('leave_category_id', 'Leave Category') !!}<font color="red"> (*)</font>
                                    {!! Form::select('leave_category_id', $leave, old('leave_category_id'), ['class' => 'form-control', 'maxlength' => 5, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('leave_category_id') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                 @if ($errors->has('initial'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('initial', 'Entitlement Leave') !!}<font color="red"> (*)</font>
                                    {!! Form::text('initial', old('initial'), ['class' => 'form-control', 'placeholder' => 'Number', 'maxlength' => 2, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('initial') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                @if ($errors->has('note'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('note', 'Note') !!}
                                    {!! Form::text('note', old('note'), ['class' => 'form-control', 'placeholder' => 'Note', 'maxlength' => 20]) !!}
                                    <p class="help-block">{!! $errors->first('note') !!}</p>
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Add', ['class' => 'btn btn-sm btn-success']) !!}
                        <a class="btn btn-sm btn-warning" href="{!! URL::route('mgmt-data/initial') !!}">Back</a>
                        {!! Form::close() !!}
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
@stop