@extends('layout')

@section('title')
    (hr) New Project
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
            <h1 class="page-header">Add New Project</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form New Project</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'postNewPrivilege', 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('name', 'Project Name') !!}<font color="red">(*) </font>
                                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Project Name', 'maxlength' => 100, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('name') !!}</p>
                            </div>
                        </div>
                    </div>
                        {!! Form::submit('Save', ['class' => 'btn btn-sm btn-success']) !!}
                        <a class="btn btn-sm btn-warning" href="{!! URL::route('projectHRD') !!}">Back</a>
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