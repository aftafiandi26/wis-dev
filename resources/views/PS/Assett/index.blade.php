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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128&display=swap" rel="stylesheet">
<style type="text/css" >
    @font-face {
    font-family: 'LibreBarcode';
    src: url({{ asset('vendor/dompdf/dompdf/lib/fonts/LibreBarcode128Text-Regular.ttf') }}) format("truetype");
}
.tt {
    font-family: "LibreBarcode";
    font-size: 38px;
}
.det{
    font-family: 'Libre Barcode 128', cursive;
     font-size: 48px;
}
</style>
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Asset Producition Services</h1> 
        </div>
    </div> 
<div class="row">
     <div align="right">
        <a style="margin-bottom: 15px;" class="btn btn-sm btn-info" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{{ route('addAssetPS') }}"><span class="fa fa-plus"></span> Add</a>
</div>
</div>
<div class="row">
     <div class="col-lg-12">
<table id="example" class="display" style="width:100%">
         <thead>
                    <tr>
                        <th>No</th>
                        <th>Code ID</th> 
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Series/Type/Model</th>
                        <th>Asset Type</th>
                        <th>Category</th>
                        <th>Date Incoming</th>
                        <th>Asset Category</th>
                        <th>SN</th>
                        <th>Addtional</th>
                        <th>Instansi</th>
                        <th>Embedded</th> 
                        <th>Action</th>                      
                    </tr>
                </thead>
        
        <tfoot>                  
            <tr>
                        <th>No</th>
                        <th>Code ID</th>                  
                        <th>Category</th> 
            </tr>
        </tfoot>
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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>


<script type="text/javascript">  
  pdfMake.fonts = {
        LibreBarcode: {
                normal: 'LibreBarcode128Text-Regular.ttf'             
        }
};
$(document).ready(function() {
    $('#example').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
         "columnDefs": [
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 11] }
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
                titleAttr: 'Download List Asset IT',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                }              
               
            },
             {
                extend: 'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o" style="font-size: 20px;"></i>',
                titleAttr: 'PDF List Asset IT',
                orientation: 'potrait',                
                download: 'open',
                pageSize: 'A4',
                 exportOptions: {
                    columns: [ 1, 2, 3, 4, 6, 7, 9, 10]
                }, 
            }       
            ],
        ajax: '{!! URL::route("getAssetPS") !!}',
              
    } );
} );
         $(document).on('click','#example tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
</script>
