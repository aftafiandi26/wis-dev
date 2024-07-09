<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
</head> 
<body>
<div class="container-fluid">
  <div class="row">
        <div class="col-lg-12" style="margin-left: 0px;">
            <table>
                <thead>
                    <tr>
                        <th colspan="5">PT. KINEMA SYTRANS MULTIMEDIA</th>
                    </tr>
                    <tr>
                        <th colspan="5">Attendance Report</th>
                    </tr> 
                    <tr>
                        <th colspan="5">{{ $dataDept->dept_category_name }}</th>
                    </tr>                    
                </thead>
            </table>         
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12" style="margin-left: 0px;">
        <table class="table table-hover" border="1">
          <thead>
              <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Name</th>
                <th>Check In</th>        
                <th>Check Out</th>
                <th>Date</th>
                <th>Time</th>         
              </tr>
          </thead>
          <tbody>
               <?php foreach ($dataAttendaces as $dataAttendace): ?>
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $dataAttendace->nik }}</td>
                    <td>{{ $dataAttendace->first_name.' '.$dataAttendace->last_name }}</td>
                    <td>{{ $dataAttendace->timeIN }}</td>
                    <td>{{ $dataAttendace->timeOUT }}</td>
                    <td>
                        <?php if ($dataAttendace->check_out === 1): ?>
                          {{ $dataAttendace->date_check_out }}
                        <?php else: ?>
                          {{ $dataAttendace->date_check_in }}
                        <?php endif ?>
                    </td>
                    <td>
                      <?php 

                          $awal  = strtotime($dataAttendace->timeIN); //waktu awal
                          $akhir = strtotime($dataAttendace->timeOUT); //waktu akhir

                          $diff  = $akhir - $awal;

                          $jam   = floor($diff / (60 * 60));
                          $menit = $diff - $jam * (60 * 60);
                          $detik = $diff - $menit * (60 * 60 * 60);

                          $waktu = $jam .' jam, ' . floor( $menit / 60 ) . ' menit';

                          if ($dataAttendace->check_out === 1) {
                            echo $waktu;
                          }
                          else{
                            echo "--";
                          }                  
                       ?>
                    </td>              
                  </tr>
                  <?php endforeach ?>
          </tbody>         
        </table>        
      </div>
    </div>  
</div>
</body>
</html>