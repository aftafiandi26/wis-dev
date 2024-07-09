<?php 
use App\Asset_PO;
use App\View_Finance_Tracking;
$no = 1;    
?>
<table>
     <thead>
          <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Purchase Order</th>
                        <th rowspan="2">Brand</th>
                        <th rowspan="2">Series</th>
                        <th rowspan="2">Qty</th>      
                        <th colspan="5">Purchase Cost</th>
                        <th rowspan="2">Remaining Balance</th>
                        <th colspan="12">Accumulation Depreciation 2020</th>
                        <th rowspan="2">Status</th>                        
                    </tr>  
                    <tr>                                       
                        <th colspan="5"></th>
                        <th>Usage Period</th>
                        <th>Remainig Period</th>
                        <th>Beginning Balance</th>
                        <th>Monthly</th>
                        <th>Ending Balance</th>
                        <th></th>
                        <th>January</th>
                        <th>February</th>
                        <th>March</th>
                        <th>April</th>
                        <th>Mey</th>
                        <th>June</th>
                        <th>July</th>
                        <th>August</th>
                        <th>September</th>
                        <th>October</th>
                        <th>November</th>
                        <th>December</th> 
                        <th></th>                    
                       
                   </tr>                  
     </thead> 
     <tbody>
       <tbody>
        <?php foreach ($data as $f_value): ?>
          <?php 
                        $asset_po = Asset_PO::find($f_value->id_asset_po);

                        $January = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '1')->whereYear ('view_date', date('Y'))->first();
                        if ($January != Null) {
                           $vJanuary = $January->currency." ".number_format($January->monthly_cost,0,",",".");
                        } else {
                            $vJanuary = "-";
                        }

                        $February = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '2')->whereYear ('view_date', date('Y'))->first();
                        if ($February != Null) {
                           $vFebruary = $February->currency." ".number_format($February->monthly_cost,0,",",".");
                        } else {
                            $vFebruary = "-";
                        }

                        $March = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '3')->whereYear ('view_date', date('Y'))->first();
                        if ($March != Null) {
                           $vMarch = $March->currency." ".number_format($March->monthly_cost,0,",",".");
                        } else {
                            $vMarch = "-";
                        }

                        $April = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '4')->whereYear ('view_date', date('Y'))->first();
                        if ($April != Null) {
                           $vApril = $April->currency." ".number_format($April->monthly_cost,0,",",".");
                        } else {
                            $vApril = "-";
                        }

                        $Mey = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '5')->whereYear ('view_date', date('Y'))->first();
                        if ($Mey != Null) {
                           $vMey = $Mey->currency." ".number_format($Mey->monthly_cost,0,",",".");
                        } else {
                            $vMey = "-";
                        }

                        $June = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '6')->whereYear ('view_date', date('Y'))->first();
                        if ($June != Null) {
                           $vJune = $June->currency." ".number_format($June->monthly_cost,0,",",".");
                        } else {
                            $vJune = "-";
                        }

                        $July = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '7')->whereYear ('view_date', date('Y'))->first();
                        if ($July != Null) {
                           $vJuly = $July->currency." ".number_format($July->monthly_cost,0,",",".");
                        } else {
                            $vJuly = "-";
                        }

                        $August = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '8')->whereYear ('view_date', date('Y'))->first();
                        if ($August != Null) {
                           $vAugust = $August->currency." ".number_format($August->monthly_cost,0,",",".");
                        } else {
                            $vAugust = "-";
                        }

                        $September = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '9')->whereYear ('view_date', date('Y'))->first();
                        if ($September != Null) {
                           $vSeptember = $September->currency." ".number_format($September->monthly_cost,0,",",".");
                        } else {
                            $vSeptember = "-";
                        }

                        $October = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '10')->whereYear ('view_date', date('Y'))->first();
                        if ($October != Null) {
                           $vOctober = $October->currency." ".number_format($October->monthly_cost,0,",",".");
                        } else {
                            $vOctober = "-";
                        }

                        $November = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '11')->whereYear ('view_date', date('Y'))->first();
                        if ($November != Null) {
                           $vNovember = $November->currency." ".number_format($November->monthly_cost,0,",",".");
                        } else {
                            $vNovember = "-";
                        }

                        $December = View_Finance_Tracking::where('v_view_po_number', $f_value->view_po_number)->whereMonth('view_date', '12')->whereYear ('view_date', date('Y'))->first();
                        if ($December != Null) {
                           $vDecember = $December->currency." ".number_format($December->monthly_cost,0,",",".");
                        } else {
                            $vDecember = "-";
                        }

                        $remaining_balance = $f_value->pc_ending_balance-$f_value->acc_ending_balance;
                         ?>
                    <tr <?php if ($f_value->pc_ending_balance === $f_value->acc_ending_balance): ?>
                              class="info"
                        <?php endif ?>>
                        <td>{{$no++}}</td>
                        <td>{{$f_value->view_po_number}}</td>
                        <td>{{$f_value->f_brand}}</td>
                        <td>{{$f_value->f_series}}</td>
                        <td>{{$asset_po->po_qty}}</td>
                        <td>{{$f_value->usage_period}}</td>
                        <td>{{$f_value->usage_period-$f_value->remainning_period}}</td>
                        <td>{{$f_value->currency." ".number_format($f_value->beginning_balance,0,",",".")}}</td>
                        <td>{{$f_value->currency." ".number_format($f_value->pc_monthly,0,",",".")}}</td>
                        <td>{{$f_value->currency." ".number_format($f_value->pc_ending_balance,0,",",".")}}</td>
                        <td>{{$f_value->currency." ".number_format($remaining_balance,0,",",".")}}</td>
                        <td>{{$vJanuary}}</td>
                        <td>{{$vFebruary}}</td>                     
                        <td>{{$vMarch}}</td>
                        <td>{{$vApril}}</td>
                        <td>{{$vMey}}</td>
                        <td>{{$vJune}}</td>
                        <td>{{$vJuly}}</td>
                        <td>{{$vAugust}}</td>
                        <td>{{$vSeptember}}</td>
                        <td>{{$vOctober}}</td>
                        <td>{{$vNovember}}</td>
                        <td>{{$vDecember}}</td>
                       
                        <td>
                            <?php if ($f_value->pc_ending_balance === $f_value->acc_ending_balance): ?>
                                Finish
                            <?php else: ?>
                                Ongoin
                            <?php endif ?>
                        </td>
                        
                    </tr>  
        <?php endforeach ?>
     </tbody>
</table>