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
<style type="text/css">
    tr:nth-child(even) {background-color: #f2f2f2;}
    a {
        color: black;
    }
</style>
<?php 
use App\stationary_count;
use App\stationary_transaction;
 ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Stationary Stock Mineral Water</h1> 
    </div>
</div>
<div class="row">
<div class="col-lg-12">
    <a href="{{route('addStockStationaryWater')}}" class="btn btn-sm btn-default">Add Stock</a>
    <a href="{{route('GenerateStockedWater')}}" class="btn btn-sm btn-success" target="_blank">PDF</a> 
    <a href="{{route('ExcelStationaryStockWater')}}" class="btn btn-sm btn-info">Excel</a>   
    <br>
    <br>
    <label style="margin-bottom: -10px;">Periode: {{date('F Y')}}</label><br>
    <label>Stock Awal: {{date('F Y', strtotime('-1 month'))}}</label><br>   
</div>
</div>
<div class="row">
<div class="col-lg-2 pull-right">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for items.." title="Type in a name item" class="form-control">         
</div>
</div>
<div class="row">
<div class="col-lg-12" style="margin-left: 0px; overflow-x: scroll; margin-top: 10px;"> 
    <table id="myTable" class="table table-hover fixed_headers table-bordered table-condensed" border="1">
        <thead>
            <tr>
                  <th rowspan="2" style="text-align: center;">No</th>               
                  <th rowspan="2" style="text-align: center;">Code Item</th>                
                  <th rowspan="2" style="text-align: center;">Item</th>
                  <th rowspan="2" style="text-align: center;">UOM</th>
                  <th rowspan="2" style="text-align: center;">Brand</th>
                  <th rowspan="2" style="text-align: center;">Stock</th>
                  <th colspan="31" style="text-align: center;">Date Items Out <i>{{date('F Y')}}</i></th>
                  <th rowspan="2" style="text-align: center;">Total Items Out</th>
                  <th rowspan="2" style="text-align: center;">IN (Purchase)</th>
                  <th rowspan="2" style="text-align: center;">Balance Stock</th>
                  <th rowspan="2" style="text-align: center;">Date Stocked</th>
                  <th colspan="3" style="text-align: center;">Action</th>
            </tr>
            <tr>              
                  <?php for ($i=1; $i <=31 ; $i++) { 
                     echo "<th>$i</th>";
                  } ?>
                  <th style="text-align: center;">In</th>
                  <th style="text-align: center;">Out</th>
                  <th style="text-align: center;">Edit</th>                 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($waters as $key => $value): ?>
            <tr>
                  <td style="text-align: center;">{{$no++}}</td>
                  <td style="text-align: center;">{{$value->kode_barang}}</td>
                  <td style="text-align: left;">{{$value->name_item}}</td>
                  <td style="text-align: center;">{{$value->satuan}}</td>
                  <td style="text-align: center;">{{$value->merk}}</td>
                  <td style="text-align: center;">{{$value->stock_barang}}</td>               
                  @for ($i = 1; $i <= 31; $i++)
                  <td style="text-align: center;">
                    {{-- inidia --}}
                    <a data-toggle="modal" data-target="#showModal" title="view" data-role="{{ route('mineral/modalMineralViewTable', [$value->kode_barang, $i]) }}">
                        {{ stationary_transaction::where('key_param', 2)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock',date('m'))->whereDay('date_out_stock', $i)->pluck('out_stock')->sum() }} 
                    </a>                                              
                  </td>
                  @endfor              
                  <td style="text-align: center;">{{$value->total_out_stock}}</td>
                  <td style="text-align: center;">{{ stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y'))->whereMonth('date_in_stock', date('m'))->pluck('in_stock')->sum() }}</td>
                  <td style="text-align: center;">{{$value->balance_stock}}</td>
                  <td style="text-align: center;">{{date('M, d-Y', strtotime($value->date_stock))}}</td>
                  
                  <td><a href="{{route('indexInStockStationaryWater', [$value->id])}}" class="btn btn-xs btn-default" id="in">In</a></td>
                  <td><a href="{{route('indexOutStockStationaryWater', [$value->id])}}" class="btn btn-xs btn-default" id="out">Out</a></td>
                  <td><a href="{{route('editStockStationaryWater', [$value->id])}}" class="btn btn-xs btn-default" id="edit">Edit</a></td>                   
               </tr>
            <?php endforeach ?>
            <tfoot>                
               <tr>
                  <th colspan="5" style="text-align: right;">Total</th>
                  <th style="text-align: center;">{{ $waters->pluck('stock_barang')->sum() }}</th>

                  @for ($i = 1; $i <= 31; $i++)
                  <th style="text-align: center;">
                     {{ stationary_transaction::where('key_param', 2)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock',date('m'))->whereDay('date_out_stock', $i)->pluck('out_stock')->sum() }}                          
                  </th>
                  @endfor

                  <th style="text-align: center;">{{ $waters->pluck('total_out_stock')->sum() }}</th>
                  <th style="text-align: center;">{{ $waters->pluck('in_purchase')->sum() }}</th>
                  <th style="text-align: center;">{{ $waters->pluck('balance_stock')->sum() }}</th>
                  <th colspan="6"></th>
               </tr>
            </tfoot>
        </tbody>
    </table>
</div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
           
        </div>
    </div>
</div>

<div class="modal fade" id="showModalDelete" tabindex="-1" role="dialog" aria-labelledby="showModalLabelDelete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content-delete">
           
        </div>
    </div>
</div>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop

@section('script')
$(document).on('click','#myTable tr td a[title="view"]',function(e) {
    var id = $(this).attr('data-role');
    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
}); 

@endsection