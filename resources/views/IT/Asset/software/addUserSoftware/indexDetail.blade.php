@extends('layout')

@section('title')
    (it) Index Asset Item
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.uikit.min.css">
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Detail {{$software->product}} {{$software->name_software}}</h1> 
        </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <a href="{{route('indexAssetSoftware')}}" class="btn btn-sm btn-default">back</a>
    <a href="#" class="btn btn-sm btn-primary">print</a>
    <a href="{{route('addUserSoftware', [$software->id])}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> user</a>
  </div>
</div>
<hr>
<?php $coint = $software->remains_licenses-count($getData); ?>
<div class="row"> 
    <div class="col-lg-2 form-group">
      <label for="version">Version:</label>
      <input type="text" name="version" class="form-control" value="{{$software->version}}" readonly="true">
    </div>
   <div class="col-lg-2 form-group">
      <label for="expiring_date">Starting Date:</label>
      <input type="text" name="starting_date" class="form-control" value="{{date('M, d Y', strtotime($software->starting_date))}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="expiring_date">Expiring Date:</label>
      <input type="text" name="expiring_date" class="form-control" value="{{date('M, d Y', strtotime($software->expiring_date))}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Total License:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->remains_licenses}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">License ID:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->licensed_id}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Purchase Date:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{date('M, d Y', strtotime($software->purchase_date))}}" readonly="true">
    </div>
    <div class="col-lg-4 form-group">
      <label for="number_licensed">Email Registration:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->email_registrations}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">PO Number:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->po_number1.'/'.$software->po_number2.'-'.$software->po_number3.'/'.$software->po_number4.'/'.$software->po_number5}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Invoice:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->invoice}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Delivery Order:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->delivery_order}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Qty:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->qty}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Unit Price:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->price}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Total Price:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->total_price}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Vendor:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->vendor}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Status:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->status_software}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Created:</label>
      <input type="text" name="number_licensed" class="form-control" value="{{$software->created_by}}" readonly="true">
    </div>
    <div class="col-lg-2 form-group">
      <label for="number_licensed">Check:</label>
      <br>
      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#note">Note</button>
    </div>
</div>

  <div class="modal fade" id="note" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Note: </h4>
        </div>
        <div class="modal-body">
          <p>{{$software->notee}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!--  -->
<hr>
<div class="row">
  <div class="col-lg-12">
    <table type="button" class="table table-striped table-bordered table-hover" width="100%" id="tables">
      <thead>
        <tr>         
          <th>No</th>          
          <th>NIK</th>
          <th>User</th>  
          <th>User License</th>
          <th>Workstation</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        use App\NewUser;
        use App\Ws_Availability;
         ?>
        <?php $no=1; foreach ($getData as $getData_value): ?>
        <?php 
        $user = NewUser::where('id', $getData_value->id_userss)->first();
        $Workstation = Ws_Availability::where('id', $getData_value->id_ws_availability)->first();
         ?>
          <tr>
            <td>{{$no++}}</td>
            <td>{{$user->nik}}</td>
            <td>{{$user->first_name}}  {{$user->last_name}}</td>
            <td>{{$getData_value->use_license}}</td>
            <td>{{$Workstation->hostname}}</td>
            <td><a href="{{route('deleteMarkInventory', [$getData_value->id])}}" class="btn btn-xs btn-danger">remove</a></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div> 
@stop 
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop

