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
            <h1 class="page-header">Inventory IT</h1> 
        </div>
    </div> 
<div class="row">
     <div align="right" class="col-lg-12">
        <a style="margin-bottom: 15px;" class="btn btn-sm btn-info" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{{ route('addAsset1') }}"><span class="fa fa-plus"></span> Hardware</a>
         <a style="margin-bottom: 15px;" class="btn btn-sm btn-danger" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{{ route('addAssetSoftware') }}"><span class="fa fa-plus"></span> Software</a>
    </div>
</div>

<div class="row">
    <?php foreach ($cname as $data_cname): ?>
        <div class="col-lg-2" style="margin-bottom: 10px;">
            <a href="{{route('indextAsset1', [$data_cname->key_mark])}}" class="btn btn-sm btn-default form-control">{{$data_cname->category_cname}}</a>
        </div>
    <?php endforeach ?>

</div>
<hr>
<div class="row">
    <div class="col-lg-2" style="margin-bottom: 10px;">
        <a href="{{route('indexAssetSoftware')}}" class="btn btn-sm btn-default form-control">Software</a>
    </div>
</div>
 @stop 


@section('bottom')
      @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
