@extends('layout')

@section('title')
    (it) Index Request Form
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
        <h1 class="page-header">Requisition</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-12" style="margin-bottom: 25px;">
        <a href="{{route('CreateForm')}}" class="btn btn-sm btn-info">Create Request Form</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover" width="100%" id="tables" style="margin-left: auto; margin-right: auto;">
            <thead>
               <tr>
                <th  rowspan="2" style="text-align: center;">No</th>
                <th  rowspan="2" style="text-align: center;">Id Ticket</th>
                <th  rowspan="2" style="text-align: center;">Request Date</th>
                <th  rowspan="2" style="text-align: center;">Category Request</th>
                <th  rowspan="2" style="text-align: center;">Priority Status</th>
                <th  colspan="3" style="text-align: center;">Acknowledged By</th>
                <th  colspan="1" style="text-align: center;">Executed By</th>
                <th  rowspan="2" style="text-align: center;">Status Form</th>
                <th  rowspan="2" style="text-align: center;">Closing Date</th>
                </tr>
                <tr>
                <th style="text-align: center;">Reporter</th>
                <th style="text-align: center;">Producer</th>
                <th style="text-align: center;">IT Manager</th>
                <th style="text-align: center;">IT Support</th>
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