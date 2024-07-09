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
                        <th colspan="5">PERIODE {{strtoupper(date('F Y', strtotime($month)))}}</th>
                        <?php for ($i=1; $i <= $lastDay ; $i++) {
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
                    <th colspan="{{ $lastDay }}" style="text-align: center;">Date Items Out <i>{{date('F Y', strtotime($month))}}</i></th>
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
                    <?php for ($i=1; $i <= $lastDay ; $i++) { 
                        echo "<th>$i</th>";
                    } ?> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>                             
              </tr>          
            </thead>
            <tbody>
                <?php foreach ($waters as $key => $value): ?>
                <tr>
                    <td style="text-align: center;">{{$key + 1}}</td>
                    <td style="text-align: center;">{{$value->kode_barang}}</td>
                    <td style="text-align: left;">{{ $value->name_item }}</td>
                    <td style="text-align: center;">{{$value->satuan}}</td>
                    <td style="text-align: center;">{{$value->merk}}</td>
                    <td style="text-align: center;">
                        @foreach ($array_waters as $water)
                            @if ($water['id'] === $value->id)
                                {{ $water['stocked'] }}
                            @endif
                        @endforeach
                    </td>               
                    @for ($i = 1; $i <= $lastDay; $i++)
                    <td style="text-align: center;" id="das">
                        @foreach ($array_out_waters as $water)
                            @if ($water['id'] === $value->id && $water['day'] === $i)
                                {{ $water['value'] }}
                            @endif
                        @endforeach                                             
                    </td>
                    @endfor              
                    @foreach ($array_waters as $water)
                        @if ($water['id'] === $value->id)
                            <td style="text-align: center;">{{ $water['out_count'] }}</td>
                            <td style="text-align: center;">{{ $water['in_count'] }}</td>
                            <td style="text-align: center;">{{ $water['balance'] }}</td>
                        @endif
                    @endforeach
                    <td style="text-align: center;">{{date('M, d-Y', strtotime($value->date_stock))}}</td>                 
                        
                </tr>
                <?php endforeach ?>                
            </tbody>
            <tfoot>                
                <tr>
                    <th colspan="5" style="text-align: right;">Total</th>
                    <th style="text-align: center;">{{ $total_tfoot['totalStocked'] }}</th>
                    @for ($i = 1; $i <= $lastDay; $i++)
                        <th style="text-align: center;">
                            @foreach ($array_tfoot_out as $water)
                                @if ($water['day'] === $i)
                                    {{ $water['value'] }}
                                @endif
                            @endforeach
                        </th>
                    @endfor
                    <th style="text-align: center;">{{ $total_tfoot['total_tfoot_out'] }}</th>
                    <th style="text-align: center;">{{ $total_tfoot['total_tfoot_in'] }}</th>
                    <th style="text-align: center;">{{ $total_tfoot['total_tfoot_balance'] }}</th>
                    <td></td>
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
