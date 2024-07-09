<!DOCTYPE html>
<html>
<head>
    <title>Transportaion</title>
</head>
<body>
<?php use App\Bus_Transportation; ?>
<table>
    <thead>
        <tr>
            <th colspan="2" rowspan="2" style="text-align: center;">LIST BOOKING TRANSPORTATION</th>
        </tr>
    </thead>
</table>
<?php 
           $awal = $dated;
           $akhir = $datedd;
           for ($i=$awal; $i <=$akhir ; $i++) { 
            
                $tanggal = Bus_Transportation::where('date_booking', $i)->where('lockey', 1)->value('date_booking');
                  
                 $A = Bus_Transportation::where('date_booking', $i)->where('time_booking', '08:00')->where('lockey', 1)->count(); 
                 $B = Bus_Transportation::where('date_booking', $i)->where('time_booking', '08:20')->where('lockey', 1)->count(); 
                 $C = Bus_Transportation::where('date_booking', $i)->where('time_booking', '08:40')->where('lockey', 1)->count();  
                 $D = Bus_Transportation::where('date_booking', $i)->where('time_booking', '09:00')->where('lockey', 1)->count();
                 $E = Bus_Transportation::where('date_booking', $i)->where('time_booking', '09:20')->where('lockey', 1)->count();  
                 $F = Bus_Transportation::where('date_booking', $i)->where('time_booking', '09:40')->where('lockey', 1)->count();  
                 $total_1 = $A+$B+$C+$D+$E+$F;

                 $G = Bus_Transportation::where('date_booking', $i)->where('time_booking', '17:00')->where('lockey', 1)->count();
                 $H = Bus_Transportation::where('date_booking', $i)->where('time_booking', '19:00')->where('lockey', 1)->count();  
                 $I = Bus_Transportation::where('date_booking', $i)->where('time_booking', '21:00')->where('lockey', 1)->count();
                 $J = Bus_Transportation::where('date_booking', $i)->where('time_booking', '23:00')->where('lockey', 1)->count();
                 $total_2 = $G+$H+$I+$J;   

                 $tgl = date('Y-m-d, l', strtotime($tanggal));
                if ($tanggal != null) {
                   if ($key === "1") {
                        echo '
                            <table class="table-bordered" border="1">
                                <thead>
                                    <tr>            
                                        <th colspan="2" style="text-align: center;">'.$tgl.'</th>
                                    </tr>
                                    <tr>            
                                        <th colspan="2" style="text-align: center;">Dormitory To Studio</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">Time</th>
                                        <th style="text-align: center;">Employee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;">08:00 AM</td>
                                        <td style="text-align: center;">'.$A.'</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">08:20 AM</td>
                                        <td style="text-align: center;">'.$B.'</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">08:40 AM</td>
                                        <td style="text-align: center;">'.$C.'</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">09:00 AM</td>
                                        <td style="text-align: center;">'.$D.'</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">09:20 AM</td>
                                        <td style="text-align: center;">'.$E.'</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">09:40 AM</td>
                                        <td style="text-align: center;">'.$F.'</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;">Total</th>
                                        <th style="text-align: center;">'.$total_1.'</th>
                                    </tr>
                                </tfoot>
                               </table>
                         ';
                   } elseif ($key === "2") {
                       echo '
                            <table class="table-bordered" border="1">
                                <thead>
                                    <tr>            
                                        <th colspan="2" style="text-align: center;">'.$tgl.'</th>
                                    </tr>
                                    <tr>            
                                        <th colspan="2" style="text-align: center;">From Studio To Dormitory</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">Time</th>
                                        <th style="text-align: center;">Employee</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    <tr>
                                        <td style="text-align: center;">05:00 PM</td>
                                        <td style="text-align: center;">'.$G.'</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">07:00 PM</td>
                                        <td style="text-align: center;">'.$H.'</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">09:00 PM</td>
                                        <td style="text-align: center;">'.$I.'</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">11:00 PM</td>
                                        <td style="text-align: center;">'.$J.'</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;">Total</th>
                                        <th style="text-align: center;">'.$total_2.'</th>
                                    </tr>                   
                                </tfoot>
                               </table>
                         ';
                   }
                   
                } else {
                    # code...
                }
           }
        ?>  
</body>
</html>