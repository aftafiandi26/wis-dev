@extends('layout')

@section('title')
    (it) Index Voting
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
        <h1 class="page-header">testing</h1> 
    </div>
</div> 
<div class="row">
	<iframe src="https://docs.google.com/spreadsheets/d/1NTNS0aYE98URsYdFi4cpLCLKW3DlbEjPJ5z3B8peZU0/edit?usp=sharing" width="1024" height="680" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
</div>
 @stop 


@section('bottom')
      @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 

