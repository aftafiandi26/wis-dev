@extends('layout')

@section('title')
(hr) Import Data Employee
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@include('assets_css_4')
@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c3' => 'active'
])
@stop
@section('body')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Import Data Employee</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div align="right">
            <a style="margin-bottom: 10px;" class="btn btn-sm btn-primary" data-original-title="Add Data Employee" data-toggle="tooltip" data-placement="top" href="{!! URL::route('employee') !!}"><span class="glyphicon glyphicon-arrow-left" style="font-size: 20px;"> </span></a>
        </div>
    </div>
    <div class="col-lg-12">
        <div align="right">
            <a class="btn btn-sm btn-danger" data-original-title="Add Data Employee" data-toggle="tooltip" data-placement="top" href="{!! URL::route('exportProject') !!}"><span class="glyphicon glyphicon-cloud-download" style="font-size: 20px;"></span></a>
        </div>
        <hr class="my-5">
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-3">
            <a href="{{route('form/insser/data/NewEmploye')}}"> Get Form - New Empoyes</a>
        </div>
        <div class="col-lg-3">
            <a href="{{route('getget')}}"> Get Form - Uploaded for Date</a>
        </div>
        <div class="col-lg-3">
            <a href="{{route('getget2')}}"> Get Form - Uploaded for Address, NPWP, BPJS</a>
        </div>
        <hr class="my-5">
    </div>
</div>

<div class="row">
    <div class="col-lg-12" style="margin-bottom: 15px;">
        {!! Form::open(['route' => 'upload', 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
        <div class="input-group">
            <span class="input-group-addon" style="width: 250px; text-align: left;">Insert Data Employee</i></span>
            <input type="file" name="photo" id="photo" class="form-control" style="line-height: 0px; min-height: 50px;">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit" style="min-height: 50px;"><i class="fa fa-upload"></i></button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="row">
    <div class="col-lg-12" style="margin-bottom: 15px;">
        {!! Form::open(['route' => 'upload-update', 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
        <div class="input-group">
            <span class="input-group-addon" style="width: 250px; text-align: left;">Update Data Employee - <strong>Date</strong></i></span>
            <input type="file" name="photo" id="photo" class="form-control" style="line-height: 0px; min-height: 50px;">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit" style="min-height: 50px;"><i class="fa fa-upload"></i></button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="col-lg-12" style="margin-bottom: 15px;">
        {!! Form::open(['route' => 'Address', 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
        <div class="input-group">
            <span class="input-group-addon" style="width: 250px; text-align: left;">Update Data Employee - <strong>Address,<br>NPWP, BPJS</strong></i></span>
            <input type="file" name="photo" id="photo" class="form-control" style="line-height: 0px; min-height: 50px;">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit" style="min-height: 50px;"><i class="fa fa-upload"></i></button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('bottom')
@include('assets_script_1')
@include('assets_script_2')
@include('assets_script_7')
@stop
