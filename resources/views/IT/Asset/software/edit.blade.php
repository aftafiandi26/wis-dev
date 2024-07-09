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
    <h1 class="page-header">Edit Item Software {{$getData->product}}</h1>                     
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
<form action="{{route('saveEditInventorySoftware', [$getData->id])}}"  method="post">
{{ csrf_field() }}
<div class="row">
  <div class="col-lg-12">
      <div class="col-lg-2 form-group">
           <label for="Product"><font style="color: red;">*</font>Product Name:</label>
           <input type="text" name="Product" class="form-control" value="{{$getData->product}}" >
      </div>
      <div class="col-lg-2 form-group">
            <label for="Software"><font style="color: red;">*</font>Software Name:</label>
            <input type="text" name="Software" class="form-control" value="{{$getData->name_software}}" >
      </div>
      <div class="col-lg-2 form-group">
            <label for="Version"><font style="color: red;">*</font>Version:</label>
            <input type="text" name="Version" class="form-control" value="{{$getData->version}}" >
      </div>
      <div class="col-lg-2 form-group">
            <label for="Starting"><font style="color: red;">*</font>Starting Date:</label>
            <input type="date" name="Starting" class="form-control"  value="{{$getData->starting_date}}">
      </div>
      <div class="col-lg-2 form-group">
            <label for="Expiring"><font style="color: red;">*</font>Expiring Date:</label>
            <input type="date" name="Expiring" class="form-control"  value="{{$getData->expiring_date}}">
      </div>
      <div class="col-lg-2 form-group">
            <label for="Purchase"><font style="color: red;">*</font>Purchase Date:</label>
            <input type="date" name="Purchase" class="form-control"  value="{{$getData->purchase_date}}">
      </div>
      <div class="col-lg-2 form-group">
            <label for="key_product">Product Key:</label>
            <input type="text" name="key_product" class="form-control" value="{{$getData->product_key}}"  placeholder="xxx-xxxx">
        </div>
        <div class="col-lg-2 form-group">
            <label for="Licensed">Licensed ID:</label>
            <input type="text" name="Licensed" class="form-control" value="{{$getData->licensed_id}}"  placeholder="xxxxx-xx-xxxxxx">
        </div>   
        <div class="col-lg-2 form-group">
            <label for="email">Email Registration:</label>
            <input type="email" name="email" class="form-control" placeholder="Insert Email" value="{{$getData->email_registration}}">
        </div> 
        <div class="col-lg-2 form-group">
            <label for="Vendor"><font style="color: red;">*</font>Vendor:</label>
            <input type="text" name="Vendor" class="form-control" placeholder="name vendor"  value="{{$getData->vendor}}">
        </div>
        <div class="col-lg-2 form-group">
            <label for="Qty"><font style="color: red;">*</font>Qty:</label>
            <input type="number" name="Qty" class="form-control" placeholder="0"  value="{{$getData->qty}}">
        </div>
        <div class="col-lg-2 form-group">
            <label for="total_licensed"><font style="color: red;">*</font>Total Licenses:</label>
            <input type="number" name="total_licensed" class="form-control" placeholder="0" value="{{$getData->total_licensed}}">
        </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">
         <div class="col-lg-4 form-group">
            <label for="PO"><font style="color: red;">*</font>PO Number:</label>
             <div class="input-group">
              <input id="PO1" type="text" class="form-control" name="PO1" placeholder="000" maxlength="50" value="{{$getData->po_number1}}">
              <span class="input-group-addon">/</span>
              <input id="PO2" type="text" class="form-control" name="PO2" placeholder="PO" maxlength="2" value="{{$getData->po_number2}}">
              <span class="input-group-addon">-</span>
              <input id="PO3" type="text" class="form-control" name="PO3" placeholder="KSM" maxlength="3" value="{{$getData->po_number3}}">
              <span class="input-group-addon">/</span>
              <input id="PO4" type="text" class="form-control" name="PO4" placeholder="00" maxlength="2" value="{{$getData->po_number4}}">
              <span class="input-group-addon">/</span>
              <input id="PO5" type="text" class="form-control" name="PO5" placeholder="00" maxlength="2" value="{{$getData->po_number5}}">
            </div>
        </div>
            <div class="col-lg-2 form-group">
            <label for="Invoice">Invoice:</label>
            <input type="text" name="Invoice" id="Invoice" class="form-control" placeholder="Invoice id" value="{{$getData->invoice}}">
        </div>
        <div class="col-lg-2 form-group">
            <label for="DO">Delivery Order:</label>
            <input type="text" name="DO" id="DO" class="form-control"  placeholder="Delivery ID" value="{{$getData->delivery_order}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
         <div class="col-lg-4 form-group">
            <label for="rupiah">Unit Price:</label>
            <div class="row">
              <div class="col-lg-3">
                <select class="form-control" name="mata_uang" >
                    <option value="IDR" <?php if (substr($getData->price, 0, 3) === "IDR") {
                        echo "selected";
                    } ?>>IDR</option>
                    <option value="SGD" <?php if (substr($getData->price, 0, 3) === "SGD") {
                        echo "selected";
                    } ?>>SGD</option>
                    <option value="USD" <?php if (substr($getData->price, 0, 3) === "USD") {
                        echo "selected";
                    } ?>>USD</option>
                </select>
              </div>
              <div class="col-lg-9">
                <input type="text" name="rupiah" class="form-control"  placeholder="x.xxx.xxx.xxx" value="{{substr($getData->price, 4)}}">
              </div>
            </div>            
        </div>
        <div class="col-lg-2 form-group">
            <label for="status"><font style="color: red;">*</font>Status Licensed:</label>
            <select class="form-control" name="status" id="status" >
                <option value="">-Select-</option>              
                <option value="Annual" <?php if ($getData->status_software === "Annual"): ?>
                    selected="true"
                <?php endif ?>>Annual</option>
                <option value="Perpetual" <?php if ($getData->status_software === "Perpetual"): ?>
                    selected="true"
                <?php endif ?>>Perpetual</option>
                <option value="Subscription" <?php if ($getData->status_software === "Subscription"): ?>
                    selected="true"
                <?php endif ?>>Subscription</option>
                <option value="Obsolete" <?php if ($getData->status_software === "Obsolete"): ?>
                    selected="true"
                <?php endif ?>>Obsolete</option>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="type"><font style="color: red;">*</font>Type:</label>
            <select class="form-control" name="type" id="type" >
                <option value="">-Select-</option>              
                <option value="Maintanace" <?php if ($getData->type_software === "Maintanace"): ?>
                  selected="true"
                <?php endif ?>>Maintanace</option>
                <option value="Software" <?php if ($getData->type_software === "Software"): ?>
                  selected="true"
                <?php endif ?>>Software</option>               
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
       <div class="col-lg-4 form-group">
            <label for="note">Note:</label>
            <textarea class="form-control" name="note" id="note" style="height: 150px;">{{$getData->notee}}</textarea>
        </div> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4 form-group">          
           <button type="sumbit" class="btn btn-sm btn-success">Add</button>
           <button type="reset" class="btn btn-sm btn-warning">Reset</button>
           <a href="{{route('indexAssetSoftware')}}" class="btn btn-sm btn-danger" title="back to asset">Go back</a>
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
