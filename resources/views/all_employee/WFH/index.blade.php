@extends('layout')

@section('title')
    Troubleshooting Guidelines (WFH)
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1994' => 'active'
    ])
@stop

@section('body')
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Troubleshooting Guidelines (WFH)</h1> 
        </div>
</div>
<div class="row">
    <div class="col-lg-12" style="margin-bottom: 10px;">
        <a class="btn btn-sm btn-info" href="{{ 'guidelines/download' }}" target="_blank">download</a>
    </div>
    <div class="col-lg-12" >
      <iframe src="https://docs.google.com/document/d/e/2PACX-1vTe-eHWv-PquocxFciIll4QwI9tzsxlR5bu43_LZ1D7kF3ogOsWnHkpgt7ZhvaNDw/pub" style="width: 100%; height: 700px;"></iframe>
    </div>
</div>
@stop 

@section('bottom')
      @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop  
