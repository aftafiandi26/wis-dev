@extends('layout')

@section('title')
    organization chart
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

@push('style')
<style>
    
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Organization Chart</h1> 
    </div>
</div> 
<div class="row">    
    <div class="col-lg-12">
        <img src="https://static.wixstatic.com/media/64b66f_66a39437f26542209e603d4a58ae85b2~mv2.jpg/v1/fill/w_980,h_813,al_c,q_85,usm_4.00_1.00_0.00,enc_auto/IFW_ORG_CHART_V9_edited_edited.jpg" alt="chart" srcset="">
    </div>
</div>
@stop 
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop