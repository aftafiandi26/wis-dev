@extends('layout')

@section('title')
    (fa) Tracking Asset
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2001' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Inventory Asset</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-12">
        <?php foreach ($select as $value): ?>
        <a href="{{route('indexListAssetTrackingDP', [$value->id])}}" class="btn btn-sm btn-default">{{$value->dept_category_name}}</a>
        <?php endforeach ?>
    </div>
</div>
@stop 


@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 
