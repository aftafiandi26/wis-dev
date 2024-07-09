<!DOCTYPE html>
<html lang="en">
<head>  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='shortcut icon' href="{{asset('assets/12.png')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
  <title>WS- Map Office</title>
</head>
<body>
  <div class="row">
    <div>          
       <h1 class="page-header text-center" style="margin-top: -40px;">Office</h1>                   
    </div>
</div>
<?php use App\Ws_Availability; ?>
<!-- start row -->
<div class="row">
  <!-- Well HR -->
 <div class="col-sm-3">
   <div class="well well-sm" style="width: 630px;">
    <p style="font-size: 18px;"><center>HRD Room</center></p>
     <div class="well well-sm" style="background: white; height: 1150px;">
      <!-- Panel 1 -->
      <div class="col-sm-6">
        <div class="well well-sm" style="height: 300px;">
         <div class="col-sm-1" style="width: 120px; margin-top: 50px; margin-left: 40px;">
          <div class="panel panel-default">
           <div class="panel-heading">254</div>
            <div class="panel-body text-center" style="height: 100px; font-size: 18px;">
              <label>
              <p>{{$Officer_380->user}}</p>
              <p>{{$Officer_380->workstation}}</p>       
              <p>{{$Officer_380->secondary_workstation}}</p>
              </label>
            </div>
           </div>
         </div>
        </div>
      </div>
      <!-- Panel 1 -->
      <!-- Panel 2 -->
      <div class="col-sm-6" style="margin-left: 310px;">
        <div class="well well-sm" style="height: 300px; width: 250px;">
         <div class="col-sm-1" style="width: 120px; margin-top: 100px; margin-left: 80px;">
            <label style="font-size: 18px;">Bunker</label>
         </div>
        </div>
      </div>
      <!-- Panel 2 -->
      <!-- Panel 3 -->
      <div class="col-sm-6" style="margin-left: 0px; margin-top: 330px;">
        <div class="well well-sm" style="height: 300px;">
         <div class="col-sm-1" style="width: 120px; margin-top: 100px; margin-left: 70px;">
            <label style="font-size: 18px;">Panel Room</label>
         </div>
        </div>
      </div>
      <!-- Panel 3 -->
       <!-- Panel 3 -->
      <div class="col-sm-12" style="margin-left: 0px; margin-top: 660px;">
        <div class="well well-sm" style="height: 450px;">
         <div class="col-sm-1" style="width: 120px;">
           <div class="panel panel-group">
              <div class="panel panel-default">
                  <div class="panel-heading">381</div>
                  <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                    <label>
                    <p>{{$Officer_381->user}}</p>
                    <p style="text-decoration: <?php if ($Officer_381->workstation === $Officer_381->hostname) {
                      if ($Officer_381->os === 'Linux') {
                     echo "underline";
                       }         
                    }?>;">{{$Officer_381->workstation}}</p>       
                    <p style="text-decoration: <?php
                    if ($Officer_381->secondary_workstation != null) {
                       $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_381->secondary_workstation)->first();
                        if ($Linux_1->os === 'Linux') {
                          echo "underline";
                        }
                    }
                    ?>;">{{$Officer_381->secondary_workstation}}</p>
                  </label>
                  </div>
              </div>
              <div class="panel panel-default">
                  <div class="panel-heading">382</div>
                  <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                    <label>
                    <p>{{$Officer_383->user}}</p>                   
                    <p>{{$Officer_383->workstation}}</p>       
                    <p>{{$Officer_383->secondary_workstation}}</p>
                  </label>
                  </div>
              </div>
            </div>
             <div class="col-sm-1" style="width: 120px; margin-left: 180px; margin-top: -190px;">
              <div class="panel panel-default">
                    <div class="panel-heading">383</div>
                    <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                      <label>
                      <p>{{$Officer_384->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_384->workstation === $Officer_384->hostname) {
                        if ($Officer_384->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_384->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_384->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_384->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_384->secondary_workstation}}</p>
                    </label>
                    </div>
                </div>
             </div>
              <div class="col-sm-1" style="width: 120px; margin-left: 300px; margin-top: 0px;">
              <div class="panel panel-default">
                    <div class="panel-heading">384</div>
                    <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                      <label>
                      <p>{{$Officer_382->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_382->workstation === $Officer_382->hostname) {
                        if ($Officer_382->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_382->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_382->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_382->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_382->secondary_workstation}}</p>
                    </label>
                    </div>
                </div>
             </div>
         </div>
        </div>
      </div>
      <!-- Panel 3 -->
    </div>
  </div>
 </div>
  <!-- End Well HR -->
  <!-- Well Finance -->
  <div class="col-sm-3" style="margin-left: 100px;">
     <div class="well well-sm" style="width: 630px;">
      <div class="well well-sm" style="background: white; height: 1250px;">
       <div class="col-sm-12">
         <div class="well well-sm" style="height: 300px;">
          <LABEL><center>Client Room</center></LABEL>
           <div class="col-sm-1" style="width: 120px; margin-top: 30px; margin-left: 200px;">            
            <div class="panel panel-default">
             <div class="panel-heading">385</div>
              <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                      <label>
                      <p>{{$Officer_385->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_385->workstation === $Officer_385->hostname) {
                        if ($Officer_385->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_385->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_385->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_385->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_385->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
           </div>
          </div>            
       </div> 
       <div class="col-sm-12" style="margin-top: 330px;">
         <div class="well well-sm" style="height: 300px;">
           <LABEL><center>Accounting & Finance Manager Room</center></LABEL>
           <div class="col-sm-1" style="width: 120px; margin-top: 30px; margin-left: 200px;">
            <div class="panel panel-default">
             <div class="panel-heading">386</div>
              <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                      <label>
                      <p>{{$Officer_386->user}}</p>
                      <p>{{$Officer_386->workstation}}</p>       
                      <p>{{$Officer_386->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
           </div>
          </div>            
       </div> 
        <div class="col-sm-12" style="margin-top: 660px;">
         <div class="well well-sm" style="height: 550px;">
           <LABEL><center>Accounting & Finance Room</center></LABEL>
           <div class="col-sm-1" style="width: 120px; margin-top: 30px; margin-left: 180px;">           
            <div class="panel panel-default">
             <div class="panel-heading">387</div>
              <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                    <label>
                      <p>{{$Officer_387->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_387->workstation === $Officer_387->hostname) {
                        if ($Officer_387->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_387->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_387->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_387->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_387->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
             <div class="panel panel-default" style="margin-top: 172px;">
             <div class="panel-heading">391</div>
              <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                    <label>
                      <p>{{$Officer_391->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_391->workstation === $Officer_391->hostname) {
                        if ($Officer_391->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_391->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_391->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_391->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_391->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
           </div>
           <div class="col-sm-1" style="width: 120px; margin-top: 30px; margin-left: 300px;"> 
           <div class="panel panel-group">         
            
             <div class="panel panel-default">
             <div class="panel-heading">388</div>
              <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                    <label>
                      <p>{{$Officer_388->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_388->workstation === $Officer_388->hostname) {
                        if ($Officer_388->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_388->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_388->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_388->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_388->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
              <div class="panel panel-default">
             <div class="panel-heading">389</div>
              <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                    <label>
                      <p>{{$Officer_389->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_389->workstation === $Officer_389->hostname) {
                        if ($Officer_389->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_389->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_389->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_389->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_389->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
             <div class="panel panel-default">
             <div class="panel-heading">390</div>
              <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                    <label>
                      <p>{{$Officer_390->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_390->workstation === $Officer_390->hostname) {
                        if ($Officer_390->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_390->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_390->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_390->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_390->secondary_workstation}}</p>
                      </label>
              </div>
             </div>            

           </div>
          </div>
          </div>            
       </div> 
      </div>
     </div>
  </div>
  <!-- End Well Finance  -->
  <!-- Production Room -->
<div class="col-sm-3" style="margin-left: 100px;">
     <div class="well well-sm" style="width: 630px;">
       <div class="well well-sm" style="background: white; height: 1050px;">
       <div class="row">
        <div class="well well-sm" style="width: 90%; margin-left: 22px; height: 220px;">
         <LABEL><center>Client Room</center></LABEL>
           <div class="col-sm-1" style="width: 120px; margin-top: 30px; margin-left: 220px;">            
            <div class="panel panel-default">
             <div class="panel-heading">392</div>
              <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                      <label>
                      <p>{{$Officer_392->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_392->workstation === $Officer_392->hostname) {
                        if ($Officer_392->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_392->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_392->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_392->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_392->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
           </div>
        </div>
       </div>
       <div class="row">
        <div class="well well-sm" style="width: 90%; margin-left: 22px; height: 220px;">
         <LABEL><center>Manager Production Room</center></LABEL>
           <div class="col-sm-1" style="width: 120px; margin-top: 30px; margin-left: 220px;">            
            <div class="panel panel-default">
             <div class="panel-heading">393</div>
              <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
                      <label>
                      <p>{{$Officer_393->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_393->workstation === $Officer_393->hostname) {
                        if ($Officer_393->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_393->workstation}}</p>       
                      <p style="margin-top: -10px;">{{$Officer_393->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
           </div>
        </div>
       </div>
       <div class="row">
        <div class="well well-sm" style="width: 90%; margin-left: 22px; height: 230px;">
         <LABEL><center>Pipeline Room</center></LABEL>
           <div class="col-sm-1" style="width: 120px; margin-top: 30px; margin-left: 220px;">            
            <div class="panel panel-default">
             <div class="panel-heading">394</div>
              <div class="panel-body text-center" style="height: 120px; font-size: 18px; ">
                      <label>
                      <p>{{$Officer_394->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_394->workstation === $Officer_394->hostname) {
                        if ($Officer_394->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_394->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_394->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_394->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_394->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
           </div>
        </div>
       </div>
        <div class="row">
        <div class="well well-sm" style="width: 90%; margin-left: 22px; height: 230px;">
         <LABEL><center>Pipeline Room</center></LABEL>
           <div class="col-sm-1" style="width: 120px; margin-top: 30px; margin-left: 220px;">            
            <div class="panel panel-default">
             <div class="panel-heading">395</div>
              <div class="panel-body text-center" style="height: 120px; font-size: 18px; ">
                      <label>
                      <p>{{$Officer_395->user}}</p>
                      <p style="text-decoration: <?php if ($Officer_395->workstation === $Officer_395->hostname) {
                        if ($Officer_395->os === 'Linux') {
                       echo "underline";
                         }         
                      }?>;">{{$Officer_395->workstation}}</p>       
                      <p style="text-decoration: <?php
                      if ($Officer_395->secondary_workstation != null) {
                         $Linux_1 = Ws_Availability::where('hostname', '=', $Officer_395->secondary_workstation)->first();
                          if ($Linux_1->os === 'Linux') {
                            echo "underline";
                          }
                      }
                      ?>;">{{$Officer_395->secondary_workstation}}</p>
                      </label>
              </div>
             </div>
           </div>
        </div>
       </div>
       </div>
      </div>
</div>
  
  <!-- End Production Room -->
</div>
<!-- end row -->
</body>
</html>
