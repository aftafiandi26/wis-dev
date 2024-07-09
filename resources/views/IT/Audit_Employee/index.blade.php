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
            <h1 class="page-header">Create Login Employee</h1> 
        </div>
    </div> 
     <div class="col-lg-12">
       <div>   
       <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIK</th>
                        <th>First Name</th>
                        <th>Last Name</th> 
                        <th>Action</th>                    
                    </tr>
                </thead>
            </table>
        </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
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
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
           [0, "asc" ]
        ],
         processing: true,
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": [{
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                titleAttr: 'Download List Workstation'
            }],
        ajax: '{!! URL::route("get-audit") !!}'
    });    
   
@stop


