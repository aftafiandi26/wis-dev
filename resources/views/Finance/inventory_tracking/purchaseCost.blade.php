@extends('layout')

@section('title')
    (fa) Purchase Cost
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1002' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">{{$select->f_brand}} Purchase Cost</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-12 table-responsive">
        <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables" style="margin-left: auto; margin-right: auto;">
            <thead>
              <tr>     
                <th>Tracking</th>          
                <th>Series</th>
                <th>Asset Category</th> 
                <th>Purchase Date</th>
                <th>Date Incoming</th>               
                <th>Unit Price</th>  
                <th>Action</th>                             
             </tr>
            </thead>
            <tbody>
                <?php foreach ($asset_tracking as $value_asset_tracking): ?>
                    <tr>
                        <td>{{$value_asset_tracking->tracking_number}}</td>
                        <td>{{$value_asset_tracking->series}}</td>
                        <td>{{$value_asset_tracking->asset_category_name}}</td>
                        <td>{{$value_asset_tracking->date_purchase}}</td>
                        <td>{{$value_asset_tracking->date_incoming}}</td>
                        <td>{{$value_asset_tracking->price." ".number_format($value_asset_tracking->nominal,0,",",".")}}</td>  
                        <td><a href="#" class="btn btn-xs btn-warning">Edit</a></td>                     
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4"></th>
                    <th>Amount</th>
                    <th>{{$asset_po_invoice->po_currency." ".number_format($asset_po_invoice->amount,0,",",".")}}</th>
                    <th></th>
                </tr>
            </tfoot>           
        </table>
        <small class="pull-right">{{ $asset_tracking->links() }}</small>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-condensed table-hover table-bordered table-bordered" width="100%" id="tabel1">
                <thead>
                    <tr>
                        <th>Purchase Order</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Invoice</th>
                        <th>Usage Period</th>
                        <th>Beginning Balance</th>
                        <th>Addition</th>
                        <th>Calculation</th>
                        <th>Monthly</th>
                        <th>Write (OFF/SOLD)</th>
                        <th>Ending Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$select->view_po_number}}</td>
                        <td>{{$asset_po_invoice->po_qty}}</td>
                        <td>{{$asset_po_invoice->po_currency." ".number_format($asset_po_invoice->amount,0,",",".")}}</td>
                        <td>{{$asset_po_invoice->po_invoice}}</td>
                        <td>{{$select->usage_period}}</td>
                        <td>{{$select->currency." ".number_format($select->beginning_balance,0,",",".")}}</td>
                        <td>{{$select->currency." ".number_format($select->pc_addition,0,",",".")}}</td>
                        <td>{{$select->currency." ".number_format($select->pc_calculation,0,",",".")}}</td>
                        <td>{{$select->currency." ".number_format($select->pc_monthly,0,",",".")}}</td>
                        <td>{{$select->currency." ".number_format($select->pc_write,0,",",".")}}</td>
                        <td>{{$select->currency." ".number_format($select->pc_ending_balance,0,",",".")}}</td>
                        <td><a href="{{route('editPurchase', [$select->id])}}" class="btn btn-xs btn-warning">Edit</a> 
                            <a href="{{route('indexListAccumulution', [$select->f_department])}}" class="btn btn-xs btn-primary">Accumulation</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 50px;">
    <div class="col-lg-12" style="font-size: 12px;">
        <p style="color: grey;">
           <font style="color: red;">**</font>Note For:
            <ul style="color: grey;">
                <li><b>Beginning Balance</b>: Please Transfer to IDR</li>
                <li><b>Calculation</b>: Beginning Balance + Addition</li>
                <li><b>Monthly</b>: Calculation / Usage Period</li>
                <li><b>Ending Balance</b>: Beginning Balance + Addition - Write (OFF/SOLD)</li>
                <li><b>Currency unit is taken based on the original cost</b></li>
            </ul>
        </p>
    </div>
</div>
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>
 @stop 


@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 

