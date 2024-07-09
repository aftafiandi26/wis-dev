@extends('layout')

@section('title')
    (hr) Stationery (atk)
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')     

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'cd3' => 'active'
    ])
      
@stop

@push('style')
    <style>
        .myinput {
            margin-bottom: 10px;
            margin-top: -50px;
        }
        .ahover {
            color: black;
        }
        
        table#myTable tbody .waters td:hover {
            background-color: lightgray;
        }       

        table#myTable {
            display: inline-block;
            height:600px;
            overflow: scroll;
            width: 100%;
        } 

        .stock:hover {
            background-color: lightcoral;
            color: white;
        }
        .pdf:hover {
            background-color: darkgoldenrod;
            color: whitesmoke;
        }
        .excel:hover {
            background-color: lightseagreen;
            color: white;
        }
        .category td {
            background-color: rgb(237, 230, 230);
        }
        a#viewCategory {
            color: black;
        }
        input#category {
            text-transform: uppercase;
        }        
    </style>
@endpush
@section('body')

<?php 
    use App\stationary_stock;
    use App\Stationary_transaction;
    use Illuminate\Support\Str;
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Stationery</h1> 
    </div>
</div>
<div class="row">
<div class="col-lg-12">
    <a href="{{ route('stationery/atk/month/index', date('Y-m', strtotime('previous month')))}}" class="btn btn-sm btn-default previous"><i class="fa fa-arrow-left"></i> {{ $previous }}</a>
    <a href="{{ route('stationery/atk/month/index', date('Y-m', strtotime('next month')))}}" class="btn btn-sm btn-default previous">{{ $next }} <i class="fa fa-arrow-right"></i></a>
    <a href="{{route('stationery/atk/stocked/add')}}" class="btn btn-sm btn-default stock pull-right"> <i class="fa fa-plus"></i> Add Stock</a>
    <br>
    <br>
    <label style="margin-bottom: -10px;">Periode: {{date('F Y')}}</label><br>
    <label>Stock Started: {{date('F Y', strtotime('-1 month'))}}</label><br>   
</div>
</div>
<div class="row">
    <div class="col-lg-2 myinput pull-right">
        <input type="text" id="myInput" onkeyup="searchItem()" placeholder="search item.." title="Type in a name item" class="form-control">         
    </div>
</div>
<div class="row">
<div class="col-lg-12 table-responsive"> 
    <table id="myTable" class="table table-hover table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th rowspan="2" style="text-align: center;">No</th>               
                <th rowspan="2" style="text-align: center;">Category</th>               
                <th rowspan="2" style="text-align: center;">Code Item</th>                
                <th rowspan="2" style="text-align: center;">Item</th>
                <th rowspan="2" style="text-align: center;">UOM</th>
                <th rowspan="2" style="text-align: center;">Brand</th>
                <th rowspan="2" style="text-align: center;">Stock</th>
                <th colspan="{{ $lastDay }}" style="text-align: center;">Date Items Out <i>{{date('F Y')}}</i></th>
                <th rowspan="2" style="text-align: center;">Total Items Out</th>
                <th rowspan="2" style="text-align: center;">IN (Purchase)</th>
                <th rowspan="2" style="text-align: center;">Balance Stock</th>
                <th rowspan="2" style="text-align: center;">Date Stocked</th>
                <th colspan="3" rowspan="2" style="text-align: center;">Action</th>                  
            </tr>
            <tr>
                @for ($i = 1; $i <= $lastDay; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
           @foreach ($categories as $number => $category)
           <?php $stocked = stationary_stock::where('category_item', $key_param)->where('kode_kategory', $category->unik_kategori)->orderBy('kode_barang', 'asc')->get(); ?>        
                <tr class="category">
                    <td>{{ $number + 1 }}</td>
                    <td colspan="6">
                        <a data-toggle="modal" data-target="#showModalCategory" title="{{ $category->kategori_stock }}" id="viewCategory" data-role="{{ route('stationery/atk/category/edit', [$category->id, $month]) }}">{{ Str::title($category->kategori_stock) }}</a>
                    </td>
                   @for ($i = 1; $i <= $lastDay; $i++)
                       <td></td>
                   @endfor
                   <td colspan="4"></td>
                   <td></td>
                   <td> 
                        <a href="{{ route('stationery/atk/pdf', [$category->unik_kategori, date('Y-m', strtotime($month))]) }}" class="btn btn-xs btn-default pdf" target="_blank">PDF</a>
                   </td>
                   <td>
                    @if ($stocked)
                        <a href="{{ route('stationery/atk/excel', [$category->unik_kategori, date('Y-m', strtotime($month))]) }}" class="btn btn-xs btn-default excel">Excel</a>                        
                    @endif
                   </td>
                </tr>
               
                <?php foreach ($stocked as $key => $value): ?>
                <?php $getTotalItemOut = Stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->where('key_param', $key_param)->whereYear('date_out_stock', date('Y', strtotime($month)))->whereMonth('date_out_stock', '<', date('m', strtotime($month)))->pluck('out_stock')->sum(); 
                $getStocked = $value->stock_barang - $getTotalItemOut;
                ?>
                    <tr class="waters">
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">{{$value->kode_barang}}</td>
                        <td style="text-align: left;">{{$value->name_item}}</td>
                        <td style="text-align: center;">{{$value->satuan}}</td>
                        <td style="text-align: center;">{{$value->merk}}</td>
                        <td style="text-align: center;">
                            <span id="stocked[{{ $value->id }}]">
                                {{ $getStocked }}
                            </span>
                        </td>               
                        @for ($i = 1; $i <= $lastDay; $i++)
                        <td style="text-align: center;">
                            <a data-toggle="modal" data-target="#showModal" title="view" data-role="{{ route('stationery/atk/modal', [$value->kode_barang, $i]) }} " class="ahover">
                                {{ Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereDate('date_out_stock', date('Y-m').'-'.$i)->pluck('out_stock')->sum() }} 
                            </a>                                              
                        </td>
                        @endfor              
                        <td style="text-align: center;">
                            <span id="total_items_out[{{ $value->id }}]">
                                {{ Stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y', strtotime($month)))->whereMonth('date_out_stock', date('m', strtotime($month)))->pluck('out_stock')->sum() }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span id="in_purchase">
                                {{ Stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y'))->whereMonth('date_in_stock', date('m'))->pluck('in_stock')->sum() }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span id="balance_stock[{{ $value->id }}]">
                                <script>
                                    $(document).ready(function() {
                                        var total_items_out = document.getElementById('total_items_out[{{ $value->id }}]').textContent;
                                        var stocked = document.getElementById('stocked[{{ $value->id }}]').textContent;
                                        var balance_stock = stocked - total_items_out;  
                                        document.getElementById('balance_stock[{{ $value->id }}]').innerHTML = balance_stock;  
                                    });
                                </script>
                            </span>
                        </td>
                        <td style="text-align: center;">{{date('M, d-Y', strtotime($value->date_stock))}}</td>
                        
                        <td><a href="{{route('stationery/atk/purchase/add', [$value->id])}}" class="btn btn-xs btn-default" id="in">In</a></td>
                        <td><a href="{{route('stationery/atk/out/add', [$value->id])}}" class="btn btn-xs btn-default @if ($getStocked <= 0)
                            hidden
                        @endif" id="out">Out</a></td>
                        <td><a href="{{route('stationery/atk/edit', [$value->id])}}" class="btn btn-xs btn-default" id="edit">Edit</a></td>                
                    </tr>
                <?php endforeach ?>    
           @endforeach       
        </tbody>
        <tfoot>                
            <tr>
               <th colspan="6" style="text-align: right;">Total</th>
               <th style="text-align: center;">{{ $waters->pluck('stock_barang')->sum() }}</th>

               @for ($i = 1; $i <= $lastDay; $i++)
               <th style="text-align: center;">
                    <span id="footOut">
                        {{ Stationary_transaction::where('key_param', $key_param)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock',date('m'))->whereDay('date_out_stock', $i)->pluck('out_stock')->sum() }}
                    </span>                          
               </th>
               @endfor

                <th style="text-align: center;">
                    <span>                       
                        {{ Stationary_transaction::where('status_transaction', 2)->whereYear('date_out_stock', date('Y', strtotime($month)))->whereMonth('date_out_stock', date('m', strtotime($month)))->pluck('out_stock')->sum() }}
                    </span>
                </th>
                <th style="text-align: center;">
                    <span>                        
                        {{ Stationary_transaction::where('status_transaction', 1)->whereYear('date_in_stock', date('Y', strtotime($month)))->whereMonth('date_in_stock', date('m', strtotime($month)))->pluck('in_stock')->sum() }}
                    </span>
                </th>
                <th style="text-align: center;">{{ $waters->pluck('balance_stock')->sum() }}</th>
                <th colspan="6"></th>
            </tr>
         </tfoot>
    </table>
</div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
           
        </div>
    </div>
</div>

<div class="modal fade" id="showModalCategory" tabindex="-1" role="dialog" aria-labelledby="showModalLabelCategory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content-category">
           
        </div>
    </div>
</div>
@stop

@section('bottom')

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

$(document).on('click','#myTable tr td a[id="viewCategory"]',function(e) {
    var id = $(this).attr('data-role');
    console.log(id);

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content-category").html(e);
        }
    });
}); 
@endsection

@push('js')
<script>
    function searchItem() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];
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
@endpush