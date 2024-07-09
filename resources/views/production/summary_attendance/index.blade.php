@extends('layout')

@section('title')
    Summary Attendance
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Summary Attendance</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="">
            <a href="{{ route('attendance/wfh') }}" class="btn btn-lg btn-default">Work From Home</a>
            <a href="{{ route('attendance/onsite') }}" class="btn btn-lg btn-default">Onsite of Studio</a>
        </div>
    </div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_3')
    @include('assets_script_2')
@stop

@section('script')

@stop
