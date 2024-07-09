<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stock Stationary</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>   
    p {
        text-align: center;
    }
    table, tr, th, td, {
        border: 2px solid;
    }
    table thead tr th, table tbody tr td, table tfoot tr th {
        text-align: center;
    }
</style>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" style="margin-left: 0px;">
            <label>PT. KINEMA SYTRANS MULTIMEDIA</label>
            <br>
            <label>STATIONARY INVENTORY STOCK</label>
            <br>
            <label>PERIODE {{strtoupper(date('F Y', strtotime($month)))}}</label><p class="pull-right">Update On : {{date('M, d Y')}} </p>
            <br>          
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <table class="table-condensed table" border="true">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>               
                        <th rowspan="2">Category</th>               
                        <th rowspan="2">Code Item</th>                
                        <th rowspan="2">Item</th>
                        <th rowspan="2">UOM</th>
                        <th rowspan="2">Brand</th>
                        <th rowspan="2">Stock</th>
                        <th colspan="31">Date Items Out <i>{{date('F Y')}}</i></th>
                        <th rowspan="2">Total Items Out</th>
                        <th rowspan="2">IN (Purchase)</th>
                        <th rowspan="2">Balance Stock</th>
                        <th rowspan="2">Date Stocked</th>
                    </tr>
                    <tr>              
                        <?php for ($i=1; $i <=31 ; $i++) { 
                                echo "<th>$i</th>";
                        } ?>                                         
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>
                            {{ title_case($category->kategori_stock) }}
                        </td>
                        <td colspan="5"></td>
                        @for ($i = 1; $i <= 31; $i++)
                            <td></td>
                        @endfor
                        <td colspan="7"></td>
                    </tr>                   
                    <?php foreach ($stocked as $key => $stock): ?>                   
                    <tr class="transaction">
                        <td>{{ $key + 1 }}</td>
                        <td></td>
                        <td>{{$stock->kode_barang}}</td>
                        <td>{{$stock->name_item}}</td>
                        <td>{{$stock->satuan}}</td>
                        <td>{{$stock->merk}}</td>
                        <td>
                            @foreach ($getDataForeach as $barang)
                                @if ($barang['id'] === $stock->id)
                                    {{ $barang['stock_barang'] }}
                                @endif
                            @endforeach
                        </td>               
                        @for ($i = 1; $i <= 31; $i++)
                        <td>
                            @foreach ($out_items as $out_item)
                                @if ($out_item['day'] === $i and $out_item['id'] === $stock->id)
                                    {{ $out_item['value'] }}
                                @endif
                            @endforeach 
                        </td>
                        @endfor              
                        <td>
                            @foreach ($getDataForeach as $total_out)
                                @if ($total_out['id'] === $stock->id)
                                    {{ $total_out['totalOutItem'] }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($getDataForeach as $in)
                                @if ($in['id'] === $stock->id)
                                    {{ $in['in_purchase'] }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($getDataForeach as $balance)
                                @if ($balance['id'] === $stock->id)
                                    {{ $balance['balance_stock'] }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{date('M, d-Y', strtotime($stock->date_stock))}}</td>
                    </tr>
                    <?php endforeach ?>     
                </tbody>
                <tfoot>                
                    <tr>
                        <th colspan="6" style="text-align: right;">Total</th>
                        <th> {{ $total_stock_barang }}</th>
        
                        @for ($i = 1; $i <= 31; $i++)
                        <th>
                            @foreach ($total_out_transaction as $total_out)
                                @if ($total_out['day'] == $i)
                                    {{ $total_out['value'] }}
                                @endif
                            @endforeach                      
                        </th>
                        @endfor
                        <th>
                            {{ $count_out_transacntion }}
                        </th>
                        <th>
                            {{ $total_in_purhcase }}
                        </th>
                        <th>{{ $stocked->pluck('balance_stock')->sum() }}</th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 100px;">
        <div class="col-lg-4">
                <label>
                <p style="margin-bottom: 100px;">Prepared By</p>
                <p style="text-decoration: underline;">{{ $receptionist }}</p>
                <p>Receptionist</p>
                </label>
        </div>
        <div class="col-lg-4">
                <label>
                <p style="margin-bottom: 100px;">Acknowledged By</p>
                <p style="text-decoration: underline;">Wahyuni Hasan</p>
                <p>HR & GA Manager</p>
                </label>
        </div>
        <div class="col-lg-4">
                <label>
                <p style="margin-bottom: 100px;">Approved By</p>
                <p style="text-decoration: underline;">Ghea Lisanova</p>
                <p>General Manager</p>
                </label>
        </div>
    </div>   
</div>
</body>
</head>
</html>
