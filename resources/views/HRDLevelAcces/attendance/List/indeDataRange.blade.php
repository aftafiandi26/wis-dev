@extends('layout')

@section('title')
    (hr) Stocked
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c30030' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Summary Attendance</h1> 
        <h5>Date xxxxx</h5>
    </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
      <thead>
        <tr>
          <th>No</th>
          <th>NIK</th>
          <th>Name</th>
          <th>Department</th>
          <th>Check In</th>
          <th>Check Out</th>
          <th>Date</th>
          <th>Remarks</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop