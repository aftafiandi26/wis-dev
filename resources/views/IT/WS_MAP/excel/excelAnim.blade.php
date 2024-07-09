<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
  <title>Layout</title>
</head>
<body>
  <?php use App\Ws_Availability;
  use App\Ws_Map;
  ?>
  <table>
  	<tr>
  		<?php for ($i=1; $i <=30 ; $i++) { 
  			echo "<td>$i</td>";
  		} ?>
  	</tr>
  </table>

</body>
</html>