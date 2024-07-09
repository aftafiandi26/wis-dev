<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stock Stationary</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<body>
<?php 
use App\stationary_count;
use App\stationary_transaction; 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" style="margin-left: 0px;">
            <label>PT. KINEMA SYTRANS MULTIMEDIA</label>
            <br>
            <label>STATIONARY INVENTORY STOCK</label>
            <br>
            <label>PERIODE {{strtoupper(date('F Y'))}}</label><p class="pull-right">Update On : {{date('M, d Y')}} </p>
            <br>          
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <table class="table-bordered table-condensed table">
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
                        <?php for ($i=1; $i <=31 ; $i++) { 
                             echo "<th>$i</th>";
                        } ?>                                         
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
                                {{ stationary_transaction::where('key_param', 1)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock',date('m'))->whereDay('date_out_stock', $i)->pluck('out_stock')->sum() }}                          
                            </td>
                            @endfor              
                            <td style="text-align: center;">{{$value->total_out_stock}}</td>
                            <td style="text-align: center;">{{ stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y'))->whereMonth('date_in_stock', date('m'))->pluck('in_stock')->sum() }}</td>
                            <td style="text-align: center;">{{$value->balance_stock}}</td>
                            <td style="text-align: center;">{{date('M, d-Y', strtotime($value->date_stock))}}</td> 
                    </tr>
                    <?php endforeach ?>                    
                </tbody>
                <tfoot>                
                    <tr>
                        <th colspan="5" style="text-align: right;">Total</th>
                        <th style="text-align: center;">{{ $waters->pluck('stock_barang')->sum() }}</th>
        
                        @for ($i = 1; $i <= 31; $i++)
                        <th style="text-align: center;">
                            {{ stationary_transaction::where('key_param', 1)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock',date('m'))->whereDay('date_out_stock', $i)->pluck('out_stock')->sum() }}                          
                        </th>
                        @endfor
                        <th style="text-align: center;">{{ $waters->pluck('total_out_stock')->sum() }}</th>
                        <th style="text-align: center;">{{ $waters->pluck('in_purchase')->sum() }}</th>
                        <th style="text-align: center;">{{ $waters->pluck('balance_stock')->sum() }}</th>
                        <th></th>
                   </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 100px;">
        <div class="col-lg-4">
             <label style="text-align: center;">
             <p style="margin-bottom: 100px;">Prepared By</p>
             <p style="text-decoration: underline;">{{ $receptionist }}</p>
             <p>Receptionist</p>
             </label>
         </div>
         <div class="col-lg-4">
             <label style="text-align: center;">
             <p style="margin-bottom: 100px;">Acknowledged By</p>
             <p style="text-decoration: underline;">Wahyuni Hasan</p>
             <p>HR & GA Manager</p>
             </label>
         </div>
         <div class="col-lg-4">
             <label style="text-align: center;">
             <p style="margin-bottom: 100px;">Approved By</p>
             <p style="text-decoration: underline;">Ghea Lisanova</p>
             <p>GM</p>
             </label>
         </div>
       </div>
     </div>
</div>
</body>
</head>
</html>
