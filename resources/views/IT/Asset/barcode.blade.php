@extends('layout')

@section('title')
    (it) Index Asset Item
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
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
        <h1 class="page-header">{{$getData->brand}} {{$getData->ifw_code}}</h1> 
    </div>
</div>
@stop 


@section('bottom')
      @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
