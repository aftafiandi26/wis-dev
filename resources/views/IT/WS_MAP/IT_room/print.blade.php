<!DOCTYPE html>
<html lang="en">
<head>  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='shortcut icon' href="{{asset('assets/12.png')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
  <title>WS- Map IT Room</title>
</head>
<body>
  <div class="row">
    <div>          
       <h1 class="page-header text-center" style="margin-top: -50px;">IT Room</h1>                   
    </div>
</div>
<?php use App\Ws_Availability; ?>
<!-- star -->
<div class="container-fuild">
<div class="row">
  <!-- Well IT Staff -->
  <div class="col-sm-5">
    <div class="well well-sm" style="height: 800px;">
      <!-- Panel 1 -->
      <div class="col-sm-1" style="width: 120px;">
        <div class="panel panel-default">
          <div class="panel-heading">396</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_396->user}}</p>
              <p style="text-decoration: <?php if ($IT_396->workstation === $IT_396->hostname) {
               if ($IT_396->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_396->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_396->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_396->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_396->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">399</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_399->user}}</p>
              <p style="text-decoration: <?php if ($IT_399->workstation === $IT_399->hostname) {
               if ($IT_399->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_399->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_399->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_399->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_399->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">402</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_402->user}}</p>
              <p style="text-decoration: <?php if ($IT_402->workstation === $IT_402->hostname) {
               if ($IT_402->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_402->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_402->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_402->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_402->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default" style="margin-top: 30px;">
          <div class="panel-heading">405</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_405->user}}</p>
              <p style="text-decoration: <?php if ($IT_405->workstation === $IT_405->hostname) {
               if ($IT_405->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_405->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_405->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_405->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_405->secondary_workstation}}</p>
            </label>
          </div>
        </div>
      </div>
      <!-- End Panel 1 -->
      <!-- Panel 2 -->
      <div class="col-sm-1" style="width: 120px; margin-left: 120px;">
        <div class="panel panel-default">
          <div class="panel-heading">397</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_397->user}}</p>
              <p style="text-decoration: <?php if ($IT_397->workstation === $IT_397->hostname) {
               if ($IT_397->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_397->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_397->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_397->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_397->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">400</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_400->user}}</p>
              <p style="text-decoration: <?php if ($IT_400->workstation === $IT_400->hostname) {
               if ($IT_400->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_400->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_400->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_400->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_400->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">403</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_403->user}}</p>
              <p style="text-decoration: <?php if ($IT_403->workstation === $IT_403->hostname) {
               if ($IT_403->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_403->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_403->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_403->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_403->secondary_workstation}}</p>
            </label>
          </div>
        </div>       
      </div>
      <!-- End Panel 2 -->
      <!-- Panel 3 -->
      <div class="col-sm-1" style="width: 120px; margin-left: 240px;">
        <div class="panel panel-default">
          <div class="panel-heading">398</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_398->user}}</p>
              <p style="text-decoration: <?php if ($IT_398->workstation === $IT_398->hostname) {
               if ($IT_398->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_398->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_398->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_398->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_398->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">401</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_401->user}}</p>
              <p style="text-decoration: <?php if ($IT_401->workstation === $IT_401->hostname) {
               if ($IT_401->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_401->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_401->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_401->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_401->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">404</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_404->user}}</p>
              <p style="text-decoration: <?php if ($IT_404->workstation === $IT_404->hostname) {
               if ($IT_404->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_404->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_404->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_404->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_404->secondary_workstation}}</p>
            </label>
          </div>
        </div>            
      </div>
      <!-- End Panel 3 -->
      <!-- Panel 4 -->
      <div class="col-sm-1" style="width: 120px; margin-left: 360px;">
        <div class="panel panel-default" style="margin-top: 590px;">
          <div class="panel-heading">406</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_406->user}}</p>
              <p>Laptop Pribadi</p>
            </label>
          </div>
        </div>                      
      </div>
      <!-- End Panel 4 -->
    </div>
     <div class="well well-sm" style="height: 800px;">
    <LABEL><center>Server Room</center></LABEL>
    <hr>
    <!-- Panel 5 -->
      <div class="col-sm-1" style="width: 120px;">
        <div class="panel panel-default">
          <div class="panel-heading">407</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>DHCP</p>
              <p style="text-decoration: <?php if ($IT_407->workstation === $IT_407->hostname) {
               if ($IT_407->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_407->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_407->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_407->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_407->secondary_workstation}}</p>
            </label>
          </div>
        </div>  
          <div class="panel panel-default">
          <div class="panel-heading">411</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p> </p>
              <p style="text-decoration: <?php if ($IT_411->workstation === $IT_411->hostname) {
               if ($IT_411->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_411->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_411->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_411->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_411->secondary_workstation}}</p>
            </label>
          </div>
        </div>  
        <div class="panel panel-default">
          <div class="panel-heading">415</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_415->user}}</p>
              <p style="text-decoration: <?php if ($IT_415->workstation === $IT_415->hostname) {
               if ($IT_415->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_415->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_415->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_415->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_415->secondary_workstation}}</p>
            </label>
          </div>
        </div>                                        
      </div>
      <!-- End Panel 5 -->
      <!-- Panel 6 -->
    <div class="col-sm-1" style="width: 120px; margin-left: 120px;">
        <div class="panel panel-default">
          <div class="panel-heading">408</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>Vulcan</p>
              <p style="text-decoration: <?php if ($IT_408->workstation === $IT_408->hostname) {
               if ($IT_408->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_408->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_408->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_408->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_408->secondary_workstation}}</p>
            </label>
          </div>
        </div>  
          <div class="panel panel-default">
          <div class="panel-heading">412</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>BBF</p>
              <p style="text-decoration: <?php if ($IT_412->workstation === $IT_412->hostname) {
               if ($IT_412->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_412->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_412->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_412->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_412->secondary_workstation}}</p>
            </label>
          </div>
        </div>    
        <div class="panel panel-default">
          <div class="panel-heading">416</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>{{$IT_416->user}}</p>
              <p style="text-decoration: <?php if ($IT_416->workstation === $IT_416->hostname) {
               if ($IT_416->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_416->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_416->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_416->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_416->secondary_workstation}}</p>
            </label>
          </div>
        </div>                                        
      </div>
      <!-- End Panel 6 -->
      <!-- Panel 7 -->
    <div class="col-sm-1" style="width: 120px; margin-left: 240px;">
        <div class="panel panel-default">
          <div class="panel-heading">409</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>Proxy</p>
              <p style="text-decoration: <?php if ($IT_409->workstation === $IT_409->hostname) {
               if ($IT_409->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_409->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_409->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_409->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_409->secondary_workstation}}</p>
            </label>
          </div>
        </div>  
          <div class="panel panel-default">
          <div class="panel-heading">413</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p> </p>
              <p style="text-decoration: <?php if ($IT_413->workstation === $IT_413->hostname) {
               if ($IT_413->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_413->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_413->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_413->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_413->secondary_workstation}}</p>
            </label>
          </div>
        </div>                                        
      </div>
      <!-- End Panel 7 -->
      <!-- Panel 8 -->
    <div class="col-sm-1" style="width: 120px; margin-left: 360px;">
        <div class="panel panel-default">
          <div class="panel-heading">410</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>DMZ</p>
              <p style="text-decoration: <?php if ($IT_410->workstation === $IT_410->hostname) {
               if ($IT_410->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_410->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_410->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_410->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_410->secondary_workstation}}</p>
            </label>
          </div>
        </div>  
          <div class="panel panel-default">
          <div class="panel-heading">414</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
              <p>FTP</p>
              <p style="text-decoration: <?php if ($IT_414->workstation === $IT_414->hostname) {
               if ($IT_414->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_414->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_413->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_414->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_414->secondary_workstation}}</p>
            </label>
          </div>
        </div>                                        
      </div>
      <!-- End Panel 8 -->
   </div>
  </div>
  <!-- End Well IT Staff -->
  <!-- Well Werehouse -->
  <div class="col-sm-6">
    <div class="well well-sm" style="height: 1050px;">
      <!-- Panel 5 -->
      <div class="col-sm-1" style="width: 120px;">
        <div class="panel panel-group">
         <div class="panel panel-default">
          <div class="panel-heading">417</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_417->user}}</p>
              <p style="text-decoration: <?php if ($IT_417->workstation === $IT_417->hostname) {
               if ($IT_417->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_417->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_417->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_417->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_417->secondary_workstation}}</p>
            </label>
          </div>
        </div>       
         <div class="panel panel-default">
          <div class="panel-heading">418</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_418->user}}</p>
              <p style="text-decoration: <?php if ($IT_418->workstation === $IT_418->hostname) {
               if ($IT_418->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_418->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_418->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_418->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_418->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">419</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_419->user}}</p>
              <p style="text-decoration: <?php if ($IT_419->workstation === $IT_419->hostname) {
               if ($IT_419->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_419->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_419->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_419->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_419->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">420</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_420->user}}</p>
              <p style="text-decoration: <?php if ($IT_420->workstation === $IT_420->hostname) {
               if ($IT_420->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_420->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_420->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_420->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_420->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">421</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_421->user}}</p>
              <p style="text-decoration: <?php if ($IT_421->workstation === $IT_421->hostname) {
               if ($IT_421->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_421->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_421->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_421->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_421->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">422</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_422->user}}</p>
              <p style="text-decoration: <?php if ($IT_422->workstation === $IT_422->hostname) {
               if ($IT_422->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_422->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_422->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_422->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_422->secondary_workstation}}</p>
            </label>
          </div>
        </div>
         <!--  -->
        </div>                      
      </div>
      <!-- End Panel 5 -->
      <!-- Panel 6 -->
      <div class="col-sm-1" style="width: 120px; margin-left: 120px;">
        <div class="panel panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">423</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_423->user}}</p>
              <p style="text-decoration: <?php if ($IT_423->workstation === $IT_423->hostname) {
               if ($IT_423->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_423->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_423->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_423->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_423->secondary_workstation}}</p>
            </label>
          </div>
        </div>       
         <div class="panel panel-default">
          <div class="panel-heading">424</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_424->user}}</p>
              <p style="text-decoration: <?php if ($IT_424->workstation === $IT_424->hostname) {
               if ($IT_424->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_424->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_424->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_424->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_424->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">425</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_425->user}}</p>
              <p style="text-decoration: <?php if ($IT_425->workstation === $IT_425->hostname) {
               if ($IT_425->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_425->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_425->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_425->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_425->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">426</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_426->user}}</p>
              <p style="text-decoration: <?php if ($IT_426->workstation === $IT_426->hostname) {
               if ($IT_426->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_426->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_426->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_426->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_426->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">427</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_427->user}}</p>
              <p style="text-decoration: <?php if ($IT_427->workstation === $IT_427->hostname) {
               if ($IT_427->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_427->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_427->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_427->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_427->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">428</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_428->user}}</p>
              <p style="text-decoration: <?php if ($IT_428->workstation === $IT_428->hostname) {
               if ($IT_428->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_428->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_428->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_428->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_428->secondary_workstation}}</p>
            </label>
          </div>
        </div>
         <!--  -->
        </div>                      
      </div>
      <!-- End Panel 6 -->
      <!-- Panel 7 -->
      <div class="col-sm-1" style="width: 120px; margin-left: 240px;">
        <div class="panel panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">429</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_429->user}}</p>
              <p style="text-decoration: <?php if ($IT_429->workstation === $IT_429->hostname) {
               if ($IT_429->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_429->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_429->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_429->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_429->secondary_workstation}}</p>
            </label>
          </div>
        </div>       
         <div class="panel panel-default">
          <div class="panel-heading">430</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_430->user}}</p>
              <p style="text-decoration: <?php if ($IT_430->workstation === $IT_430->hostname) {
               if ($IT_430->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_430->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_430->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_430->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_430->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">431</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_431->user}}</p>
              <p style="text-decoration: <?php if ($IT_431->workstation === $IT_431->hostname) {
               if ($IT_431->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_431->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_431->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_431->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_431->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">432</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_432->user}}</p>
              <p style="text-decoration: <?php if ($IT_432->workstation === $IT_432->hostname) {
               if ($IT_432->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_432->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_432->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_432->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_432->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">433</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_433->user}}</p>
              <p style="text-decoration: <?php if ($IT_433->workstation === $IT_433->hostname) {
               if ($IT_433->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_433->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_433->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_433->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_433->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">434</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_434->user}}</p>
              <p style="text-decoration: <?php if ($IT_434->workstation === $IT_434->hostname) {
               if ($IT_434->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_434->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_434->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_434->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_434->secondary_workstation}}</p>
            </label>
          </div>
        </div>       
         <!--  -->
        </div>                      
      </div>
      <!-- End Panel 7 -->
      <!-- Panel 8 -->
      <div class="col-sm-1" style="width: 120px; margin-left: 360px;">
        <div class="panel panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">435</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_435->user}}</p>
              <p style="text-decoration: <?php if ($IT_435->workstation === $IT_435->hostname) {
               if ($IT_435->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_435->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_435->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_435->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_435->secondary_workstation}}</p>
            </label>
          </div>
        </div>       
         <div class="panel panel-default">
          <div class="panel-heading">436</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_436->user}}</p>
              <p style="text-decoration: <?php if ($IT_436->workstation === $IT_436->hostname) {
               if ($IT_436->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_436->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_436->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_436->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_436->secondary_workstation}}</p>
            </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">437</div>
          <div class="panel-body text-center" style="height: 100px; font-size: 18px; ">
            <label>
               <p>{{$IT_437->user}}</p>
              <p style="text-decoration: <?php if ($IT_437->workstation === $IT_437->hostname) {
               if ($IT_437->os === 'Linux') {
                  echo "underline";
                 }         
                }?>;">{{$IT_437->workstation}}</p>       
              <p style="text-decoration: <?php
               if ($IT_437->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $IT_437->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$IT_437->secondary_workstation}}</p>
            </label>
          </div>
        </div>       
         <!--  -->
        </div>                      
      </div>
      <!-- End Panel 8 -->
    </div>
  </div>
  <!-- End Well Werehouse -->
</div>
</div>
<!-- End -->
  <!-- Start Row 2 -->
<div class="container-fuild">
 <div class="row">
  <div class="col-sm-5">
  
  </div>
 </div>
</div>
  <!-- End ROW 2 -->
</body>
</html>
