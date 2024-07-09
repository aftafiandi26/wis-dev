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
        <h1 class="page-header">Edit {{$select->f_brand}} Purchase Cost</h1> 
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-lg-12">
        <form action="{{route('storePurchaseCost', [$select->id])}}" method="post">
        {{ csrf_field() }}
            <div class="col-lg-2 form-group">
                <label for="view_po_number"><font style="color: red;">*</font>Purchase Order:</label>
                <input type="text" name="view_po_number" class="form-control" readonly="true" value="{{$select->view_po_number}}" id="view_po_number">
            </div>
            <div class="col-lg-2 form-group">
                <label for="f_series"><font style="color: red;">*</font>Series:</label>
                <input type="text" name="f_series" class="form-control" readonly="true" value="{{$select->f_series}}" id="f_series">
            </div>
            <div class="col-lg-2 form-group">
                <label for="po_qty"><font style="color: red;">*</font>Qty:</label>
                <input type="text" name="po_qty" class="form-control" readonly="true" value="{{$asset_po_invoice->po_qty}}" id="po_qty">
            </div>
            <div class="col-lg-2 form-group">
                <label for="date_purchase"><font style="color: red;">*</font>Purchase Date:</label>
                <input type="date" name="date_purchase" class="form-control" id="date_purchase"  <?php if ($asset_tracking->date_purchase === Null): ?>
                    required="true"
                <?php else: ?>
                    readonly="true" value="{{$asset_tracking->date_purchase}}"
                <?php endif ?>>
            </div>
            <div class="col-lg-2 form-group">
                <label for="date_incoming"><font style="color: red;">*</font>Date Incoming:</label>
                <input type="date" name="date_incoming" class="form-control" readonly="true" value="{{$asset_tracking->date_incoming}}" id="date_incoming">
            </div>
            <div class="col-lg-2 form-group">
                <label for="amount"><font style="color: red;">*</font>Original Cost:</label>
                <input type="text" name="amount" class="form-control" readonly="true" value="{{$asset_po_invoice->po_currency.' '.number_format($asset_po_invoice->amount,0,',','.')}}" id="amount">
            </div>
            <div class="col-lg-2 form-group">
                <label for="usage_period"><font style="color: red;">*</font>Usage Period:</label>
                <input type="number" min="1" name="usage_period" class="form-control" value="{{$select->usage_period}}" id="usage_period" required="true">
            </div>
            <div class="col-lg-4 form-group">
                <label for="rupiah">Beginning Balance:</label>
                <div class="row">
                  <div class="col-lg-4">
                    <select class="form-control" name="currency"  required="true">
                        <option value="">-select-</option>
                        <option value="IDR" <?php if ($select->currency === 'IDR'): ?>
                            selected="true"
                        <?php endif ?>>IDR</option>                        
                    </select>
                  </div>
                  <div class="col-lg-8">
                    <input type="number" name="beginning_balance" class="form-control"  required="true" min="0" value="{{$select->beginning_balance}}">
                  </div>
                </div>            
            </div>
            <div class="col-lg-2 form-group">
                <label for="pc_addition"><font style="color: red;">*</font>Addition:</label>
                <input type="number" min="0" name="pc_addition" class="form-control" value="{{$select->pc_addition}}" id="pc_addition" required="true">
            </div>
            <div class="col-lg-2 form-group">
                <label for="pc_write"><font style="color: red;">*</font>Write (OFF/SOLD):</label>
                <input type="number" min="0" name="pc_write" class="form-control" value="{{$select->pc_write}}" id="pc_write" required="true">
            </div>
            <div class="col-lg-12 form-group">
                <button type="submit" class="btn btn-sm btn-success">save</button>
                <a href="{{route('addPurchaseCost', $select->id)}}" class="btn btn-sm btn-default">back</a>
            </div>
        </form>
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