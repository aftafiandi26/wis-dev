<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="{{asset('assets/iconic2.png')}}">
  <title>{{ $headline }} - WIS</title>
  <link href="{!! URL::route('assets/css/bootstrap') !!}" rel="stylesheet">
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
            <table id="myTable" class="table table-hover table-bordered table-condensed table-striped">
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
                        <?php for ($i=1; $i <= $lastDay ; $i++) { 
                            echo "<th>$i</th>";
                        } ?>                                     
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
                <p>General Manager</p>
                </label>
        </div>     
    </div>
</div>
</body>
</head>
</html>
