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
			$addtional = "Addtional : "."'".$select->addtional."'";
			
			/*echo DNS2D::getBarcodeHTML($instansi.$space.$barcode.$space.$category_name_name.$space.$brand.$space.$SN.$space.$date_incoming.$space.$asset_pr.$space.$addtional.".", "QRCODE", 2, 2);
			echo $select->instansi_id.$select->barcode_id.$select->id;*/
			echo "---------------------------------EAN8";
			echo DNS1D::getBarcodeHTML("4445", "EAN8");
			echo "<br>";
			echo "---------------------------------C39";
			echo DNS1D::getBarcodeHTML("4445645656", "C39");
			echo "<br>";
			echo "---------------------------------C39+";
			echo DNS1D::getBarcodeHTML("4445645656", "C39+");
			echo "<br>";
			echo "----------------------------------C39E";
			echo DNS1D::getBarcodeHTML("4445645656", "C39E");
			echo "<br>";
			echo "---------------------------------C39E+";
			echo DNS1D::getBarcodeHTML("4445645656", "C39E+");
			echo "<br>";
			echo "---------------------------------C93";
			echo DNS1D::getBarcodeHTML("4445645656", "C93");
			echo "<br>";
			echo "-----------------------------------S25";
			echo DNS1D::getBarcodeHTML("4445645656", "S25");
			echo "<br>";
			echo "----------------------------------S25+";
			echo DNS1D::getBarcodeHTML("4445645656", "S25+");
			echo "<br>";
			echo "-------------------------------I25";
			echo DNS1D::getBarcodeHTML("4445645656", "I25");
			echo "<br>";
			echo "-------------------------------------";
			echo DNS1D::getBarcodeHTML("4445645656", "I25+");
			echo "<br>";
			echo "----------------------------------C128";
			echo DNS1D::getBarcodeHTML("4445645656", "C128");
			echo "<br>";
			echo "-----------------------------------C128A";
			echo DNS1D::getBarcodeHTML("4445645656", "C128A");
			echo "<br>";
			echo "-------------------------------C128B";
			echo DNS1D::getBarcodeHTML("4445645656", "C128B");
			echo "<br>";
			echo "---------------------------------C128C";
			echo DNS1D::getBarcodeHTML("4445645656", "C128C");
			echo "<br>";
			echo "----------------------------------EAN2";
			echo DNS1D::getBarcodeHTML("44455656", "EAN2");
			echo "<br>";
			echo "---------------------------------EAN5";
			echo DNS1D::getBarcodeHTML("4445656", "EAN5");
			echo "<br>";
			echo "------------------------------EAN8";
			echo DNS1D::getBarcodeHTML("4445", "EAN8");
			echo "<br>";
			echo "---------------------------------EAN13";
			echo DNS1D::getBarcodeHTML("4445", "EAN13");
			echo "<br>";
			echo "---------------------------------UPCA";
			echo DNS1D::getBarcodeHTML("4445645656", "UPCA");
			echo "<br>";
			echo "---------------------------------UPCE";
			echo DNS1D::getBarcodeHTML("4445645656", "UPCE");
			echo "<br>";
			echo "-------------------------------MSI";
			echo DNS1D::getBarcodeHTML("4445645656", "MSI");
			echo "<br>";
			echo "---------------------------------MSI";
			echo DNS1D::getBarcodeHTML("4445645656", "MSI+");
			echo "<br>";
			echo "----------------------------------POSTNET";
			echo DNS1D::getBarcodeHTML("4445645656", "POSTNET");
			echo "<br>";
			echo "----------------------------------PLANET";
			echo DNS1D::getBarcodeHTML("4445645656", "PLANET");
			echo "<br>";
			echo "----------------------------------RMS4CC";
			echo DNS1D::getBarcodeHTML("4445645656", "RMS4CC");
			echo "<br>";
			echo "--------------------------------KIX";
			echo DNS1D::getBarcodeHTML("4445645656", "KIX");
			echo "<br>";
			echo "-----------------------------------IMB";
			echo DNS1D::getBarcodeHTML("4445645656", "IMB");
			echo "<br>";
			echo "---------------------------------CODABAR";
			echo DNS1D::getBarcodeHTML("4445645656", "CODABAR");
			echo "<br>";
			echo "----------------------------------CODE11";
			echo DNS1D::getBarcodeHTML("4445645656", "CODE11");
			echo "<br>";
			echo "---------------------------------PHARMA";
			echo DNS1D::getBarcodeHTML("4445645656", "PHARMA");
			echo "<br>";
			echo "-----------------------------------PHARMA2T";
			echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T");
			 ?>
<!-- 	<p style="text-align: center;"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($instansi.$space.$barcode.$space.$category_name_name.$space.$brand.$space.$SN.$space.$date_incoming.$space.$asset_pr.$space.$addtional.'.')) !!}"></p>
    <p style="text-align: center; margin-top: -35px;">{{$select->instansi_id.$select->barcode_id.$select->id}}</p> -->
					
	</div>	
</div>
</body>
</html>

