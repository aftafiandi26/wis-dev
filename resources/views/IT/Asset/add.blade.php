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
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Input Item Inventory</h1>                     
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
<form action="{{route('storeAddAsset1')}}"  method="post" id="formku">
{{ csrf_field() }}
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-2 form-group">
            <label for="instansi"><font style="color: red;">*</font>Instansi Name:</label>
            <select class="form-control" id="instansi"  name="instansi" required="true"> 
                <option value="">-Select-</option>               
                <option value="1">Kinema Animation</option>
                <option value="2">Kinema Production Services</option>
                <option value="3" disabled="true">Infinite Learning</option>
            </select>
        </div>
         <div class="col-lg-2 form-group">
            <label for="department"><font style="color: red;">*</font>Department:</label>
            <select class="form-control" id="department" name="department"  required="true">
                 <option value="">-Select-</option>
                 <optgroup label="Kinema Animasi">
                  <?php foreach ($department as $key): ?>
                    <option value="{{$key->id}}">{{$key->dept_category_name}}</option>  
                  <?php endforeach ?>
                 </optgroup>
                  <optgroup label="Kinema Production Services">
                        <?php foreach ($ps as $value): ?>
                            <option value="{{$value->id}}">{{$value->dept_category_name}}</option>
                         <?php endforeach ?> 
                  </optgroup>
                  <optgroup label="Infinite Learning" disabled="true">
                      
                  </optgroup>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-2 form-group">
            <label for="asset_type"><font style="color: red;">*</font>Asset Type:</label>
            <select class="form-control" id="asset_type" name="asset_type"  required="true">
                <option value="">-Select-</option>
                <option value="2">Transfer</option>
                <option value="1">Purchase</option>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="asset_category"><font style="color: red;">*</font>Asset Category:</label>
            <select class="form-control" id="asset_category" name="asset_category"  required="true">
                <option value="">-Select-</option>
                <option value="1">Asset</option>
                <option value="2">Integrable Asset</option>
                <option value="3">Non Asset</option>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="category_type"><font style="color: red;">*</font>Category Type:</label>
            <select class="form-control" id="category_type" name="category_type"  required="true">
                <option value="">-Select-</option>
                <option value="1">Hardware</option>
                <option value="2">Equipment</option>
                <option value="3">Tool</option>              
            </select>
        </div>       
        <div class="col-lg-2 form-group">
            <label for="category_name"><font style="color: red;">*</font>Category Name:</label>
            <select class="form-control" id="category_name" name="category_name" required="true">
                <option value="">-Select-</option>
                <?php foreach ($cname as $vvalue): ?>
                    <option value="{{$vvalue->key_mark}}">{{$vvalue->category_cname}}</option>
                <?php endforeach ?>
              
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="Incoming">Date Incoming:</label>
            <input type="date" name="Incoming" id="Incoming" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">        
        <div class="col-lg-2 form-group">
            <label for="brand"><font style="color: red;">*</font>Brand:</label>
            <input type="text" name="brand" id="brand" class="form-control" required="true">
        </div>
        <div class="col-lg-2 form-group">
            <label for="series"><font style="color: red;">*</font>Series:</label>
            <input type="text" name="series" id="series" class="form-control"  required="true">
        </div>
        <div class="col-lg-2 form-group" style="display: none;">
            <label for="SN"><font style="color: red;">*</font>Serial Number:</label>
            <input type="text" name="SN" id="SN" class="form-control">
        </div>
        <div class="col-lg-2 form-group">
            <label for="PN">Part Number:</label>
            <input type="text" name="PN" id="PN" class="form-control">
        </div>
        <div class="col-lg-2 form-group" style="display: none;">
            <label for="ifw">IFW Code:</label>
            <input type="text" name="ifw" id="ifw" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4 form-group">
            <label for="PO">PO Number:</label>
             <div class="input-group">
              <input id="PO1" type="text" class="form-control" name="PO1" placeholder="000" maxlength="5"  required="true">
              <span class="input-group-addon">/</span>
              <input id="PO2" type="text" class="form-control" name="PO2" placeholder="PO" maxlength="2"  required="true">
              <span class="input-group-addon">-</span>
              <input id="PO3" type="text" class="form-control" name="PO3" placeholder="KSM" maxlength="3"  required="true">
              <span class="input-group-addon">/</span>
              <input id="PO4" type="text" class="form-control" name="PO4" placeholder="00" maxlength="2"  required="true">
              <span class="input-group-addon">/</span>
              <input id="PO5" type="text" class="form-control" name="PO5" placeholder="00" maxlength="2"  required="true">
            </div>
        </div>
        <div class="col-lg-2 form-group">
            <label for="Invoice">Invoice:</label>
            <input type="text" name="Invoice" id="Invoice" class="form-control" >
        </div>
        <div class="col-lg-2 form-group">
            <label for="DO">DO:</label>
            <input type="text" name="DO" id="DO" class="form-control" >
        </div>
        <div class="col-lg-2 form-group">
            <label for="vendor">Vendor:</label>
            <input type="text" name="vendor" id="vendor" class="form-control" required="true">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
         <div class="col-lg-4 form-group">
            <label for="rupiah">Unit Price:</label>
            <div class="row">
              <div class="col-lg-3">
                <select class="form-control" name="mata_uang"  required="true">
                    <option value="IDR">IDR</option>
                    <option value="SGD">SGD</option>
                    <option value="USD">USD</option>
                </select>
              </div>
              <div class="col-lg-9">
                <input type="number" name="rupiah" class="form-control"  required="true" min="0">
              </div>
            </div>            
        </div>
        <div class="col-lg-2 form-group">
            <label for="status"><font style="color: red;">*</font>Status Item:</label>
            <select class="form-control" name="status" id="status"  required="true" >
                <option value="0">-Select-</option>
                <option value="Good">Good</option>
                <option value="Fail">Fail</option>
                <option value="Use">In Use</option>
                <option value="Idle">Idle</option>
                <option value="Scrapped">Scrapped</option>                
                <option value="Unknown">Unknown</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="qty"><font style="color: red;">*</font>Qty:</label>
            <input type="number" name="qty" class="form-control" id="qty" required="true" min="0">
        </div>
        <div class="col-lg-2 form-group">
            <label for="uom"><font style="color: red;">*</font>UOM:</label>
            <input type="text" name="uom" id="uom" class="form-control" required="true">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
       <div class="col-lg-4 form-group">
            <label for="note">Note:</label>
            <textarea class="form-control" name="note" id="note" style="height: 150px;"></textarea>
        </div> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4 form-group">          
           <button type="sumbit" class="btn btn-sm btn-success">Add</button>
           <button type="reset" class="btn btn-sm btn-warning">Reset</button>
           <a href="{{route('indexUtamaAsset')}}" class="btn btn-sm btn-danger" title="back to asset">Go back</a>        
           <button class="btn btn-small btn-default" onclick="additem(); return false"><i class="glyphicon glyphicon-plus"></i></button>
        </div> 
    </div>   
</div>
<div class="row">
    <div class="col-lg-12">
         <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th width="200px">Serial Number</th>
                                <th width="200px">IFW Code</th>
                                <th width="80px"></th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
                            <tr>
                                <td><input name="jenis_input[0]" class="form-control" /></td>
                                <td><input name="jumlah_input[0]" class="form-control" /></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-small btn-default" onclick="additem(); return false"><i class="glyphicon glyphicon-plus"></i></button>                                   
                                </td>
                            </tr>
                        </tfoot>
                    </table>

    </div>
 
</div>
</form>
<script type="text/javascript">
///////////////////////////////////////////////////////////////////////
 var i = 1;
            function additem() {
                var itemlist = document.getElementById('itemlist');
                
//                membuat element
                var row = document.createElement('tr');
                var jenis = document.createElement('td');
                var jumlah = document.createElement('td');
                var aksi = document.createElement('td');

//                meng append element
                itemlist.appendChild(row);
                row.appendChild(jenis);
                row.appendChild(jumlah);
                row.appendChild(aksi);

//                membuat element input
                var jenis_input = document.createElement('input');
                jenis_input.setAttribute('name', 'jenis_input['+ i +']');
                jenis_input.setAttribute('class', 'form-control');

                var jumlah_input = document.createElement('input');
                jumlah_input.setAttribute('name', 'jumlah_input['+ i +']');
                jumlah_input.setAttribute('class', 'form-control');

                var hapus = document.createElement('span');

                jenis.appendChild(jenis_input);
                jumlah.appendChild(jumlah_input);
                aksi.appendChild(hapus);

                hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="glyphicon glyphicon-trash"></i></button>';
//                Aksi Delete
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };

                i++;
            }
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
