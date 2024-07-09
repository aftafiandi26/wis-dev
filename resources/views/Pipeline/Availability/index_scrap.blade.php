@extends('layout')

@section('title')
    Scapped - WS Availability
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
            <h1 class="page-header">Scrapped Workstations</h1> 
        </div>
    </div> 
     <div class="col-lg-12">
  <!--   @if(auth::user()->position === 'Junior IT Support' or auth::user()->position === 'Senior IT Support')
      <div align="right">
        <a style="margin-bottom: 15px;" class="btn btn-sm btn-info" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{{ route('add-WS') }}"><span class="fa fa-plus"></span> Add</a>
      </div>
    @endif -->

       <div>   
       <table class="table table-striped table-bordered table-hover"width="100%" id="tables">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hostname</th>
                        <th style=" width: 60px;">Type</th>
                        <th>User</th>
                        <th>OS</th>
                        <th>Memory</th>
                        <th>VGA</th>
                        <th>Location</th>
                        <th style=" width: 80px;">Notes</th>
                        <th>Updated Time</th>
                      @if(auth::user()->dept_category_id === 1)
                         <th>Action</th>   
                       @endif
                       
                    
                    </tr>
                </thead>
            </table>
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
        ajax: '{!! URL::route("get_index_ScrappedPipeline") !!}'
    });    
   
@stop

