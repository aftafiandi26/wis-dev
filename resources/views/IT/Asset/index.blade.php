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
        'c2' => 'active'
    ])
@stop
@section('body')
<style type="text/css">
th, td {
    text-align: center;
}
.fixed_header{
    width: auto;
    table-layout: fixed;
    border-collapse: collapse;
}

.fixed_header tbody{
  display:block;
  width: auto;
  overflow-x: auto;
  height: 500px;
}

.fixed_header thead tr {
   display: block;
}

.fixed_header thead {
  background: lightblue;
  color: black;
}

.fixed_header th, .fixed_header td{
  padding: 5px;
  text-align: center;
}
</style>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.min.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Asset {{$label->category_cname}}</h1> 
    </div>
</div>
<div class="container-fluid">
<div class="row">
    <div class="pull-left">
       <a style="margin-bottom: 15px;" class="btn btn-sm btn-default" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{{ route('indexUtamaAsset') }}">Back</a>    
    </div>
     <div class="pull-right">
        <a style="margin-bottom: 15px;" class="btn btn-sm btn-danger" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{{route('pdfBarcodeAssetTrackingAll', [$label->key_mark])}}" target="_blank">pdf barcode</a>
        <a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{{route('pdfIFWCodeAssetTrackingAll', [$label->key_mark])}}" target="_blank">ifw code</a>
        <a style="margin-bottom: 15px;" class="btn btn-sm btn-info" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{{ route('addAsset1') }}"><span class="fa fa-plus"></span> Add</a>
    </div>
</div>    
</div> 

 <div class="row">
    <div class="col-lg-12">
     <div class="">        
        <table id="example" class="table table-striped table-bordered table-condensed" border="1" width="100%">
         <thead>
                    <tr>
                        <th >No</th>
                        <th >Barcode</th>
                        <th >Category Type</th>
                        <th >Category Name</th>
                        <th >Brand</th>
                        <th >Series</th>
                        <th >Serial Number</th>
                        <th >Asset Category</th>
                        <th >IFW Code</th>
                        <th >Action</th>
                    </tr>                  
        </thead>      
         <tbody id="myTable">           
            <?php use App\Asset_Tracking; $no = 1; foreach ($marker_key as $key): ?>
                <tr>
                    <td >{{$no++}}</td>
                    <td >{{$key->barcode}}</td>
                    <td >{{$key->category_type_name}}</td>
                    <td >{{$key->category_name_name}}</td>
                    <td >{{$key->brand}}</td>
                    <td >{{$key->series}}</td>
                    <td >{{$key->serial_number}}</td>
                    <td >{{$key->asset_category_name}}</td>
                    <td >{{$key->ifw_code}}</td>                   
                    <td >
                        <a  class="btn btn-sm btn-default" href="{{ route('detailAssetTracking', [$key->id] )}}" title="Detail">detail</a>
                        <a href="{{route('editAssetTracking', [$key->id])}}" class="btn btn-sm btn-warning">edit</a> 
                        <a href="#" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#myModal">delete</a> 
                        <a href="{{route('indexBarcodeAsset', $key->id)}}" data-toggle="modal" data-target="#barcode" class="btn btn-sm btn-primary">barcode</a>
                    </td>
                </tr>
                 <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Delete Asset Item</h4>
                        </div>
                        <div class="modal-body">
                            <?php $getting = Asset_Tracking::where('id', $key->id)->first();  ?>
                          <p>Are You Sure To Delete Data Asset <br><b>{{$getting->barcode}}?</b></p>
                        </div>
                        <div class="modal-footer">
                          <a href="{{route('deleteAssetTracking', [$getting->id])}}" class="btn btn-sm btn-danger">delete</a>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               
               <div class="modal fade" id="barcode" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content" id="modal-content">
                          <!--  -->
                      </div>
                  </div>
              </div>
            <?php endforeach ?> 
        </tbody>      
    </table>

</div>
</div>
</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function() {
    $('#example').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        },
         "responsive": true,
         /*"rowReorder": true,
        "scrollY": 300,
        "paging": false*/
    } );
} );
</script>
 @stop 


@section('bottom')
      @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
