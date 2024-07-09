<!DOCTYPE html>
<html>
<head>
    <title>Stationary Stock</title>
</head>
<body>
<?php 
use App\stationary_count;
use App\stationary_transaction; 
?>
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
                        <th colspan="5">PERIODE {{strtoupper(date('F Y'))}}</th>
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
                @foreach ($waters as $key => $value)
                    <tr>
                        <td style="text-align: center;">{{$no++}}</td>
                        <td style="text-align: center;">{{$value->kode_barang}}</td>
                        <td style="text-align: left;">{{$value->name_item}}</td>
                        <td style="text-align: center;">{{$value->satuan}}</td>
                        <td style="text-align: center;">{{$value->merk}}</td>
                        <td style="text-align: center;">{{$value->stock_barang}}</td>   
                        
                        @for ($i = 1; $i <= 31; $i++)
                        <td style="text-align: center;">
                           {{ stationary_transaction::where('key_param', 2)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock',date('m'))->whereDay('date_out_stock', $i)->pluck('out_stock')->sum() }}                          
                        </td>
                        @endfor
                        <td style="text-align: center;">{{$value->total_out_stock}}</td>
                        <td style="text-align: center;">{{ stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y'))->whereMonth('date_in_stock', date('m'))->pluck('in_stock')->sum() }}</td>
                        <td style="text-align: center;">{{$value->balance_stock}}</td>
                        <td style="text-align: center;">{{date('M, d-Y', strtotime($value->date_stock))}}</td> 
                    </tr>
                @endforeach
            </tbody>
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
                        <td colspan="13" style="text-align: center;">GM</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
