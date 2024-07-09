@extends('layout')

@section('title')
    (hr) Add User Project
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
            <h1 class="page-header">Add User Project</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Add Project</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['hr_mgmt-data/project/store'], 'role' => 'form', 'autocomplete' => 'off']) !!}
                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('user'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('user', 'NIK') !!}
                                    {!! Form::select('user', $user, old('user'), ['class' => 'form-control', 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('user') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('proj1'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('proj1', 'project 1') !!}
                                    {!! Form::select('proj1', $project, old('project'), ['class' => 'form-control', 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('proj1') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('proj2'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('proj2', 'project 2') !!}
                                    {!! Form::select('proj2', $project, old('project'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('proj2') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('proj3'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('proj3', 'project 3') !!}
                                    {!! Form::select('proj3', $project, old('project'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('proj3') !!}</p>
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Add', ['class' => 'btn btn-sm btn-success']) !!}
                        <a class="btn btn-sm btn-warning" href="{!! URL::route('hr_mgmt-data/project') !!}">Back</a>
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