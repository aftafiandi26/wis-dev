<!DOCTYPE html>
<html>
<head>
	<title>Barcode - Asset IT</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>
<style type="text/css" >
	@font-face {
    font-family: 'LibreBarcode';
    src: url({{ asset('vendor/dompdf/dompdf/lib/fonts/LibreBarcode128Text-Regular.ttf') }}) format("truetype");
}
.tt {
    font-family: "LibreBarcode";
    font-size: 38px;
    margin-top: 40px;
}

.clre {
	object-position: center;
	position: center;
}

</style>

<body>
<div class="row">	
	<div class="col-sm-12">
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

			
			echo DNS2D::getBarcodeHTML($instansi.$space.$barcode.$space.$category_name_name.$space.$brand.$space.$SN.$space.$date_incoming.$space.$asset_pr.".", "QRCODE", 2, 2);
			echo $select->instansi_id.$select->barcode_id.$select->id;

		/*	echo "<br>";
			echo "<br>";
			echo "<br>";
			
			echo DNS1D::getBarcodeHTML($select->barcode_id.$select->id, "C39E", 1,33);
			echo $select->barcode_id.$select->id;*/
			 ?>
					
	</div>	
</div>
</body>
</html>

