@extends('layout')

@section('title')
   (hr) Data Employee
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3003' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <h2>List National Days</h2>
    <hr class="my-5">
</div>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-12">
        <a href="{{route('addViewOffYears')}}" class="btn btn-xs btn-primary" title="Add Data National Day"><span class="fa fa-plus-square"></span></a>
    </div>
</div> 
<div class="row">
   <div class="col-lg-12">
       <table class="table table-hover table-bordered table-condensed" id="tables">
           <thead style="text-align: center;">
               <tr>
                   <th>No</th>
                   <th>Date</th>
                   <th>National Day</th>
                   <th>Action</th>
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
@section('script')
 $('#tables').DataTable({
       
        processing: true,
        responsive: true,      
        
       ajax: '{!! URL::route("getDataViewOffYears") !!}' ,

       columns: [
          { data: 'DT_Row_Index', orderable: false, searchable : false},    
          { data: 'dated'},
          { data: 'national_day'},
          { data: 'actions'}
       ]

    }); 
@stop