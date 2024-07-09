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
    iframe {
        width: 100%;
        height: 70vh;
    }
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
       <iframe src="https://3.basecamp.com/4952258/buckets/20262700/message_boards/7482724197" frameborder="0"></iframe>
    </div>
</div>
@stop 
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop