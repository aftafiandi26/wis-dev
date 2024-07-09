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
        'c2001' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">{{$asset_tracking->brand}} Purchase Cost</h1> 
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
                <th>Usage Period</th> 
                <th>Beginning</th>
                <th>Additions</th>
                <th>Calculation</th>
                <th>Monthly Depreciation</th>
                <th>Write (OFF/SOLD)</th>
                <th>Ending Balance</th>               
             </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$asset_tracking->tracking_number}}</td>
                    <td>{{$asset_tracking->series}}</td>
                    <td>{{$asset_tracking->asset_category_name}}</td>
                    <td>{{$asset_tracking->date_purchase}}</td>
                    <td>{{$asset_tracking->date_incoming}}</td>
                    <td>{{$asset_tracking->price}} {{number_format($asset_tracking->nominal,0,",",".")}}</td>
                    <td>{{$select->usage_period}}</td>                 
                    <td>{{$select->beginning_balance}} </td>
                    <td>{{$select->pc_addition}}</td>
                    <td>{{$select->pc_calculation}}</td>
                    <td>{{$select->pc_monthly}}</td>
                    <td>{{$select->pc_write}}</td>
                    <td>{{$select->pc_ending_balance}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row"> 
<div class="col-lg-12">
    <h3>Input Data Purchase Cost</h3> 
</div>
    <form action="{{route('storePurchaseCost', [$select->id])}}" method="post">
        {{ csrf_field() }}
            <div class="col-lg-2 form-group">
                <label for="tracking_number"><font style="color: red;">*</font>Tracking Number:</label>
                <input type="text" name="tracking_number" value="{{$asset_tracking->tracking_number}}" placeholder="Null" class="form-control" autofocus="true" required="true">
            </div>
            <div class="col-lg-2 form-group">
                <label for="asset_category"><font style="color: red;">*</font>Asset Category:</label>
                <select class="form-control" id="asset_category" name="asset_category">
                    <option value="">-Select-</option>
                    <option value="1" <?php if ($asset_tracking->asset_category_id === 1): ?>
                        selected="true"
                    <?php endif ?>>Asset</option>
                    <option value="2" <?php if ($asset_tracking->asset_category_id === 2): ?>
                        selected="true"
                    <?php endif ?>>Integrable Asset</option>
                    <option value="3" <?php if ($asset_tracking->asset_category_id === 3): ?>
                        selected="true"
                    <?php endif ?>>Non Asset</option>
                </select>
            </div>
             <div class="col-lg-2 form-group">
                <label for="date_purchase"><font style="color: red;">*</font>Purchase Date:</label>
                <input type="date" name="date_purchase" id="date_purchase" value="{{$asset_tracking->date_purchase}}" class="form-control">
            </div>
            <div class="col-lg-2 form-group">
                <label for="usage_period"><font style="color: red;">*</font>Usage Period:</label>
                <input type="number" name="usage_period" id="usage_period" value="{{$select->usage_period}}" class="form-control" min="0" required="true">
            </div>
            <div class="col-lg-4 form-group">
                <label for="beginning_balance"><font style="color: red;">*</font>Beginning Balance:</label>
                <div class="row">
                  <div class="col-lg-4">
                    <select class="form-control" name="mata_uang">
                        <option value="">-select-</option>
                        <option value="IDR" <?php if ($select->currency === "IDR"): ?>
                            selected="true"
                        <?php endif ?>>IDR</option>                      
                    </select>
                  </div>
                  <div class="col-lg-7">
                      <input type="number" name="beginning_balance" id="beginning_balance" value="{{$select->beginning_balance}}" class="form-control" min="0" required="true">
                  </div>
                </div>  
            </div>           
            <div class="col-lg-2 form-group">
                <label for="pc_addition"><font style="color: red;">*</font>Addition:</label>
                <input type="number" name="pc_addition" id="pc_addition" value="{{$select->pc_addition}}" class="form-control" min="0">
            </div>
            <div class="col-lg-2 form-group">
                <label for="pc_write"><font style="color: red;">*</font>Write (OFF/SOLD):</label>
                <input type="number" name="pc_write" id="pc_write" value="{{$select->pc_write}}" class="form-control" min="0">
            </div> 

            <div class="col-lg-12">
                <button type="submit" class="btn btn-sm btn-success">save</button>
                <a href="#" class="btn btn-sm btn-default">back</a>
                <a href="#" class="btn btn-sm btn-primary">accumulation</a>
            </div>         
  </form> 
</div>

<div class="row" style="margin-top: 50px;">
    <div class="col-lg-12" style="font-size: 12px;">
        <p style="color: grey;">
           <font style="color: red;">**</font>Note For:
            <ul style="color: grey;">
                <li><b>Original Cost</b>: Please Transfer to IDR</li>
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

