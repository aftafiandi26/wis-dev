<!DOCTYPE html>
<html>
<head>
  <title>Barcode - Asset IT</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body> 
<div class="container-fluid">
 <div class="row">
 
   <?php 
   use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator; 
    foreach ($ss as $select): ?>
   <?php 
   $instansi = "'".$select->instansi_name."'";
                  $barcode = "ID : "."'".$select->instansi_id.$select->barcode_id.$select->id."'";
                  $space = " || ";
                  $category_name_name = "Category Item : "."'".$select->category_name_name."'";
                  $brand = "Item Name : "."'".$select->item_description_name."'";
                  $SN = "S/N : "."'".$select->SN."'";
                  $date_incoming = "Date Incoming : "."'".date('M, d Y', strtotime($select->date_incoming))."'";
                  $asset_pr = "Asset : "."'".$select->asset_type_name."'";
                  $addtional = "Addtional : "."'".$select->addtional."'";

      $print = $instansi.$space.$barcode.$space.$category_name_name.$space.$brand.$space.$SN.$space.$date_incoming.$space.$asset_pr.$space.$addtional;
     ?> 
     <img class="btn-sm" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate('$instansi.$space.$barcode.$space.$category_name_name.$space.$brand.$space.$SN.$space.$date_incoming.$space.$asset_pr.$space.$addtional.'.'')) !!}" style="margin-right: -55px;">
        {{$select->instansi_id.$select->barcode_id.$select->id}}
     <?php endforeach ?>
  </div>
</div> 
</body>
</html>


