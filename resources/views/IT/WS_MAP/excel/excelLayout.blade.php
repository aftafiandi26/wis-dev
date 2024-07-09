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
    <th colspan="25" style="text-align: center; font-size: 12px;">2D LAYOUT AREA</th>
  </tr>
</table>
<!--  -->
<table>
  <tr>
    <th></th>   
  </tr> 
</table>
<!--  -->
<table>
  <tr>
    <?php for ($i=1; $i <=25 ; $i++) { 
        echo "<td style='width: 13px;'>$i</td>";
    } ?>
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px;'></td>";
    } ?>
    <?php for ($i=1; $i <=11 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
    <td style=" background-color: #ffffff; text-align: left; font-size: 6px;">238</td>
    <td style=" background-color: #ffffff; text-align: left; font-size: 6px;">242</td>
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px;'></td>";
    } ?>
    <td colspan="8" style=" background-color: #DCDCDC; text-align: center;  font-size: 8px;">Meeting Room 2</td>
    <?php for ($i=1; $i <=3 ; $i++) { 
        echo "<td style='width: 13px; background-color: #DCDCDC;'></td>";
    } ?>
    <td style=" background-color: #ffffff; text-align: center;  font-size: 8px;">{{$layout_238->user}}</td>
    <td style=" background-color: #ffffff; text-align: center;  font-size: 8px;">{{$layout_242->user}}</td>
  </tr>
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px;'></td>";
    } ?>
    <?php for ($i=1; $i <=11 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
   <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_238->workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_238->workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_238->workstation}}</td>
    <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_242->workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_242->workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_242->workstation}}</td>     
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=11 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
   <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_238->secondary_workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_238->secondary_workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_238->secondary_workstation}}</td>
    <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_242->secondary_workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_242->secondary_workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_242->secondary_workstation}}</td>      
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=11 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
    <td style=" text-align: center; font-size: 8pc;  width: 13px; background-color: #ffffff;
    <?php
        $monitor1 = Ws_Map::select('monitor1')->where('id', $layout_238->id)->value('monitor1');
        $monitor2 = Ws_Map::select('monitor2')->where('id', $layout_238->id)->value('monitor2');
        
        if ($monitor1 != null) {
            $number1 = 1;
        } else {
           $number1 = 0;
        }
        if ($monitor2 != null) {
            $number2 = 1;
        } else {
           $number2 = 0;
        }
        $totalnumber = $number1+$number2;
        
   ?>
    ">{{$totalnumber}} Monitor</td>
    <td style=" text-align: center; font-size: 8pc;  width: 13px; background-color: #ffffff;
    <?php
        $monitor1 = Ws_Map::select('monitor1')->where('id', $layout_242->id)->value('monitor1');
        $monitor2 = Ws_Map::select('monitor2')->where('id', $layout_242->id)->value('monitor2');
        
        if ($monitor1 != null) {
            $number1 = 1;
        } else {
           $number1 = 0;
        }
        if ($monitor2 != null) {
            $number2 = 1;
        } else {
           $number2 = 0;
        }
        $totalnumber = $number1+$number2;
        
   ?>
    ">{{$totalnumber}} Monitor</td>
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=11 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
    <td style=" text-align: left; font-size: 6pc;  width: 13px; background-color: #ffffff;">239</td>
    <td style=" text-align: left; font-size: 6pc;  width: 13px; background-color: #ffffff;">243</td>
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=11 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
    <td style=" text-align: center; font-size: 8pc;  width: 13px;">{{$layout_239->user}}</td>
    <td style=" text-align: center; font-size: 8pc;  width: 13px;">{{$layout_243->user}}</td>
  </tr>
  <tr>
     <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
   <td colspan="3" style=" background-color: #DCDCDC;"></td>
   <td colspan="2" style=" background-color: #ffffff; text-align: left; font-size: 6px;">237</td>  
   <td colspan="3" style=" background-color: #DCDCDC;"></td>
   <?php for ($i=1; $i <=3 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
   <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_239->workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_239->workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_239->workstation}}</td>
  <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_243->workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_243->workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_243->workstation}}</td>
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
   <td colspan="3" style=" background-color: #DCDCDC;"></td>
   <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_237->workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_237->workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_237->workstation}}</td>
   <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_237->secondary_workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_237->secondary_workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_237->secondary_workstation}}</td>
   <td colspan="3" style=" background-color: #DCDCDC;"></td>
   <?php for ($i=1; $i <=3 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
   <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_239->secondary_workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_239->secondary_workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_239->secondary_workstation}}</td>
  <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
    if ($layout_243->secondary_workstation != null) {
        $availability = Ws_Availability::where('hostname', $layout_243->secondary_workstation)->first(); 
        if ($availability->os != 'Linux') {
        echo "background-color: #ffffff;";
       } else {
         echo "background-color: #ffff80;";
       }
    } else {
      echo "background-color: #ffffff;";
    }   
   ?>
    ">{{$layout_243->secondary_workstation}}</td>
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
   <td colspan="3" style=" background-color: #DCDCDC;"></td>
   <td colspan="2" style=" background-color: #ffffff; text-align: center; font-size: 8px;">2 Monitor</td>
   <td colspan="3" style=" background-color: #DCDCDC;"></td>
   <?php for ($i=1; $i <=3 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
    <td style=" text-align: center; font-size: 8pc;  width: 13px; background-color: #ffffff;
    <?php
        $monitor1 = Ws_Map::select('monitor1')->where('id', $layout_239->id)->value('monitor1');
        $monitor2 = Ws_Map::select('monitor2')->where('id', $layout_239->id)->value('monitor2');
        
        if ($monitor1 != null) {
            $number1 = 1;
        } else {
           $number1 = 0;
        }
        if ($monitor2 != null) {
            $number2 = 1;
        } else {
           $number2 = 0;
        }
        $totalnumber = $number1+$number2;
        
   ?>
    ">{{$totalnumber}} Monitor</td>
    <td style=" text-align: center; font-size: 8pc;  width: 13px; background-color: #ffffff;
    <?php
        $monitor1 = Ws_Map::select('monitor1')->where('id', $layout_243->id)->value('monitor1');
        $monitor2 = Ws_Map::select('monitor2')->where('id', $layout_243->id)->value('monitor2');
        
        if ($monitor1 != null) {
            $number1 = 1;
        } else {
           $number1 = 0;
        }
        if ($monitor2 != null) {
            $number2 = 1;
        } else {
           $number2 = 0;
        }
        $totalnumber = $number1+$number2;
        
   ?>
    ">{{$totalnumber}} Monitor</td>
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=11 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
    <td style=" text-align: left; font-size: 6pc;  width: 13px; background-color: #ffffff;">240</td>
    <td style=" text-align: left; font-size: 6pc;  width: 13px; background-color: #ffffff;">244</td>
  </tr>
  <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=19 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
  </tr>
   <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=19 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
  </tr>
   <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=19 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
  </tr>
   <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=19 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
  </tr>
   <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=19 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
  </tr>
   <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=19 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
  </tr>
   <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=19 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
  </tr>
   <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=19 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
  </tr>
   <tr>
    <?php for ($i=1; $i <=6 ; $i++) { 
        echo "<td style='width: 13px'></td>";
    } ?>
    <?php for ($i=1; $i <=19 ; $i++) { 
      echo '<td style=" background-color: #DCDCDC;"></td>';
    } ?>
  </tr> 
</table>
<!--  -->
<table>
  <tr>
    <td style=" text-align: left; "></td>
    <td style=" text-align: left; font-size: 6px;">160</td>  
  </tr>
  <tr>
    <td style=" text-align: left; "></td>
    <td style=" text-align: center; font-size: 8pc; width: 13px;">{{$layout_160->user}}</td>   
  </tr>
  <tr>
    <td style=" text-align: left; "></td>
    <td style=" text-align: center; font-size: 8pc;  width: 13px;
    <?php  
   $availability = Ws_Availability::where('hostname', $layout_160->workstation)->first(); 
   if ($availability->os != 'Linux') {
    echo "background-color: white;";
   } else {
     echo "background-color: #ffff80;";
   }
   
   ?>
    ">{{$layout_160->workstation}}</td>   
  </tr>
  <tr>
    <td style=" text-align: left; "></td>
    <td style=" text-align: center; font-size: 8pc;  width: 13px;" <?php  ?>>{{$layout_160->secondary_workstation}}</td>   
  </tr>
</table>
<!--  -->
</table>
</body>
</html>