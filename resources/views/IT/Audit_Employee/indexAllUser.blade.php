@extends('layout')

@section('title')
    (it) Index Data Employee
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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.uikit.min.css">
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New Employes</h1> 
        </div>
    </div> 
     <div class="col-lg-12">
       <div>   
       <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
						<th>Username</th>
						<th>Employes</th>
						<th>Status</th>
						<th>Join Date</th>
                        <th>End Date</th>
						<th>Department</th>
                        <th>Position</th>
                        <th>Action</th>                        
                    </tr>
                </thead>
            </table>
        </div>        
 <div class="modal fade bd-example-modal-lg" id="showEmployes" tabindex="-1" role="dialog" aria-labelledby="showEmployesLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" id="contentModal">
        
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
        
        processing: true,
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": [{
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                titleAttr: 'Download List Workstation'
            }],
        ajax: '{!! URL::route("indexALLUSER/data") !!}',
        columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable : false},                
                    { data: 'nik'} ,
                    { data: 'username'},
                    { data: 'fullName'},
                    { data: 'emp_status'},   
                    { data: 'join_date'},
                    { data: 'end_date'},
                    { data: 'department'},  
                    { data: 'position'},
                    { data: 'action'}  
                ],
    });    
   
@stop


