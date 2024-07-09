@extends('layout')

@section('title')
    (it) New Asset Item
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
    <h1 class="page-header">Edit Item Iventory</h1>                     
    </div>
</div>
<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</div>
<form action="{{route('SaveEditAssetTracking', [$getData->id])}}"  method="post">
{{ csrf_field() }}
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-2 form-group">
            <label for="instansi"><font style="color: red;">*</font>Instansi Name:</label>
            <select class="form-control" id="instansi"  name="instansi" required="true"> 
                <option value="{{$getData->instansi_id}}">{{$getData->instansi_name}}</option>
               <optgroup label="instansi">
                <option value="1" <?php if ($getData->instansi_id === 1) {
                    echo 'disabled';
                } ?>>Kinema Animation</option>
                <option value="2"<?php if ($getData->instansi_id === 2) {
                    echo 'disabled';
                } ?>>Kinema Production Services</option>
                <option value="3" disabled="true">Infinite Learning</option>
                </optgroup>              
            </select>
        </div>
         <div class="col-lg-2 form-group">
            <label for="department"><font style="color: red;">*</font>Department:</label>
            <select class="form-control" id="department" name="department" required="true">
                <option value="{{$getData->dept_id}}">{{$getData->dept_name}}</option>
                 <optgroup label="Kinema Animasi">
                  <?php foreach ($department as $key): ?>
                    <option value="{{$key->id}}" <?php if ($getData->dept_id === $key->id) {
                       echo 'disabled';
                    } ?>>{{$key->dept_category_name}}</option>  
                  <?php endforeach ?>
                 </optgroup>
                  <optgroup label="Kinema Production Services">
                        <?php foreach ($ps as $value): ?>
                            <option value="{{$value->id}}" <?php if ($getData->dept_id === $value->id) {
                       echo 'disabled';
                    } ?>>{{$value->dept_category_name}}</option>
                         <?php endforeach ?> 
                  </optgroup>
                  <optgroup label="Infinite Learning" disabled="true">                      
                  </optgroup>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="instansi"><font style="color: red;">*</font>Barcode:</label>
           <input type="text" name="barcode" class="form-control" value="{{$getData->barcode}}" readonly="true">
        </div>
        <div class="col-lg-2 form-group">
            <label for="instansi"><font style="color: red;">*</font>Tracking Number:</label>
           <input type="text" name="tracking" class="form-control" value="{{$getData->tracking_number}}" readonly="true">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-2 form-group">
            <label for="asset_type"><font style="color: red;">*</font>Asset Type:</label>
            <select class="form-control" id="asset_type" name="asset_type" required="true">
                <option value="{{$getData->asset_type_id}}">{{$getData->asset_type_name}}</option>
                <optgroup label="Asset Type">
                <option value="2" <?php if ($getData->asset_type_id === 2) {
                    echo "disabled";
                } ?>>Transfer</option>
                <option value="1" <?php if ($getData->asset_type_id === 1) {
                    echo "disabled";
                } ?>>Purchase</option>
                </optgroup>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="asset_category"><font style="color: red;">*</font>Asset Category:</label>
            <select class="form-control" id="asset_category" name="asset_category" required="true">
                <option value="{{$getData->asset_category_id}}">{{$getData->asset_category_name}}</option>
                <optgroup label="Asset Category">
                <option value="1" <?php if ($getData->asset_category_id === 1) {
                   echo "disabled";
                } ?>>Asset</option>
                <option value="2" <?php if ($getData->asset_category_id === 2) {
                   echo "disabled";
                } ?>>Integrable Asset</option>
                <option value="3" <?php if ($getData->asset_category_id === 3) {
                   echo "disabled";
                } ?>>Non Asset</option>
                </optgroup>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="category_type"><font style="color: red;">*</font>Category Type:</label>
            <select class="form-control" id="category_type" name="category_type" required="true">
                <option value="{{$getData->category_type_id}}">{{$getData->category_type_name}}</option>
                <optgroup label="Category Type">
                <option value="1" <?php if ($getData->category_type_id === 1) {
                    echo "disabled";
                } ?>>Hardware</option>
                <option value="2" <?php if ($getData->category_type_id === 2) {
                    echo "disabled";
                } ?>>Equipment</option>
                <option value="3" <?php if ($getData->category_type_id === 3) {
                    echo "disabled";
                } ?>>Tool</option>
                <option value="4" <?php if ($getData->category_type_id === 4) {
                    echo "disabled";
                } ?>>Software</option>
                </optgroup>
            </select>
        </div>       
        <div class="col-lg-2 form-group">
            <label for="category_name"><font style="color: red;">*</font>Category Name:</label>
            <select class="form-control" id="category_name" name="category_name" required="true">
                <option value="{{$getData->category_name_id}}">{{$getData->category_name_name}}</option>
                <optgroup label="Category Name">
               <?php foreach ($cname as $key_cname): ?>
                   <option value="{{$key_cname->key_mark}}" <?php if ($getData->category_name_id === $key_cname->key_mark) {
                       echo "disabled";
                   } ?>>{{$key_cname->category_cname}}</option>
               <?php endforeach ?>
                </optgroup>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="Incoming">Date Incoming:</label>
            <input type="date" name="Incoming" id="Incoming" class="form-control" value="{{$getData->date_incoming}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">        
        <div class="col-lg-2 form-group">
            <label for="brand"><font style="color: red;">*</font>Brand:</label>
            <input type="text" name="brand" id="brand" class="form-control" required="true" value="{{$getData->brand}}">
        </div>
        <div class="col-lg-2 form-group">
            <label for="series"><font style="color: red;">*</font>Series:</label>
            <input type="text" name="series" id="series" class="form-control" required="true" value="{{$getData->series}}">
        </div>
        <div class="col-lg-2 form-group">
            <label for="SN"><font style="color: red;">*</font>Serial Number:</label>
            <input type="text" name="SN" id="SN" class="form-control" required="true" value="{{$getData->serial_number}}">
        </div>
        <div class="col-lg-2 form-group">
            <label for="PN">Part Number:</label>
            <input type="text" name="PN" id="PN" class="form-control" value="{{$getData->part_number}}">
        </div>
        <div class="col-lg-2 form-group">
            <label for="ifw">IFW Code:</label>
            <input type="text" name="ifw" id="ifw" class="form-control" value="{{$getData->ifw_code}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4 form-group">
            <label for="PO">PO Number:</label>
             <div class="input-group">
              <input id="PO1" type="text" class="form-control" name="PO1" placeholder="000" maxlength="5" required="true" value="{{$getData->po_number1}}">
              <span class="input-group-addon">/</span>
              <input id="PO2" type="text" class="form-control" name="PO2" placeholder="PO" maxlength="2" required="true"  value="{{$getData->po_number2}}">
              <span class="input-group-addon">-</span>
              <input id="PO3" type="text" class="form-control" name="PO3" placeholder="KSM" maxlength="3" required="true" value="{{$getData->po_number3}}">
              <span class="input-group-addon">/</span>
              <input id="PO4" type="text" class="form-control" name="PO4" placeholder="00" maxlength="2" required="true" value="{{$getData->po_number4}}">
              <span class="input-group-addon">/</span>
              <input id="PO5" type="text" class="form-control" name="PO5" placeholder="00" maxlength="2" required="true" value="{{$getData->po_number5}}">
            </div>
        </div>
        <div class="col-lg-2 form-group">
            <label for="Invoice">Invoice:</label>
            <input type="text" name="Invoice" id="Invoice" class="form-control" required="true" value="{{$getData->invoice}}">
        </div>
        <div class="col-lg-2 form-group">
            <label for="DO">DO:</label>
            <input type="text" name="DO" id="DO" class="form-control" required="true" value="{{$getData->delivery_order}}">
        </div>
        <div class="col-lg-2 form-group">
            <label for="vendor">Vendor:</label>
            <input type="text" name="vendor" id="vendor" class="form-control" required="true" value="{{$getData->vendor}}">
        </div>
         <div class="col-lg-4 form-group">
            <label for="rupiah">Price:</label>
            <div class="row">
              <div class="col-lg-3">
                <select class="form-control" name="mata_uang" required="true">
                  
                    <option value="Rp" <?php if (substr($getData->price, 0, 2) === "Rp") {
                        echo "selected";
                    } ?>>RP</option>
                    <option value="S$"<?php if (substr($getData->price, 0, 2) === "S$") {
                        echo "selected";
                    } ?>>S$</option>
                    <option value="US$" <?php if (substr($getData->price, 0, 3) === "US$") {
                        echo "selected";
                    } ?>>US$</option>
                </select>
              </div>
              <div class="col-lg-9">
                <input type="number" name="rupiah" class="form-control" required="true" value="{{$getData->nominal}}">
              </div>
            </div>            
        </div>
        <div class="col-lg-2 form-group">
            <label for="status"><font style="color: red;">*</font>Status Item:</label>
            <select class="form-control" name="status" id="status" required="true">
                <option value="0">-Select-</option>
                <option value="Good" <?php if ($getData->status_item === "Good") {
                  echo "selected";
                } ?>>Good</option>
                <option value="Fail" <?php if ($getData->status_item === "Fail") {
                  echo "selected";
                } ?>>Fail</option>
                <option value="Use" <?php if ($getData->status_item === "Use") {
                  echo "selected";
                } ?>>In Use</option>
                 <option value="Idle" <?php if ($getData->status_item === "Idle") {
                  echo "selected";
                } ?>>Idle</option>
                <option value="Scrapped" <?php if ($getData->status_item === "Scrap") {
                  echo "selected";
                } ?>>Scrapped</option>                
                <option value="Unknown" <?php if ($getData->status_item === "Unknown") {
                  echo "selected";
                } ?>>Unknown</option>
                <option value="Other" <?php if ($getData->status_item === "Other") {
                  echo "selected";
                } ?>>Other</option>
            </select>
        </div>
         <div class="col-lg-2 form-group">
            <label for="userss">Name User:</label>
            <input type="text" name="userss" class="form-control" value="{{$getData->used}}" id="userss">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
       <div class="col-lg-4 form-group">
            <label for="note">Note:</label>
            <textarea class="form-control" name="note" id="note" style="height: 150px;">{{$getData->item_description}}</textarea>
        </div> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4 form-group">          
           <button type="sumbit" class="btn btn-sm btn-success">Save</button>
           <button type="reset" class="btn btn-sm btn-warning">Reset</button>
           <a href="{{route('indextAsset1', [$getData->category_name_id])}}" class="btn btn-sm btn-danger" title="back to asset">Go back</a>
        </div> 
    </div>
</div>
</form>
<script type="text/javascript">
    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function(e) {   
      rupiah.value = formatRupiah(this.value, "");
    });
 
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
      }

      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
    }
</script>
@stop

@section('bottom')
    @include('assets_script_1')
@stop
