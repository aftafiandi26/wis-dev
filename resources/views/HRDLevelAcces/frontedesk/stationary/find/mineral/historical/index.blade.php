@extends('layout')

@section('title')
    {{ $headline }}
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'cd3' => 'active'
    ])
@stop

@push('style')
@include('asset_select2')
    <style>
        .myinput {
            margin-bottom: 20px;
            margin-top: -40px;
        }
        .ahover {
            color: black;
        }
        
        table tbody tr td:hover {
            background-color: lightgray;
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
        .textHeadling {
            margin-top: 20px;
        }
        #showModalSearchMonth .modal-header header {
            font-size: 18px;
            font-style: oblique;
        }
        #showModalSearchMonth .modal-body {           
            text-align: center;
        }
        sup {
            color: rgb(237, 137, 137);
            font-size: 26px;
        }
        sup sup {
            font-size: 18px;
        }
        
       
    </style>
@endpush
@section('body')

<?php 
    use App\stationary_count;
    use App\Stationary_transaction;
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mineral Stock <sup>({{ $getMonth }} <sup>{{ $year }}</sup>)</sup></h1> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="{{route('stationery/mineral/add')}}" class="btn btn-sm btn-default stock">Add Stock</a>
        <a href="{{route('stationery/mineral/pdf')}}" class="btn btn-sm btn-default pdf" target="_blank">PDF</a> 
        <a href="{{route('stationery/mineral/excel')}}" class="btn btn-sm btn-default excel">Excel</a>     
        <a class="btn btn-sm btn-default" data-target="#showModalSearchMonth" data-toggle="modal">Search</a>
    </div>    
</div>
<div class="row textHeadling">
    <div class="col-lg-12">        
        <label>Periode: {{ $getMonth. " ". $year }}</label><br>
        <label>Stock Started: {{ $getBeforeMonth. " " . $year }}</label><br> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="myinput pull-right">
            <input type="text" id="myInput" onkeyup="searchItem()" placeholder="search item.." title="Type in a name item" class="form-control">
        </div>         
    </div>
</div>
<div class="row">
    <div class="col-lg-12 table-responsive"> 
        <table id="myTable" class="table table-hover table-bordered table-condensed table-striped">
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
                    <td style="text-align: center;">{{$key + 1}}</td>
                    <td style="text-align: center;">{{$value->kode_barang}}</td>
                    <td style="text-align: left;">{{$value->name_item}}</td>
                    <td style="text-align: center;">{{$value->satuan}}</td>
                    <td style="text-align: center;">{{$value->merk}}</td>
                    <td style="text-align: center;">{{$value->stock_barang}}</td>               
                    @for ($i = 1; $i <= 31; $i++)
                    <td style="text-align: center;" id="das">
                        <a data-toggle="modal" data-target="#showModal" title="view" data-role="{{ route('stationery/mineral/modal', [$value->kode_barang, $i]) }} " class="ahover">
                            {{ stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock',date('m'))->whereDay('date_out_stock', $i)->pluck('out_stock')->sum() }} 
                        </a>                                              
                    </td>
                    @endfor              
                    <td style="text-align: center;">{{$value->total_out_stock}}</td>
                    <td style="text-align: center;">{{ stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y'))->whereMonth('date_in_stock', date('m'))->pluck('in_stock')->sum() }}</td>
                    <td style="text-align: center;">{{$value->balance_stock}}</td>
                    <td style="text-align: center;">{{date('M, d-Y', strtotime($value->date_stock))}}</td>                  
                    <td><a href="{{route('stationery/mineral/purcahse/add', [$value->id])}}" class="btn btn-xs btn-default" id="in">In</a></td>
                    <td><a href="{{route('stationery/mineral/out/add', [$value->id])}}" class="btn btn-xs btn-default" id="out">Out</a></td>
                    <td><a href="{{route('stationery/mineral/edit', [$value->id])}}" class="btn btn-xs btn-default" id="edit">Edit</a></td>                
                </tr>
                <?php endforeach ?>
                <tfoot>                
                <tr>
                    <th colspan="5" style="text-align: right;">Total</th>
                    <th style="text-align: center;">{{ $waters->pluck('stock_barang')->sum() }}</th>
                    @for ($i = 1; $i <= 31; $i++)
                    <th style="text-align: center;">
                        {{ stationary_transaction::where('key_param', $key_param)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock',date('m'))->whereDay('date_out_stock', $i)->pluck('out_stock')->sum() }}                          
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content">
           
        </div>
    </div>
</div>
<div class="modal fade" id="showModalSearchMonth" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
       <form action="#" method="get" class="formSearch">
        {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <header>Search Stock Mineral Water</header>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">              
                                <label for="searchMonth">Search :</label>
                                <select name="month" id="searchMonth"  title="select a month" required>
                                    <option value="">-choose-</option>                    
                                    <option value="1">Janurary</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>    
                                <select name="year" id="searchYear" title="select a year" required>
                                    <option value=""></option>
                                    @for ($i = 2023; $i <= 2040; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        
                                    @endfor
                                    
                                </select>                           
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Search</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
       </form>
    </div>
</div>


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
$('select#searchMonth').select2({
    placeholder: "choose a month",
    allowClear: true,
    dropdownParent: $("#showModalSearchMonth")
});
$('select#searchYear').select2({
    placeholder: "choose a year",
    allowClear: true,
    dropdownParent: $("#showModalSearchMonth")
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
@endpush