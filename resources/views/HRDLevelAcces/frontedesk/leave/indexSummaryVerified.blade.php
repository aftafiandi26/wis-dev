@extends('layout')

@section('title')
    (hr) Summary Verifeid
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
        <h1 class="page-header">Summary Verified</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-12">
        <form class="form-inline" action="{{ route('getDataHistoricalVerified') }}" method="GET">
              {{ csrf_field() }}
          <div class="form-group">
            <label for="started">Search Date:</label>
            <input type="date" class="form-control" id="started" name="started" required>
          </div>
          <div class="form-group">
            <label for="ended"> - </label>
            <input type="date" class="form-control" id="ended" name="ended" required>
          </div>       
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-sm table-striped table-bordered table-hover table-confiden" width="100%" id="tables">
            <thead>
            	<tr>
            		<th>No</th>
            		<th>Leave Category</th>
            		<th>Nik</th>
            		<th>Name</th>
            		<th>Department</th>
            		<th>Position</th>
            		<th>Start Date</th>
            		<th>End Date</th>
            		<th>Back to Work</th>
            		<th>Status</th>
            		<th>HR Manager <br> Confirm</th>
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
   $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [] }
        ],      
        processing: true,        
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": [{
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                titleAttr: 'Summary Verified'
            }],
        ajax: '{!! URL::route("getDataSummaryVerified") !!}',
        columns: [
                	{ data: 'DT_Row_Index', orderable: false, searchable : false},  
                	{ data: 'leave_category_name'},
                	{ data: 'request_nik'},
                	{ data: 'request_by'},
                	{ data: 'dept_category_name'},
                	{ data: 'position'},
                	{ data: 'leave_date'},
                	{ data: 'end_leave_date'},
                	{ data: 'back_work'},
                	{ data: 'ver_hr'},
                	{ data: 'ap_hrd'}
                ],

    }); 
   
   
@stop
