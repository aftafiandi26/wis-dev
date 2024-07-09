@extends('layout')

@section('title')
    (fa) Tracking Asset IT
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2001' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">{{$select->dept_category_name}} Asset Inventory</h1> 
    </div>
</div> 
<div class="row" style="margin-bottom: 5px;">
    <div class="col-lg-12">
        <a href="{{route('indexListAssetTracking')}}" class="btn btn-sm btn-default">Back</a>
        <a href="{{route('indexListAccumulution', [$select->id])}}" class="btn btn-sm btn-default">Accumulation {{date('Y')}}</a>         
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables" style="margin-left: auto; margin-right: auto;">
            <thead>
              <tr>
                <th>No</th>
                <th>Purchase Order</th>  
                <th>Brand</th>             
                <th>Series</th>
                <th>Qty</th>
                <th>Currency</th>
                <th>Unit Price</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Usage Period</th>
                <th>Beginning Balance</th>
                <th>Addition</th>
                <th>Calculation</th>
                <th>Monthly Depreciation</th>
                <th>Write (OFF/Sold)</th>
                <th>Ending Balance</th>
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
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0,5,8] }
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
                titleAttr: 'Tracking Asset'
            }],
        ajax: '{!! URL::route("getListAssetTracking") !!}'
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