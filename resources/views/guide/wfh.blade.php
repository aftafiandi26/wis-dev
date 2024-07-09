@extends('layout')

@section('title')
    Guideline - WFH
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
        min-height: 70vh;
    }
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Guideline - WFH</h1> 
    </div>
</div> 
<div class="row">    
    <div class="col-lg-12">
        <iframe src="https://docs.google.com/spreadsheets/d/1UBViWrzughqeKylOpd8BlDGFZizVpWEkkFbK6tZKtec/edit?usp=sharing" frameborder="1"></iframe>
    </div>
</div>
@stop 
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop