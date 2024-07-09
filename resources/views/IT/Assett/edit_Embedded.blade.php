@extends('layout')

@section('title')
    (it) Edit Asset Item
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
            <h1 class="page-header">Embedded Barcode</h1>                     
        </div>
    </div>
   <div class="panel-body">
    {!! Form::open(['route' => ['POSTembeddedAsset', $select->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
    {{ csrf_field() }}
     <div class="row">  
         <div class="col-lg-4">
            <?php             
            use \Milon\Barcode\DNS2D;
            use \Milon\Barcode\DNS1D;

            $instansi = "'".$select->instansi_name."'";
            $barcode = "ID : "."'".$select->instansi_id.$select->barcode_id.$select->id."'";
            $space = " || ";
            $category_name_name = "Category Item : "."'".$select->category_name_name."'";
            $brand = "Item Name : "."'".$select->item_description_name."'";
            $SN = "S/N : "."'".$select->SN."'";
            $date_incoming = "Date Incoming : "."'".date('M, d Y', strtotime($select->date_incoming))."'";
            $asset_pr = "Asset : "."'".$select->asset_type_name."'";
            $addtional = "Addtional : "."'".$select->addtional."'";
            
            echo DNS2D::getBarcodeHTML($instansi.$space.$barcode.$space.$category_name_name.$space.$brand.$space.$SN.$space.$date_incoming.$space.$asset_pr.$space.$addtional.".", "QRCODE", 2, 2);
            echo $select->instansi_id.$select->barcode_id.$select->id;
             ?>
         </div>         
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" <?php if ($select->embedded === 1) {
                  echo "checked";
              } ?>>
              <label class="form-check-label" for="inlineRadio1">Yes</label>

              </div>           
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0" <?php if ($select->embedded === 0) {
                  echo "checked";
              } ?>>
              <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
        </div>
    </div>                    
     <div class="row">  
        <div class="col-lg-12">  
     {!! Form::submit('Save', ['class' => 'btn btn-sm btn-success']) !!}
        <a class="btn btn-sm btn-warning" href="{!! URL::route('asset-it') !!}">Back</a>
      {!! Form::close() !!}
        </div>
    </div>
@stop

