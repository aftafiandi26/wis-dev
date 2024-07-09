@extends('layout')

@section('title')
    (hr) Stocked
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop
@section('body')
<!-- isi blade -->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Stationery Stock</h1> 
    </div>
</div>
<div class="col-sm-12">
    <a href="{{route('Statoonery/addStockStatoonary')}}" class="btn btn-sm btn-default pull-right">Add Stock</a>
     <table width="100%" id="tables" class="table table-hover">
        <thead>
            <tr>
               <th rowspan="2" style="text-align: center;">No</th>
                <th rowspan="2" style="text-align: center;">Kode Barang</th>
                <th rowspan="2" style="text-align: center;">Item</th>
                <th rowspan="2" style="text-align: center;">Satuan</th>
                <th rowspan="2" style="text-align: center;">Merk</th>
                <th rowspan="2" style="text-align: center;">Stock</th>
                <th colspan="31" style="text-align: center;">Date Items Exited</th>
                <th rowspan="2" style="text-align: center;">Total Items Exited</th>
                <th rowspan="2" style="text-align: center;">IN (Purchase)</th>
                <th rowspan="2" style="text-align: center;">Balance Stock</th>
                <th rowspan="2" style="text-align: center;">Update Stock</th>
                <th colspan="2" style="text-align: center;">Action</th>
                
            </tr>
            <tr>                
                 <?php for ($i=1; $i <=31 ; $i++) { 
                    echo "<th>$i</th>";
                 } ?>
                  <th>IN</th>
                  <th>Out</th>
            </tr>
        </thead>
    </table>
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
            [ 1, "asc" ]
        ],
        "processing": true,
        "scrollX": true,
        "dom": 'Blfrtip',
        "buttons": ['excel'],
        ajax: '{!! URL::route("getstokstoonery") !!}'
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