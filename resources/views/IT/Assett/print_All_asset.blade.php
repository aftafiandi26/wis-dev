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
     <div class="col-md-1">
    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->encoding('UTF-8')->size(150)->generate($instansi.$space.$barcode.$space.$category_name_name.$space.$brand.$space.$SN.$space.$date_incoming.$space.$asset_pr.$space.$addtional.'.')) !!}">
     <br><center>
     <p style="text-align: center; margin-top: -15px; margin-left: 15px;">{{$select->instansi_id.$select->barcode_id.$select->id}}</p></center>
     </div>
     <?php endforeach ?>
     <!-- <?php 
     $instansi1 = "'".$cobaan->instansi_name."'";
                  $barcode1 = "ID : "."'".$cobaan->instansi_id.$cobaan->barcode_id.$cobaan->id."'";
                  $space1 = " || ";
                  $category_name_name1 = "Category Item : "."'".$cobaan->category_name_name."'";
                  $brand1 = "Item Name : "."'".$cobaan->item_description_name."'";
                  $SN1 = "S/N : "."'".$cobaan->SN."'";
                  $date_incoming1 = "Date Incoming : "."'".date('M, d Y', strtotime($cobaan->date_incoming))."'";
                  $asset_pr1 = "Asset : "."'".$cobaan->asset_type_name."'";
                  $addtional1 = "Addtional : "."'".$cobaan->addtional."'";

      $print = $instansi1.$space1.$barcode1.$space1.$category_name_name1.$space1.$brand1.$space1.$SN1.$space1.$date_incoming1.$space1.$asset_pr1.$space1.$addtional1;
      ?>
      <div class="col-md-1">
    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($instansi1.$space1.$barcode1.$space1.$category_name_name1.$space1.$brand1.$space1.$SN1.$space1.$date_incoming1.$space1.$asset_pr1.$space1.$addtional1.'.')) !!}">
     <br>
     <p style="text-align: center; margin-top: -15px; margin-left: 15px;">{{$cobaan->instansi_id.$cobaan->barcode_id.$cobaan->id}}</p>
     </div> -->
  </div>
</div> 
</body>
</html>


