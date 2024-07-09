<?php   
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;
?>
@extends('layout')

@section('title')
    (pdf) {{$title->category_cname}}
@stop
<!--  <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} "> -->
@section('body')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<div class="container-fluid">
  <div class="row">
<?php foreach ($data as $key => $value): ?>
  <?php 
  $asset = $value->barcode." | ".$value->dept_name." | "."Asset Type: ".$value->asset_type_name." | "."Brand: ".$value->brand." | "."SN: ".$value->serial_number." | "."PO: ".$value->view_po_number." | "."Invoice: ".$value->invoice." | "."Incoming: ".date('M, d-Y', strtotime($value->date_incoming))." | "."IFW Code: ".$value->ifw_code;
   ?>
   	<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->errorCorrection('H')->size(120)->generate($asset)) !!} ">
    <small style="margin-left: -100px; font-size: 13px;">{{$value->barcode}}</small>
<?php endforeach ?>
  </div>
</div>
@stop