<!DOCTYPE html>
<html lang="en">
<head>
  <title>WS- Map 3D Animation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
</head>
<body>
  <div class="row">
    <div>          
       <h1 class="page-header text-center">3D Animation</h1>                   
    </div>
</div>
<!--  -->
<?php use App\Ws_Availability; ?>
<div class="container-fluid">
<div class="row">
<!--  -->
<div class="col-sm-1" style="width: 120px;">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading" >1</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
      <label>
        <p>{{$anim_1->user}}</p>
        <p style="text-decoration: <?php if ($anim_1->workstation === $anim_1->hostname) {
          if ($anim_1->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_1->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_1->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_1->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_1->secondary_workstation}}</p>
      </label>
      </div>
    </div>
     <div class="panel panel-default">
      <div class="panel-heading">2</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_2->user}}</p>
        <p style="text-decoration: <?php if ($anim_2->workstation === $anim_2->hostname) {
          if ($anim_2->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_2->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_2->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_2->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_2->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">3</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_3->user}}</p>
        <p style="text-decoration: <?php if ($anim_3->workstation === $anim_3->hostname) {
          if ($anim_3->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_3->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_3->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_3->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_3->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">4</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_4->user}}</p>
        <p style="text-decoration: <?php if ($anim_4->workstation === $anim_4->hostname) {
          if ($anim_4->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_4->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_4->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_4->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_4->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">5</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_5->user}}</p>
        <p style="text-decoration: <?php if ($anim_5->workstation === $anim_5->hostname) {
          if ($anim_5->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_5->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_5->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_5->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_5->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">6</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_6->user}}</p>
        <p style="text-decoration: <?php if ($anim_6->workstation === $anim_6->hostname) {
          if ($anim_6->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_6->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_6->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_6->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_6->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
     <div class="panel panel-default">
      <div class="panel-heading">7</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_7->user}}</p>
        <p style="text-decoration: <?php if ($anim_7->workstation === $anim_7->hostname) {
          if ($anim_7->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_7->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_7->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_7->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_7->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">8</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_8->user}}</p>
        <p style="text-decoration: <?php if ($anim_8->workstation === $anim_8->hostname) {
          if ($anim_8->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_8->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_8->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_8->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_8->secondary_workstation}}</p>
      </label>
      </div>
    </div>      
  </div>
</div>
<!--  -->  
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 122px; margin-top: -1800px;">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">9</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_9->user}}</p>
        <p style="text-decoration: <?php if ($anim_9->workstation === $anim_9->hostname) {
          if ($anim_9->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_9->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_9->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_9->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_9->secondary_workstation}}</p>
      </label>
      </div>
    </div>
     <div class="panel panel-default">
      <div class="panel-heading">10</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_10->user}}</p>
        <p style="text-decoration: <?php if ($anim_10->workstation === $anim_10->hostname) {
          if ($anim_10->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_10->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_10->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_10->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_10->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">11</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_11->user}}</p>
        <p style="text-decoration: <?php if ($anim_11->workstation === $anim_11->hostname) {
          if ($anim_11->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_11->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_11->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_11->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_11->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">12</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_12->user}}</p>
        <p style="text-decoration: <?php if ($anim_12->workstation === $anim_12->hostname) {
          if ($anim_12->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_12->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_12->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_12->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_12->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">13</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_13->user}}</p>
        <p style="text-decoration: <?php if ($anim_13->workstation === $anim_13->hostname) {
          if ($anim_13->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_13->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_13->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_13->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_13->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">14</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_14->user}}</p>
        <p style="text-decoration: <?php if ($anim_14->workstation === $anim_14->hostname) {
          if ($anim_14->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_14->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_14->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_14->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_14->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
     <div class="panel panel-default">
      <div class="panel-heading">15</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_15->user}}</p>
        <p style="text-decoration: <?php if ($anim_15->workstation === $anim_15->hostname) {
          if ($anim_15->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_15->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_15->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_15->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_15->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">16</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_16->user}}</p>
        <p style="text-decoration: <?php if ($anim_16->workstation === $anim_16->hostname) {
          if ($anim_16->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_16->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_16->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_16->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_16->secondary_workstation}}</p>
      </label>
      </div>
    </div>      
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 292px; margin-top: -1800px;">
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">17</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_17->user}}</p>
        <p style="text-decoration: <?php if ($anim_17->workstation === $anim_17->hostname) {
          if ($anim_17->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_17->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_17->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_17->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_17->secondary_workstation}}</p>
      </label>
      </div>
    </div>
     <div class="panel panel-default">
      <div class="panel-heading">18</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_18->user}}</p>
        <p style="text-decoration: <?php if ($anim_18->workstation === $anim_18->hostname) {
          if ($anim_18->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_18->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_18->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_18->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_18->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">19</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_19->user}}</p>
        <p style="text-decoration: <?php if ($anim_19->workstation === $anim_19->hostname) {
          if ($anim_19->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_19->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_19->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_19->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_19->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">20</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_20->user}}</p>
        <p style="text-decoration: <?php if ($anim_20->workstation === $anim_20->hostname) {
          if ($anim_20->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_20->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_20->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_20->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_20->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">21</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; background: grey;">
      <label>
        <p>{{$anim_21->user}}</p>
        <p style="text-decoration: <?php if ($anim_21->workstation === $anim_21->hostname) {
          if ($anim_21->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_21->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_21->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_21->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_21->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">22</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_22->user}}</p>
        <p style="text-decoration: <?php if ($anim_22->workstation === $anim_22->hostname) {
          if ($anim_22->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_22->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_22->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_22->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_22->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
     <div class="panel panel-default">
      <div class="panel-heading">23</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_23->user}}</p>
        <p style="text-decoration: <?php if ($anim_23->workstation === $anim_23->hostname) {
          if ($anim_23->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_23->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_23->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_23->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_23->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">24</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_24->user}}</p>
        <p style="text-decoration: <?php if ($anim_24->workstation === $anim_24->hostname) {
          if ($anim_24->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_24->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_24->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_24->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_24->secondary_workstation}}</p>
      </label>
      </div>
    </div>      
  </div>
</div> 
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 412px; margin-top: -1800px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">25</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_25->user}}</p>
        <p style="text-decoration: <?php if ($anim_25->workstation === $anim_25->hostname) {
          if ($anim_25->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_25->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_25->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_25->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_25->secondary_workstation}}</p>
      </label>
      </div>
    </div>
     <div class="panel panel-default">
      <div class="panel-heading">26</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_26->user}}</p>
        <p style="text-decoration: <?php if ($anim_26->workstation === $anim_26->hostname) {
          if ($anim_26->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_26->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_26->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_26->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_26->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">27</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_27->user}}</p>
        <p style="text-decoration: <?php if ($anim_27->workstation === $anim_27->hostname) {
          if ($anim_27->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_27->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_27->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_27->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_27->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">28</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_28->user}}</p>
        <p style="text-decoration: <?php if ($anim_28->workstation === $anim_28->hostname) {
          if ($anim_28->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_28->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_28->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_28->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_28->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">29</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; background: grey;">
      <label>
        <p>{{$anim_29->user}}</p>
        <p style="text-decoration: <?php if ($anim_29->workstation === $anim_29->hostname) {
          if ($anim_29->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_29->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_29->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_29->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_29->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">30</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_30->user}}</p>
        <p style="text-decoration: <?php if ($anim_30->workstation === $anim_30->hostname) {
          if ($anim_30->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_30->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_30->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_30->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_30->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
     <div class="panel panel-default">
      <div class="panel-heading">31</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_31->user}}</p>
        <p style="text-decoration: <?php if ($anim_31->workstation === $anim_31->hostname) {
          if ($anim_31->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_31->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_31->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_31->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_31->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">32</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_32->user}}</p>
        <p style="text-decoration: <?php if ($anim_32->workstation === $anim_32->hostname) {
          if ($anim_32->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_32->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_32->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_32->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_32->secondary_workstation}}</p>
      </label>
      </div>
    </div>      
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 572px; margin-top: -1800px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">33</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_33->user}}</p>
        <p style="text-decoration: <?php if ($anim_33->workstation === $anim_33->hostname) {
          if ($anim_33->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_33->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_33->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_33->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_33->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">34</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_34->user}}</p>
        <p style="text-decoration: <?php if ($anim_34->workstation === $anim_34->hostname) {
          if ($anim_34->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_34->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_34->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_34->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_34->secondary_workstation}}</p>
      </label>
      </div>
    </div>
     <div class="panel panel-default">
      <div class="panel-heading">35</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_35->user}}</p>
        <p style="text-decoration: <?php if ($anim_35->workstation === $anim_35->hostname) {
          if ($anim_35->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_35->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_35->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_35->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_35->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">36</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_36->user}}</p>
        <p style="text-decoration: <?php if ($anim_36->workstation === $anim_36->hostname) {
          if ($anim_36->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_36->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_36->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_36->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_36->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">37</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_37->user}}</p>
        <p style="text-decoration: <?php if ($anim_37->workstation === $anim_37->hostname) {
          if ($anim_37->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_37->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_37->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_37->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_37->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">38</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_38->user}}</p>
        <p style="text-decoration: <?php if ($anim_38->workstation === $anim_38->hostname) {
          if ($anim_38->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_38->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_38->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_38->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_38->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">39</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_39->user}}</p>
        <p style="text-decoration: <?php if ($anim_39->workstation === $anim_39->hostname) {
          if ($anim_39->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_39->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_39->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_39->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_39->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
     <div class="panel panel-default">
      <div class="panel-heading">40</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_40->user}}</p>
        <p style="text-decoration: <?php if ($anim_40->workstation === $anim_40->hostname) {
          if ($anim_40->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_40->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_40->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_40->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_40->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 692px; margin-top: -1800px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">41</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_41->user}}</p>
        <p style="text-decoration: <?php if ($anim_41->workstation === $anim_41->hostname) {
          if ($anim_41->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_41->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_41->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_41->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_41->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">42</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_42->user}}</p>
        <p style="text-decoration: <?php if ($anim_42->workstation === $anim_42->hostname) {
          if ($anim_42->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_42->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_42->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_42->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_42->secondary_workstation}}</p>
      </label>
      </div>
    </div>
     <div class="panel panel-default">
      <div class="panel-heading">43</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_43->user}}</p>
        <p style="text-decoration: <?php if ($anim_43->workstation === $anim_43->hostname) {
          if ($anim_43->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_43->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_43->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_43->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_43->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">44</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_44->user}}</p>
        <p style="text-decoration: <?php if ($anim_44->workstation === $anim_44->hostname) {
          if ($anim_44->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_44->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_44->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_44->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_44->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">45</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_45->user}}</p>
        <p style="text-decoration: <?php if ($anim_45->workstation === $anim_45->hostname) {
          if ($anim_45->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_45->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_45->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_45->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_45->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">46</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_46->user}}</p>
        <p style="text-decoration: <?php if ($anim_46->workstation === $anim_46->hostname) {
          if ($anim_46->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_46->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_46->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_46->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_46->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">47</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_47->user}}</p>
        <p style="text-decoration: <?php if ($anim_47->workstation === $anim_47->hostname) {
          if ($anim_47->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_47->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_47->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_47->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_47->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-heading">48</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_48->user}}</p>
        <p style="text-decoration: <?php if ($anim_48->workstation === $anim_48->hostname) {
          if ($anim_48->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_48->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_48->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_48->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_48->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 852px; margin-top: -1660px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">156</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_156->user}}</p>
        <p style="text-decoration: <?php if ($anim_156->workstation === $anim_156->hostname) {
          if ($anim_156->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_156->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_156->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_156->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_156->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <!--  -->
     <div class="panel panel-default" style="margin-top: 87px;">
      <div class="panel-heading">49</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_49->user}}</p>
        <p style="text-decoration: <?php if ($anim_49->workstation === $anim_49->hostname) {
          if ($anim_49->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_49->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_49->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_49->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_49->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">50</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_50->user}}</p>
        <p style="text-decoration: <?php if ($anim_50->workstation === $anim_50->hostname) {
          if ($anim_50->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_50->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_50->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_50->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_50->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">51</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; background: grey;">
      <label>
        <p>{{$anim_51->user}}</p>
        <p style="text-decoration: <?php if ($anim_51->workstation === $anim_51->hostname) {
          if ($anim_51->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_51->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_51->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_51->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_51->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">52</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_52->user}}</p>
        <p style="text-decoration: <?php if ($anim_52->workstation === $anim_52->hostname) {
          if ($anim_52->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_52->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_52->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_52->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_52->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">53</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_53->user}}</p>
        <p style="text-decoration: <?php if ($anim_53->workstation === $anim_53->hostname) {
          if ($anim_53->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_53->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_53->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_53->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_53->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-heading">54</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_54->user}}</p>
        <p style="text-decoration: <?php if ($anim_54->workstation === $anim_54->hostname) {
          if ($anim_54->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_54->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_52->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_54->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_54->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 972px; margin-top: -1660px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">157</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_157->user}}</p>
        <p style="text-decoration: <?php if ($anim_157->workstation === $anim_157->hostname) {
          if ($anim_157->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_157->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_157->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_157->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_157->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <!--  -->
     <div class="panel panel-default" style="margin-top: 87px;">
      <div class="panel-heading">55</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_55->user}}</p>
        <p style="text-decoration: <?php if ($anim_55->workstation === $anim_55->hostname) {
          if ($anim_55->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_55->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_55->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_55->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_55->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">56</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_56->user}}</p>
        <p style="text-decoration: <?php if ($anim_56->workstation === $anim_56->hostname) {
          if ($anim_56->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_56->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_56->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_56->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_56->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">57</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; background: grey;">
      <label>
        <p>{{$anim_57->user}}</p>
        <p style="text-decoration: <?php if ($anim_57->workstation === $anim_57->hostname) {
          if ($anim_57->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_57->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_57->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_57->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_57->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">58</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_58->user}}</p>
        <p style="text-decoration: <?php if ($anim_58->workstation === $anim_58->hostname) {
          if ($anim_58->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_58->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_58->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_58->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_58->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">59</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_59->user}}</p>
        <p style="text-decoration: <?php if ($anim_59->workstation === $anim_59->hostname) {
          if ($anim_59->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_59->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_59->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_59->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_59->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-heading">60</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_60->user}}</p>
        <p style="text-decoration: <?php if ($anim_60->workstation === $anim_60->hostname) {
          if ($anim_60->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_60->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_60->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_60->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_60->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 1132px; margin-top: -1660px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">158</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_158->user}}</p>
        <p style="text-decoration: <?php if ($anim_158->workstation === $anim_158->hostname) {
          if ($anim_158->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_158->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_158->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_158->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_158->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <!--  -->
     <div class="panel panel-default" style="margin-top: 87px;">
      <div class="panel-heading">61</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_61->user}}</p>
        <p style="text-decoration: <?php if ($anim_61->workstation === $anim_61->hostname) {
          if ($anim_61->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_61->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_61->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_61->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_61->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">62</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_62->user}}</p>
        <p style="text-decoration: <?php if ($anim_62->workstation === $anim_62->hostname) {
          if ($anim_62->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_62->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_62->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_62->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_62->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">63</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_63->user}}</p>
        <p style="text-decoration: <?php if ($anim_63->workstation === $anim_63->hostname) {
          if ($anim_63->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_63->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_63->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_63->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_63->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">64</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_64->user}}</p>
        <p style="text-decoration: <?php if ($anim_64->workstation === $anim_64->hostname) {
          if ($anim_64->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_64->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_64->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_64->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_64->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">65</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_65->user}}</p>
        <p style="text-decoration: <?php if ($anim_65->workstation === $anim_65->hostname) {
          if ($anim_65->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_65->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_65->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_65->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_65->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-heading">66</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_66->user}}</p>
        <p style="text-decoration: <?php if ($anim_66->workstation === $anim_66->hostname) {
          if ($anim_66->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_66->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_66->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_66->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_66->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 1252px; margin-top: -1660px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">159</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_159->user}}</p>
        <p style="text-decoration: <?php if ($anim_159->workstation === $anim_159->hostname) {
          if ($anim_159->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_159->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_159->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_159->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_159->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <!--  -->
     <div class="panel panel-default" style="margin-top: 87px;">
      <div class="panel-heading">67</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_67->user}}</p>
        <p style="text-decoration: <?php if ($anim_67->workstation === $anim_67->hostname) {
          if ($anim_67->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_67->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_67->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_67->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_67->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">68</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_68->user}}</p>
        <p style="text-decoration: <?php if ($anim_68->workstation === $anim_68->hostname) {
          if ($anim_68->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_68->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_68->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_68->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_68->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">69</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_69->user}}</p>
        <p style="text-decoration: <?php if ($anim_69->workstation === $anim_69->hostname) {
          if ($anim_69->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_69->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_69->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_69->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_69->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">70</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_70->user}}</p>
        <p style="text-decoration: <?php if ($anim_70->workstation === $anim_70->hostname) {
          if ($anim_70->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_70->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_70->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_70->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_70->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">71</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_71->user}}</p>
        <p style="text-decoration: <?php if ($anim_71->workstation === $anim_71->hostname) {
          if ($anim_71->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_71->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_71->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_71->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_71->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-heading">72</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_72->user}}</p>
        <p style="text-decoration: <?php if ($anim_72->workstation === $anim_72->hostname) {
          if ($anim_72->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_72->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_72->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_72->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_72->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
<!--  -->
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 1412px; margin-top: -1575px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">73</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_73->user}}</p>
        <p style="text-decoration: <?php if ($anim_73->workstation === $anim_73->hostname) {
          if ($anim_73->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_73->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_73->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_73->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_73->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">74</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_74->user}}</p>
        <p style="text-decoration: <?php if ($anim_74->workstation === $anim_74->hostname) {
          if ($anim_74->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_74->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_74->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_74->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_74->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">75</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_75->user}}</p>
        <p style="text-decoration: <?php if ($anim_75->workstation === $anim_75->hostname) {
          if ($anim_75->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_75->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_75->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_75->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_75->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">76</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; background: grey;">
      <label>
        <p>{{$anim_76->user}}</p>
        <p style="text-decoration: <?php if ($anim_76->workstation === $anim_76->hostname) {
          if ($anim_76->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_76->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_76->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_76->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_76->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">77</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_77->user}}</p>
        <p style="text-decoration: <?php if ($anim_77->workstation === $anim_77->hostname) {
          if ($anim_77->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_77->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_77->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_77->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_77->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">78</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_78->user}}</p>
        <p style="text-decoration: <?php if ($anim_78->workstation === $anim_78->hostname) {
          if ($anim_78->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_78->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_78->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_78->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_78->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-heading">79</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_79->user}}</p>
        <p style="text-decoration: <?php if ($anim_79->workstation === $anim_79->hostname) {
          if ($anim_79->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_79->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_79->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_79->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_79->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 1532px; margin-top: -1575px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">80</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_80->user}}</p>
        <p style="text-decoration: <?php if ($anim_80->workstation === $anim_80->hostname) {
          if ($anim_80->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_80->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_80->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_80->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_80->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">81</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_81->user}}</p>
        <p style="text-decoration: <?php if ($anim_81->workstation === $anim_81->hostname) {
          if ($anim_81->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_81->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_81->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_81->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_81->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">82</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_82->user}}</p>
        <p style="text-decoration: <?php if ($anim_82->workstation === $anim_82->hostname) {
          if ($anim_82->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_82->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_82->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_82->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_82->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">83</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_83->user}}</p>
        <p style="text-decoration: <?php if ($anim_83->workstation === $anim_83->hostname) {
          if ($anim_83->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_83->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_83->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_83->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_83->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">84</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_84->user}}</p>
        <p style="text-decoration: <?php if ($anim_84->workstation === $anim_84->hostname) {
          if ($anim_84->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_84->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_84->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_84->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_84->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">85</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_85->user}}</p>
        <p style="text-decoration: <?php if ($anim_85->workstation === $anim_85->hostname) {
          if ($anim_85->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_85->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_85->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_85->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_85->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-heading">86</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_86->user}}</p>
        <p style="text-decoration: <?php if ($anim_86->workstation === $anim_86->hostname) {
          if ($anim_86->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_86->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_86->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_86->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_86->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 1692px; margin-top: -1575px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">87</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_87->user}}</p>
        <p style="text-decoration: <?php if ($anim_87->workstation === $anim_87->hostname) {
          if ($anim_87->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_87->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_87->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_87->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_87->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">88</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_88->user}}</p>
        <p style="text-decoration: <?php if ($anim_88->workstation === $anim_88->hostname) {
          if ($anim_88->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_88->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_88->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_88->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_88->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">89</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_89->user}}</p>
        <p style="text-decoration: <?php if ($anim_89->workstation === $anim_89->hostname) {
          if ($anim_89->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_89->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_89->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_89->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_89->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">90</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_90->user}}</p>
        <p style="text-decoration: <?php if ($anim_90->workstation === $anim_90->hostname) {
          if ($anim_90->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_90->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_90->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_90->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_90->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">91</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_91->user}}</p>
        <p style="text-decoration: <?php if ($anim_91->workstation === $anim_91->hostname) {
          if ($anim_91->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_91->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_91->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_91->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_91->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">92</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_92->user}}</p>
        <p style="text-decoration: <?php if ($anim_92->workstation === $anim_92->hostname) {
          if ($anim_92->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_92->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_92->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_92->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_92->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-heading">93</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_93->user}}</p>
        <p style="text-decoration: <?php if ($anim_93->workstation === $anim_93->hostname) {
          if ($anim_93->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_93->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_93->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_93->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_93->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 1812px; margin-top: -1575px;">
    <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">94</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_94->user}}</p>
        <p style="text-decoration: <?php if ($anim_94->workstation === $anim_94->hostname) {
          if ($anim_94->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_94->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_94->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_94->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_94->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">95</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_95->user}}</p>
        <p style="text-decoration: <?php if ($anim_95->workstation === $anim_95->hostname) {
          if ($anim_95->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_95->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_95->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_95->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_95->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
    <div class="panel panel-default">
      <div class="panel-heading">96</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_96->user}}</p>
        <p style="text-decoration: <?php if ($anim_96->workstation === $anim_96->hostname) {
          if ($anim_96->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_96->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_96->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_96->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_96->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">97</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_97->user}}</p>
        <p style="text-decoration: <?php if ($anim_97->workstation === $anim_97->hostname) {
          if ($anim_97->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_97->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_97->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_97->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_97->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">98</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_98->user}}</p>
        <p style="text-decoration: <?php if ($anim_98->workstation === $anim_98->hostname) {
          if ($anim_98->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_98->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_98->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_98->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_98->secondary_workstation}}</p>
      </label>
      </div>
    </div> 
     <div class="panel panel-default">
      <div class="panel-heading">99</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_99->user}}</p>
        <p style="text-decoration: <?php if ($anim_99->workstation === $anim_99->hostname) {
          if ($anim_99->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_99->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_99->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_99->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_99->secondary_workstation}}</p>
      </label>
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-heading">100</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_100->user}}</p>
        <p style="text-decoration: <?php if ($anim_100->workstation === $anim_100->hostname) {
          if ($anim_100->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_100->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_100->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_100->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_100->secondary_workstation}}</p>
      </label>
      </div>
    </div>           
  </div>
</div>
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 1962px; margin-top: -1800px;">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">101</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_101->user}}</p>
        <p style="text-decoration: <?php if ($anim_101->workstation === $anim_101->hostname) {
          if ($anim_101->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_101->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_101->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_101->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_101->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">102</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_102->user}}</p>
        <p style="text-decoration: <?php if ($anim_102->workstation === $anim_102->hostname) {
          if ($anim_102->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_102->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_102->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_102->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_102->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">103</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_103->user}}</p>
        <p style="text-decoration: <?php if ($anim_103->workstation === $anim_103->hostname) {
          if ($anim_103->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_103->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_103->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_103->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_103->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">104</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_104->user}}</p>
        <p style="text-decoration: <?php if ($anim_104->workstation === $anim_104->hostname) {
          if ($anim_104->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_104->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_104->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_104->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_104->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">105</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; background: grey;">
      <label>
        <p>{{$anim_105->user}}</p>
        <p style="text-decoration: <?php if ($anim_105->workstation === $anim_105->hostname) {
          if ($anim_105->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_105->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_105->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_105->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_105->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">106</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_106->user}}</p>
        <p style="text-decoration: <?php if ($anim_106->workstation === $anim_106->hostname) {
          if ($anim_106->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_106->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_106->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_106->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_106->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">107</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_107->user}}</p>
        <p style="text-decoration: <?php if ($anim_107->workstation === $anim_107->hostname) {
          if ($anim_107->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_107->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_107->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_107->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_107->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">108</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_108->user}}</p>
        <p style="text-decoration: <?php if ($anim_108->workstation === $anim_108->hostname) {
          if ($anim_108->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_108->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_108->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_108->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_108->secondary_workstation}}</p>
      </label>
      </div>
    </div>
  </div>  
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 2082px; margin-top: -1800px;">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">109</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_109->user}}</p>
        <p style="text-decoration: <?php if ($anim_109->workstation === $anim_109->hostname) {
          if ($anim_109->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_109->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_109->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_109->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_109->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">110</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_110->user}}</p>
        <p style="text-decoration: <?php if ($anim_110->workstation === $anim_110->hostname) {
          if ($anim_110->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_110->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_110->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_110->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_110->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">111</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_111->user}}</p>
        <p style="text-decoration: <?php if ($anim_111->workstation === $anim_111->hostname) {
          if ($anim_111->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_111->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_111->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_111->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_111->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">112</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_112->user}}</p>
        <p style="text-decoration: <?php if ($anim_112->workstation === $anim_112->hostname) {
          if ($anim_112->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_112->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_112->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_112->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_112->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">113</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; background: grey;">
      <label>
        <p>{{$anim_113->user}}</p>
        <p style="text-decoration: <?php if ($anim_113->workstation === $anim_113->hostname) {
          if ($anim_113->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_113->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_113->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_113->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_113->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">114</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_114->user}}</p>
        <p style="text-decoration: <?php if ($anim_114->workstation === $anim_114->hostname) {
          if ($anim_114->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_114->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_114->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_114->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_114->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">115</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_115->user}}</p>
        <p style="text-decoration: <?php if ($anim_115->workstation === $anim_115->hostname) {
          if ($anim_115->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_115->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_115->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_115->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_115->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">116</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_116->user}}</p>
        <p style="text-decoration: <?php if ($anim_116->workstation === $anim_116->hostname) {
          if ($anim_116->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_116->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_116->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_116->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_116->secondary_workstation}}</p>
      </label>
      </div>
    </div>
  </div>  
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 2242px; margin-top: -1800px;">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">117</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_117->user}}</p>
        <p style="text-decoration: <?php if ($anim_117->workstation === $anim_117->hostname) {
          if ($anim_117->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_117->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_117->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_117->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_117->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">118</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_118->user}}</p>
        <p style="text-decoration: <?php if ($anim_118->workstation === $anim_118->hostname) {
          if ($anim_118->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_118->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_118->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_118->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_118->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">119</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_119->user}}</p>
        <p style="text-decoration: <?php if ($anim_119->workstation === $anim_119->hostname) {
          if ($anim_119->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_119->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_119->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_119->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_119->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">120</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_120->user}}</p>
        <p style="text-decoration: <?php if ($anim_120->workstation === $anim_120->hostname) {
          if ($anim_120->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_120->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_120->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_120->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_120->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">121</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_121->user}}</p>
        <p style="text-decoration: <?php if ($anim_121->workstation === $anim_121->hostname) {
          if ($anim_121->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_121->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_121->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_121->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_121->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">122</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_122->user}}</p>
        <p style="text-decoration: <?php if ($anim_122->workstation === $anim_122->hostname) {
          if ($anim_122->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_122->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_122->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_122->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_122->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">123</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_123->user}}</p>
        <p style="text-decoration: <?php if ($anim_123->workstation === $anim_123->hostname) {
          if ($anim_123->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_123->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_123->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_123->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_123->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">124</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_124->user}}</p>
        <p style="text-decoration: <?php if ($anim_124->workstation === $anim_124->hostname) {
          if ($anim_124->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_124->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_124->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_124->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_124->secondary_workstation}}</p>
      </label>
      </div>
    </div>
  </div>  
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 2362px; margin-top: -1800px;">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">125</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_125->user}}</p>
        <p style="text-decoration: <?php if ($anim_125->workstation === $anim_125->hostname) {
          if ($anim_125->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_125->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_125->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_125->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_125->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">126</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_126->user}}</p>
        <p style="text-decoration: <?php if ($anim_126->workstation === $anim_126->hostname) {
          if ($anim_126->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_126->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_126->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_126->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_126->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">127</div>
      <div class="panel-body text-127" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_127->user}}</p>
        <p style="text-decoration: <?php if ($anim_127->workstation === $anim_127->hostname) {
          if ($anim_127->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_127->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_127->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_127->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_127->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">128</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_128->user}}</p>
        <p style="text-decoration: <?php if ($anim_128->workstation === $anim_128->hostname) {
          if ($anim_128->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_128->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_128->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_128->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_128->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">129</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_129->user}}</p>
        <p style="text-decoration: <?php if ($anim_129->workstation === $anim_129->hostname) {
          if ($anim_129->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_129->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_129->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_129->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_129->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">130</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_130->user}}</p>
        <p style="text-decoration: <?php if ($anim_130->workstation === $anim_130->hostname) {
          if ($anim_130->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_130->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_130->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_130->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_130->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">131</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_131->user}}</p>
        <p style="text-decoration: <?php if ($anim_131->workstation === $anim_131->hostname) {
          if ($anim_131->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_131->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_131->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_131->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_131->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">132</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_132->user}}</p>
        <p style="text-decoration: <?php if ($anim_132->workstation === $anim_132->hostname) {
          if ($anim_132->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_132->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_132->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_132->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_132->secondary_workstation}}</p>
      </label>
      </div>
    </div>
  </div>  
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 2522px; margin-top: -1800px;">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">133</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_133->user}}</p>
        <p style="text-decoration: <?php if ($anim_133->workstation === $anim_133->hostname) {
          if ($anim_133->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_133->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_133->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_133->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_133->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">134</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_134->user}}</p>
        <p style="text-decoration: <?php if ($anim_134->workstation === $anim_134->hostname) {
          if ($anim_134->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_134->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_134->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_134->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_134->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">135</div>
      <div class="panel-body text-127" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_135->user}}</p>
        <p style="text-decoration: <?php if ($anim_135->workstation === $anim_135->hostname) {
          if ($anim_135->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_135->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_135->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_135->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_135->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">136</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_136->user}}</p>
        <p style="text-decoration: <?php if ($anim_136->workstation === $anim_136->hostname) {
          if ($anim_136->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_136->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_136->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_136->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_136->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">137</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; background: grey;">
      <label>
        <p>{{$anim_137->user}}</p>
        <p style="text-decoration: <?php if ($anim_137->workstation === $anim_137->hostname) {
          if ($anim_137->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_137->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_137->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_137->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_137->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">138</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_138->user}}</p>
        <p style="text-decoration: <?php if ($anim_138->workstation === $anim_138->hostname) {
          if ($anim_138->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_138->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_138->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_138->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_138->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">139</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_139->user}}</p>
        <p style="text-decoration: <?php if ($anim_139->workstation === $anim_139->hostname) {
          if ($anim_139->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_139->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_139->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_139->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_139->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">140</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_140->user}}</p>
        <p style="text-decoration: <?php if ($anim_140->workstation === $anim_140->hostname) {
          if ($anim_140->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_140->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_140->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_140->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_140->secondary_workstation}}</p>
      </label>
      </div>
    </div>
  </div>  
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 2642px; margin-top: -1800px;">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">141</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_141->user}}</p>
        <p style="text-decoration: <?php if ($anim_141->workstation === $anim_141->hostname) {
          if ($anim_141->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_141->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_141->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_141->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_141->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">142</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_142->user}}</p>
        <p style="text-decoration: <?php if ($anim_142->workstation === $anim_142->hostname) {
          if ($anim_142->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_142->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_142->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_142->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_142->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">143</div>
      <div class="panel-body text-127" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_143->user}}</p>
        <p style="text-decoration: <?php if ($anim_143->workstation === $anim_143->hostname) {
          if ($anim_143->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_143->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_143->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_143->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_143->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">144</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_144->user}}</p>
        <p style="text-decoration: <?php if ($anim_144->workstation === $anim_144->hostname) {
          if ($anim_144->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_144->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_144->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_144->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_144->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">145</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px; background: grey;">
      <label>
        <p>{{$anim_145->user}}</p>
        <p style="text-decoration: <?php if ($anim_145->workstation === $anim_145->hostname) {
          if ($anim_145->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_145->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_145->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_145->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_145->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">146</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_146->user}}</p>
        <p style="text-decoration: <?php if ($anim_146->workstation === $anim_146->hostname) {
          if ($anim_146->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_146->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_146->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_146->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_146->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">147</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_147->user}}</p>
        <p style="text-decoration: <?php if ($anim_147->workstation === $anim_147->hostname) {
          if ($anim_147->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_147->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_147->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_147->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_147->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">148</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_148->user}}</p>
        <p style="text-decoration: <?php if ($anim_148->workstation === $anim_148->hostname) {
          if ($anim_148->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_148->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_148->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_148->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_148->secondary_workstation}}</p>
      </label>
      </div>
    </div>    
  </div>  
</div>
<!--  -->
<div class="col-sm-1" style="width: 120px; margin-left: 2802px; margin-top: -1650px;">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">149</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_149->user}}</p>
        <p style="text-decoration: <?php if ($anim_149->workstation === $anim_149->hostname) {
          if ($anim_149->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_149->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_149->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_149->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_149->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">150</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_150->user}}</p>
        <p style="text-decoration: <?php if ($anim_150->workstation === $anim_150->hostname) {
          if ($anim_150->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_150->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_150->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_150->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_150->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">151</div>
      <div class="panel-body text-127" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_151->user}}</p>
        <p style="text-decoration: <?php if ($anim_151->workstation === $anim_151->hostname) {
          if ($anim_151->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_151->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_151->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_151->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_151->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">152</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_152->user}}</p>
        <p style="text-decoration: <?php if ($anim_152->workstation === $anim_152->hostname) {
          if ($anim_152->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_152->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_152->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_152->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_152->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">153</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_153->user}}</p>
        <p style="text-decoration: <?php if ($anim_153->workstation === $anim_153->hostname) {
          if ($anim_153->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_153->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_153->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_153->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_153->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">154</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_154->user}}</p>
        <p style="text-decoration: <?php if ($anim_154->workstation === $anim_154->hostname) {
          if ($anim_154->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_154->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_154->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_154->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_154->secondary_workstation}}</p>
      </label>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">155</div>
      <div class="panel-body text-center" style="height: 150px; font-size: 18px;">
      <label>
        <p>{{$anim_155->user}}</p>
        <p style="text-decoration: <?php if ($anim_155->workstation === $anim_155->hostname) {
          if ($anim_155->os === 'Linux') {
         echo "underline";
           }         
        }?>;">{{$anim_155->workstation}}</p>       
        <p style="text-decoration: <?php
        if ($anim_154->secondary_workstation != null) {
           $Linux_1 = Ws_Availability::where('hostname', '=', $anim_155->secondary_workstation)->first();
            if ($Linux_1->os === 'Linux') {
              echo "underline";
            }
        }
        ?>;">{{$anim_155->secondary_workstation}}</p>
      </label>
      </div>
    </div>       
  </div>  
</div>
</div>
<!--  -->
</div>
</div>
</body>
</html>
