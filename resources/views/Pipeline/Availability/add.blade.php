@extends('layout')

@section('title')
    (it) New WS Availability
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
            <h1 class="page-header"> Add Workstation</h1>                     
        </div>
    </div>
   <div class="panel-body">
                    {!! Form::open(['route' => 'storeAddWS', 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    {{ csrf_field() }}
                 <div class="row">
                    <div class="col-lg-2">
                                @if ($errors->has('hostname'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('hostname', 'Hostname') !!}
                                    {!! Form::text('hostname', old('hostname'), ['class' => 'form-control', 'placeholder' => 'WORK001', 'maxlength' => 100, 'autofocus' => true, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('hostname') !!}</p>
                                </div>
                            </div>
                       
                        <div class="col-lg-2">
                                @if ($errors->has('type'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('type', 'Type') !!}
                                    {!! Form::select('type', $wstype, old('type'), ['class' => 'form-control', 'maxlength' => 1000, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('type') !!}</p>
                                </div>
                            </div>
                         <div class="col-lg-2">
                                @if ($errors->has('user'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('user', 'Username') !!}
                                    {!! Form::text('user', old('user'), ['class' => 'form-control', 'placeholder' => 'Enter a Workstation Username', 'maxlength' => 100, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('user') !!}</p>
                                </div>
                            </div> 

                    <div class="col-lg-2">
                                @if ($errors->has('os'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('os', 'Operating System') !!}
                                    {!! Form::select('os', $OSS, old('os'), ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('os') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('memory'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('memory', 'Memory') !!}
                                    {!! Form::number('memory', old('memory'), ['class' => 'form-control', 'min' => '0', 'max' => '64', 'maxlength' => 100, 'autofocus' => true, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('memory') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('vga'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('vga', 'VGA') !!}
                                    {!! Form::text('vga', old('vga'), ['class' => 'form-control', 'placeholder' => 'Enter VGA Used', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('vga') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('location'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('location', 'Location') !!}
                                    {!! Form::select('location', $map_area, old('location'), ['class' => 'form-control', 'placeholder' => 'Enter Location WS', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('location') !!}</p>
                                </div>
                            </div>                       
                            <div class="col-lg-10">
                                @if ($errors->has('notes'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('notes', 'Notes') !!}
                                    {!! Form::text('notes', old('notes'), ['class' => 'form-control', 'placeholder' => 'Enter Your Notes', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('notes') !!}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-2">
                                @if ($errors->has('no_seat'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('no_seat', 'No Seat') !!}
                                    {!! Form::number('no_seat', old('no_seat'), ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('no_seat') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('main_workstation'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('main_workstation', 'Status Workstation')!!}
                                    {!! Form::select('main_workstation', $stat_ws, old('main_workstation'), ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('main_workstation') !!}</p>
                                </div>
                            </div> 
                            <div class="col-lg-2">
                                @if ($errors->has('main_monitor'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('main_monitor', 'Main Monitor') !!}
                                    {!! Form::text('main_monitor', old('main_monitor'), ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('main_monitor') !!}</p>
                                </div>
                            </div> 
                            <div class="col-lg-2">
                                @if ($errors->has('secondary_monitor'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('secondary_monitor', 'Secondary Monitor') !!}
                                    {!! Form::text('secondary_monitor', old('secondary_monitor'), ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('secondary_monitor') !!}</p>
                                </div>
                            </div>
                            <hr>
                              <div class="col-lg-12">  
                                {!! Form::submit('Add', ['class' => 'btn btn-sm btn-success']) !!}
                            <a class="btn btn-sm btn-warning" href="{!! URL::route('indexIT') !!}">Back</a>
                            {!! Form::close() !!}
                            </div>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('bottom')
      @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop