<!DOCTYPE html>
<html>
<head>
    <title>Stationary Stock</title>
</head>
<body>

<div class="cointainer-fluid">
    <div class="row">
        <div class="col-lg-12" style="margin-left: 0px;">
            <table>
                <thead>
                    <tr>
                        <th colspan="5">PT. KINEMA SYTRANS MULTIMEDIA</th>
                    </tr>
                    <tr>
                        <th colspan="5">STATIONERY INVENTORY STOCK</th>
                    </tr>
                    <tr>
                        <th colspan="5">PERIODE {{strtoupper(date('F Y', strtotime($month)))}}</th>
                        <?php for ($i=1; $i <=30 ; $i++) {
                            echo "<th></th>";
                        } ?>
                        <th colspan="6" style="text-align: right;">Update On : {{date('M, d Y')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover" border="1">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center;">No</th>               
                    <th rowspan="2" style="text-align: center;">Category</th>               
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
                </tr>     
                <tr>  
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>            
                    <?php for ($i=1; $i <=31 ; $i++) { 
                       echo "<th>$i</th>";
                    } ?> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>                             
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
                @foreach ($stocked as $key => $stock)
                    <tr>
                        <td style="text-align: center;">{{ $key + 1 }}<td>                      
                        <td style="text-align: center;">{{$stock->kode_barang}}</td>
                        <td style="text-align: left;">{{$stock->name_item}}</td>
                        <td style="text-align: center;">{{$stock->satuan}}</td>
                        <td style="text-align: center;">{{$stock->merk}}</td>
                        <td style="text-align: center;">
                            @foreach ($getDataForeach as $barang)
                                @if ($barang['id'] === $stock->id)
                                    {{ $barang['stock_barang'] }}
                                @endif
                            @endforeach
                        </td>   
                        
                        @for ($i = 1; $i <= 31; $i++)
                        <td style="text-align: center;">
                            @foreach ($out_items as $out_item)
                                @if ($out_item['day'] === $i and $out_item['id'] === $stock->id)
                                    {{ $out_item['value'] }}
                                @endif
                            @endforeach          
                        </td>
                        @endfor
                        <td style="text-align: center;">
                            @foreach ($getDataForeach as $total_out)
                                @if ($total_out['id'] === $stock->id)
                                    {{ $total_out['totalOutItem'] }}
                                @endif
                            @endforeach
                        </td>
                        <td style="text-align: center;">
                            @foreach ($getDataForeach as $in)
                                @if ($in['id'] === $stock->id)
                                    {{ $in['in_purchase'] }}
                                @endif
                            @endforeach
                        </span>
                        </td>
                        <td style="text-align: center;">
                            @foreach ($getDataForeach as $balance)
                                @if ($balance['id'] === $stock->id)
                                    {{ $balance['balance_stock'] }}
                                @endif
                            @endforeach
                        </td>
                        <td style="text-align: center;">{{date('M, d-Y', strtotime($stock->date_stock))}}</td> 
                    </tr>
                @endforeach
            </tbody>
            <tfoot>                
                <tr>
                    <th colspan="6" style="text-align: right;">Total</th>
                    <th style="text-align: center;">
                        {{ $total_stock_barang }}
                    </th>
    
                    @for ($i = 1; $i <= 31; $i++)
                    <th style="text-align: center;">
                        @foreach ($total_out_transaction as $total_out)
                            @if ($total_out['day'] == $i)
                                {{ $total_out['value'] }}
                            @endif
                        @endforeach
                    </th>
                    @endfor
    
                    <th style="text-align: center;">
                        {{ $count_out_transacntion }}
                    </th>
                    <th style="text-align: center;">
                        {{ $total_in_purhcase }}
                    </th>
                    <th style="text-align: center;">{{ $stocked->pluck('balance_stock')->sum() }}</th>
                    <th colspan="6"></th>
                </tr>
             </tfoot>
        </table>
    </div>

     <div class="row">
        <div class="col-lg-12" style="margin-left: 0px;">
            <table>
                <tbody>
                    <tr></tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="4" style="text-align: center"> Prepare By</td>
                        <td colspan="20" style="text-align: center"> Acknowledged By</td>
                        <td colspan="13" style="text-align: center"> Approved By</td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>

                    <tr>
                        <td colspan="2"></td>
                        <td colspan="4" style="text-align: center; text-decoration: underline;">{{ $receptionist }}</td>
                        <td colspan="20" style="text-align: center; text-decoration: underline;">Wahyuni Hasan</td>
                        <td colspan="13" style="text-align: center; text-decoration: underline;">Ghea Lisanova</td>
                    </tr>
                     <tr>
                        <td colspan="2"></td>
                        <td colspan="4" style="text-align: center;">Receptionist</td>
                        <td colspan="20" style="text-align: center;">HR & GA Manager</td>
                        <td colspan="13" style="text-align: center;">General Manager</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
