@extends('layout')

@section('title')
    (it) Index List Software
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
            <h1 class="page-header">Inventory Software</h1> 
        </div>
</div>
<div class="row">
  <div class="col-lg-12" style="margin-bottom: 10px;">
     <!-- <a href="{{route('SendMailReminderSoftwareMail')}}" class="btn btn-sm btn-info">email</a>  -->  
     <a href="{{route('indexUtamaAsset')}}" class="btn btn-sm btn-info">back invetory</a> 
     @if(auth::user()->position === "IT Admin" or auth::user()->position === "Senior Information & Technology Manager" or auth::user()->position === "Junior Programmer")
     <a class="btn btn-sm btn-danger  pull-right" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{{ route('addAssetSoftware') }}"><span class="fa fa-plus"></span> Software</a>
     @endif
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
      <thead>
        <tr>         
          <th>ID</th>          
          <th>Product</th>
          <th>Software Name</th>  
          <th>Version</th>
          <th>Purchase Date</th>        
          <th>Expiring Date</th>  
          <th>Type Software</th>         
          <th>Status Software</th>
          <th>Time Limit</th>
          <th>Condition</th>
          <th>Add User</th>
          <th>Detail</th>
          @if(auth::user()->position === "IT Admin" or auth::user()->position === "Senior Information & Technology Manager" or auth::user()->position === "Junior Programmer")
          <th>Edit</th>
          <th>Delete</th>
          @endif
        </tr>
      </thead>
    </table>
  </div>
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
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [] }
        ],
        "order": [
           [1, "asc" ]
        ],
        processing: true,
        responsive: true,          
         "dom": 'Blfrtip', 
          "buttons": [{
                extend:    'excel',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                title: 'List Software',
                filename: 'List Software'
            }],
        ajax: '{!! URL::route("GetAssetSoftware") !!}'
    });
@stop
