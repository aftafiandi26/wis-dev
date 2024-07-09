@extends('layout')

@section('title')
    (it) Index Asset Item
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1001' => 'active'
    ])
@stop
@section('body')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">List Software</h1> 
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
      <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
        <thead>
          <tr>
            <th>No</th>
            <th>Product</th>
            <th>Software Name</th>
            <th>Version</th>
            <th>Type Software</th>
            <th>Expiring Date</th>
            <th>Price</th>
            <th>Status Software</th>
            <th>Time Limit</th>
            <th>Condition</th>
            <th>Action</th>
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
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
           [1, "asc" ]
        ],
        processing: true,
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": [{
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                titleAttr: 'Download List Workstation'
            }],
        ajax: '{!! URL::route("getListSoftware") !!}'
    }); 
     $(document).on('click','#tables tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });   
   
@stop
