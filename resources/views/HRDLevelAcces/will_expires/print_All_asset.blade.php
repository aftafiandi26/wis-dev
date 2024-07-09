<!DOCTYPE html>
<html>
<head>
	<title>Barcode - Asset IT</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>

<body>
	<?php 			
			use \Milon\Barcode\DNS2D;					
			
			foreach ($ss as $select) {
			echo '<div class="row">';
			$instansi = "'".$select->instansi_name."'";
			$barcode = "ID : "."'".$select->instansi_id.$select->barcode_id.$select->id."'";
			$space = " || ";
			$category_name_name = "Category Item : "."'".$select->category_name_name."'";
			$brand = "Item Name : "."'".$select->item_description_name."'";
			$SN = "S/N : "."'".$select->SN."'";
			$date_incoming = "Date Incoming : "."'".date('M, d Y', strtotime($select->date_incoming))."'";
			$asset_pr = "Asset : "."'".$select->asset_type_name."'";

			
			echo DNS2D::getBarcodeHTML($instansi.$space.$barcode.$space.$category_name_name.$space.$brand.$space.$SN.$space.$date_incoming.$space.$asset_pr.".", "QRCODE", 2, 2);
			echo '</div>';
		
				}
	?>
</body>
</html>

