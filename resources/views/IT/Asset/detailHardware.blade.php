@extends('layout')

@section('title')
    (it) Detail Asset
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left')
@stop

@section('body')


<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Detail Item Inventory {{$tracking->brand}}</h1>                     
    </div>
</div>
<div class="row">
  <div class="col-lg-12" style="margin-bottom: 5px;">
    <a href="{{route('indextAsset1', [$tracking->category_name_id])}}" class="btn btn-sm btn-default">back</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-8">
    <div class="table-responsive">
      <table class="table table-bordered table-condensed table-hover">
       <tbody>
        <tr class="active">
           <td class="col-lg-2">Tracking Number</td>
          
           <td>{{$tracking->tracking_number}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">ID Barcode</td>
          
           <td>{{$tracking->barcode}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Asset Category</td>
          
           <td>{{$tracking->asset_category_name}}</td>
         </tr> 
         <tr>
           <td class="col-lg-2">Asset Type</td>
          
           <td>{{$tracking->asset_type_name}}</td>
         </tr>        
         <tr>
           <td class="col-lg-2">Department</td>
          
           <td>{{$tracking->dept_name}}</td>
         </tr> 
         <tr>
           <td class="col-lg-2">IFW Code</td>
          
           <td>{{$tracking->ifw_code}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Brand</td>
          
           <td>{{$tracking->brand}}</td>
         </tr>     
         <tr>
           <td class="col-lg-2">Series</td>
          
           <td>{{$tracking->series}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Serial Number</td>
          
           <td>{{$tracking->serial_number}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Part Number</td>
          
           <td>{{$tracking->part_number}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Date Incoming</td>
          
           <td>{{date('M, d Y', strtotime($tracking->date_incoming))}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">PO</td>
          
           <td>{{$tracking->po_number1}}/{{$tracking->po_number2}}-{{$tracking->po_number3}}/{{$tracking->po_number4}}/{{$tracking->po_number5}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Vendor</td>
          
           <td>{{$tracking->vendor}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Invoice</td>
          
           <td>{{$tracking->invoice}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Delivery Order</td>
          
           <td>{{$tracking->delivery_order}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Qty</td>
          
           <td>{{$tracking->qty}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Unit Price</td>
          
           <td>{{$tracking->price}} {{number_format($tracking->nominal, '2', ',', '.')}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Status Item</td>
          
           <td>{{$tracking->status_item}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">Note</td>
          
           <td>{{$tracking->item_description}}</td>
         </tr>
         <tr>
           <td class="col-lg-2">User</td>
          
           <td>{{$tracking->used}}</td>
         </tr>
       </tbody>
       <tfoot>
         <tr class="active">
           <td class="col-lg-2">Created By</td>
          
           <td>{{$tracking->created_by}}</td>
         </tr>
         <tr class="active">
           <td class="col-lg-2">Update Time</td>
          
           <td><?php if ($tracking->updated_at === null): ?>
             {{date('M, d Y  H:i:s', strtotime($tracking->created_at))}} WIB
           <?php else: ?>
           {{date('M, d Y  H:i:s', strtotime($tracking->updated_at))}} WIB
           <?php endif ?></td>
         </tr>
       </tfoot>
      </table>
    </div>
  </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
@stop
