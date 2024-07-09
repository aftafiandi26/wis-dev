@extends('layout')

@section('title')
    (it) New Asset Item
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
        <h1 class="page-header">Create Requisition</h1> 
    </div>
</div>
<form>
{{ csrf_field() }}
<div class="row">
     <div class="col-lg-2">
        @if ($errors->has('ticket'))
            <div class="form-group has-error">
        @else
            <div class="form-group">
        @endif
        {!! Form::label('ticket', 'No Ticket') !!}<font color="red"> (*)</font>
        {!! Form::text('ticket',  old('ticket'), ['class' => 'form-control', 'maxlength' => 10, 'required' => true]) !!}
        <p class="help-block">{!! $errors->first('ticket') !!}</p>
             </div>
    </div>
    <div class="col-lg-2">
        @if ($errors->has('request_date'))
            <div class="form-group has-error">
        @else
            <div class="form-group">
        @endif
        {!! Form::label('request_date', 'Request Date') !!}<font color="red"> (*)</font>
        {!! Form::date('request_date',  old('request_date'), ['class' => 'form-control', 'maxlength' => 10, 'required' => true]) !!}
        <p class="help-block">{!! $errors->first('request_date') !!}</p>
             </div>
    </div>
    <div class="col-lg-2">
        @if ($errors->has('email_reporter'))
            <div class="form-group has-error">
        @else
            <div class="form-group">
        @endif
        {!! Form::label('email_reporter', 'Email Reporter') !!}<font color="red"> (*)</font>
        {!! Form::select('email_reporter', $list_email, old('email_reporter'), ['class' => 'form-control', 'maxlength' => 10, 'required' => true]) !!}
        <p class="help-block">{!! $errors->first('email_reporter') !!}</p>
             </div>
    </div>

 </div>
</form>
@stop

@section('bottom')
    @include('assets_script_1')
@stop
    

