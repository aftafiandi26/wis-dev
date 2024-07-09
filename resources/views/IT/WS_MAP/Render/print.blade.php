<!DOCTYPE html>
<html lang="en">
<head>  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='shortcut icon' href="{{asset('assets/12.png')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
  <title>WS- Map Render</title>
</head>
<body>
  <div class="row">
    <div>          
       <h1 class="page-header text-center" style="margin-top: -100px;">Render</h1>                   
    </div>
</div>
<!-- Start -->
<?php use App\Ws_Availability; ?>
<div class="row">
 <!-- Well 1 -->
  <div class="well" style="width: 570px; height: 1700px; margin-left: 0px;">
  <!-- panel 1 -->   
  <div class="col-sm-1" style="width: 120px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">254</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_254->user}}</p>
            <p style="text-decoration: <?php if ($Render_254->workstation === $Render_254->hostname) {
              if ($Render_254->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_254->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_254->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_254->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_254->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">258</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_258->user}}</p>
            <p style="text-decoration: <?php if ($Render_258->workstation === $Render_258->hostname) {
              if ($Render_258->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_258->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_258->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_258->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_258->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">262</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_262->user}}</p>
            <p style="text-decoration: <?php if ($Render_262->workstation === $Render_262->hostname) {
              if ($Render_262->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_262->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_262->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_262->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_262->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">266</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_266->user}}</p>
            <p style="text-decoration: <?php if ($Render_266->workstation === $Render_266->hostname) {
              if ($Render_266->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_266->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_266->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_266->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_266->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">270</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_270->user}}</p>
            <p style="text-decoration: <?php if ($Render_270->workstation === $Render_270->hostname) {
              if ($Render_270->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_270->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_270->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_270->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_270->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">274</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_274->user}}</p>
            <p style="text-decoration: <?php if ($Render_274->workstation === $Render_274->hostname) {
              if ($Render_274->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_274->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_274->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_274->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_274->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">278</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_278->user}}</p>
            <p style="text-decoration: <?php if ($Render_278->workstation === $Render_278->hostname) {
              if ($Render_278->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_278->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_278->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_278->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_278->secondary_workstation}}</p>
          </label>
          </div>
      </div>    
    </div>  
  </div>
  <!-- panel 1 -->
  <!-- panel 2 -->   
  <div class="col-sm-1" style="width: 120px; margin-left: -30px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">255</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_255->user}}</p>
            <p style="text-decoration: <?php if ($Render_255->workstation === $Render_255->hostname) {
              if ($Render_255->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_255->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_255->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_255->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_255->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">259</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_259->user}}</p>
            <p style="text-decoration: <?php if ($Render_259->workstation === $Render_259->hostname) {
              if ($Render_259->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_259->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_259->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_259->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_259->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">263</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_263->user}}</p>
            <p style="text-decoration: <?php if ($Render_263->workstation === $Render_263->hostname) {
              if ($Render_263->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_263->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_263->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_263->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_263->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">267</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_267->user}}</p>
            <p style="text-decoration: <?php if ($Render_267->workstation === $Render_267->hostname) {
              if ($Render_267->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_267->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_267->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_267->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_267->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">271</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_271->user}}</p>
            <p style="text-decoration: <?php if ($Render_271->workstation === $Render_271->hostname) {
              if ($Render_271->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_271->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_271->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_271->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_271->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">275</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_275->user}}</p>
            <p style="text-decoration: <?php if ($Render_275->workstation === $Render_275->hostname) {
              if ($Render_275->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_275->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_275->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_275->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_275->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">279</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_279->user}}</p>
            <p style="text-decoration: <?php if ($Render_279->workstation === $Render_279->hostname) {
              if ($Render_279->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_279->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_279->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_279->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_279->secondary_workstation}}</p>
          </label>
          </div>
      </div>    
    </div>  
  </div>
  <!-- panel 2 -->
  <!-- panel 3 -->   
  <div class="col-sm-1" style="width: 120px; margin-left: 30px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">256</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_256->user}}</p>
            <p style="text-decoration: <?php if ($Render_256->workstation === $Render_256->hostname) {
              if ($Render_256->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_256->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_256->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_256->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_256->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">260</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_260->user}}</p>
            <p style="text-decoration: <?php if ($Render_260->workstation === $Render_260->hostname) {
              if ($Render_260->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_260->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_260->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_260->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_260->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">264</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_264->user}}</p>
            <p style="text-decoration: <?php if ($Render_264->workstation === $Render_264->hostname) {
              if ($Render_264->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_264->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_264->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_264->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_264->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">268</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_268->user}}</p>
            <p style="text-decoration: <?php if ($Render_268->workstation === $Render_268->hostname) {
              if ($Render_268->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_268->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_268->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_268->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_268->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">272</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_272->user}}</p>
            <p style="text-decoration: <?php if ($Render_272->workstation === $Render_272->hostname) {
              if ($Render_272->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_272->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_272->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_272->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_272->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">276</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_276->user}}</p>
            <p style="text-decoration: <?php if ($Render_276->workstation === $Render_276->hostname) {
              if ($Render_276->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_276->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_276->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_276->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_276->secondary_workstation}}</p>
          </label>
          </div>
      </div>    
    </div>  
  </div>
  <!-- panel 3 -->
  <!-- panel 4 -->   
  <div class="col-sm-1" style="width: 120px; margin-left: -30px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">257</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_257->user}}</p>
            <p style="text-decoration: <?php if ($Render_257->workstation === $Render_257->hostname) {
              if ($Render_257->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_257->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_257->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_257->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_257->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">261</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_261->user}}</p>
            <p style="text-decoration: <?php if ($Render_261->workstation === $Render_261->hostname) {
              if ($Render_261->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_261->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_261->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_261->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_261->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">265</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_265->user}}</p>
            <p style="text-decoration: <?php if ($Render_265->workstation === $Render_265->hostname) {
              if ($Render_265->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_265->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_265->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_265->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_265->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">269</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_269->user}}</p>
            <p style="text-decoration: <?php if ($Render_269->workstation === $Render_269->hostname) {
              if ($Render_269->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_269->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_269->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_269->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_269->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>
    <div class="panel panel-group" style="margin-top: 40px;">
      <div class="panel panel-default">
          <div class="panel-heading">273</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_273->user}}</p>
            <p style="text-decoration: <?php if ($Render_273->workstation === $Render_273->hostname) {
              if ($Render_273->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_273->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_273->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_273->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_273->secondary_workstation}}</p>
          </label>
          </div>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">277</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_277->user}}</p>
            <p style="text-decoration: <?php if ($Render_277->workstation === $Render_277->hostname) {
              if ($Render_277->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_277->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_277->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_277->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_277->secondary_workstation}}</p>
          </label>
          </div>
      </div>
    </div>    
    </div>  
  </div>
  <!-- panel 4 -->
  </div>
 <!-- well 1 -->
 <!-- well 2 -->
  <div class="well" style="width: 570px; height: 1700px; margin-left: 600px; margin-top: -2000px;">
    <!-- light 1 -->
    <div class="col-sm-1" style="width: 120px;">
        <div class="panel panel-default">
              <div class="panel-heading">347</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_347->workstation === $Render_347->hostname) {
                  if ($Render_347->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_347->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">350</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_350->workstation === $Render_350->hostname) {
                  if ($Render_350->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_350->workstation}}</p>
              </label>
              </div>    
        </div>
         <div class="panel panel-default">
              <div class="panel-heading">353</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_353->workstation === $Render_353->hostname) {
                  if ($Render_353->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_353->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">356</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_356->workstation === $Render_356->hostname) {
                  if ($Render_356->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_356->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">359</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_359->workstation === $Render_359->hostname) {
                  if ($Render_359->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_359->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">362</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_362->workstation === $Render_362->hostname) {
                  if ($Render_362->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_362->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">365</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_365->workstation === $Render_365->hostname) {
                  if ($Render_365->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_365->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">368</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_368->workstation === $Render_368->hostname) {
                  if ($Render_368->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_368->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">371</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_371->workstation === $Render_371->hostname) {
                  if ($Render_371->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_371->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">374</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_374->workstation === $Render_374->hostname) {
                  if ($Render_374->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_374->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">377</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_377->workstation === $Render_377->hostname) {
                  if ($Render_377->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_377->workstation}}</p>
              </label>
              </div>    
        </div>
    </div>
    <!-- light 1 -->
    <!-- light 2 -->
    <div class="col-sm-1" style="width: 120px;">
        <div class="panel panel-default">
              <div class="panel-heading">348</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_348->workstation === $Render_348->hostname) {
                  if ($Render_348->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_348->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">351</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_351->workstation === $Render_351->hostname) {
                  if ($Render_351->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_351->workstation}}</p>
              </label>
              </div>    
        </div>
         <div class="panel panel-default">
              <div class="panel-heading">354</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_354->workstation === $Render_354->hostname) {
                  if ($Render_354->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_354->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">357</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_357->workstation === $Render_357->hostname) {
                  if ($Render_357->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_357->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">360</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_360->workstation === $Render_360->hostname) {
                  if ($Render_360->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_359->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">363</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_363->workstation === $Render_363->hostname) {
                  if ($Render_363->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_363->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">366</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_366->workstation === $Render_366->hostname) {
                  if ($Render_366->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_366->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">369</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_369->workstation === $Render_369->hostname) {
                  if ($Render_369->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_369->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">372</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_372->workstation === $Render_372->hostname) {
                  if ($Render_372->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_372->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">375</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_375->workstation === $Render_375->hostname) {
                  if ($Render_375->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_375->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">378</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_378->workstation === $Render_378->hostname) {
                  if ($Render_378->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_378->workstation}}</p>
              </label>
              </div>    
        </div>
    </div>
    <!-- light 2 -->
    <!-- light 3 -->
    <div class="col-sm-1" style="width: 120px;">
        <div class="panel panel-default">
              <div class="panel-heading">349</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_349->workstation === $Render_349->hostname) {
                  if ($Render_349->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_349->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">352</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_352->workstation === $Render_352->hostname) {
                  if ($Render_352->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_352->workstation}}</p>
              </label>
              </div>    
        </div>
         <div class="panel panel-default">
              <div class="panel-heading">355</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_355->workstation === $Render_355->hostname) {
                  if ($Render_355->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_355->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">358</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_358->workstation === $Render_358->hostname) {
                  if ($Render_358->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_358->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">361</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_361->workstation === $Render_361->hostname) {
                  if ($Render_361->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_361->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">364</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_364->workstation === $Render_364->hostname) {
                  if ($Render_364->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_364->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">367</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_367->workstation === $Render_367->hostname) {
                  if ($Render_367->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_367->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">370</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_370->workstation === $Render_370->hostname) {
                  if ($Render_370->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_370->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">373</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_373->workstation === $Render_373->hostname) {
                  if ($Render_373->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_373->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">376</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_376->workstation === $Render_376->hostname) {
                  if ($Render_376->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_376->workstation}}</p>
              </label>
              </div>    
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">379</div>
              <div class="panel-body text-center" style="font-size: 18px; height: 50px;">
                <label>            
                <p style="text-decoration: <?php if ($Render_379->workstation === $Render_379->hostname) {
                  if ($Render_379->os === 'Linux') {
                 echo "underline";
                   }         
                }?>;">{{$Render_379->workstation}}</p>
              </label>
              </div>    
        </div>
    </div>
    <!-- light 3 -->
  </div>
 <!-- well 2 -->
  <!-- well 3 -->
  <div class="well" style="width: 570px; height: 1700px; margin-left: 1215px; margin-top: -2000px;">
      <div class="col-sm-1" style="width: 120px; margin-top: 1400px; margin-left: 226px;">
        <div class="panel panel-group">
          <div class="panel panel-default">
          <div class="panel-heading">343</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_343->user}}</p>
            <p style="text-decoration: <?php if ($Render_343->workstation === $Render_343->hostname) {
              if ($Render_343->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_343->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_343->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_343->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_343->secondary_workstation}}</p>
          </label>
          </div>    
        </div>
      </div>  
      </div>
  </div>
 <!-- well 3 -->
</div>
<!-- row 2 -->
<!-- Start 2-->
<div class="row" style="margin-top: 50px;">
 <!-- Well 1 -->
  <div class="well" style="width: 200px; height: 1350px; margin-left: 0px;">
  <!-- panel 1 -->   
  <div class="col-sm-1" style="width: 120px; margin-top: 100px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">344</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_344->user}}</p>
            <p style="text-decoration: <?php if ($Render_344->workstation === $Render_344->hostname) {
              if ($Render_344->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_344->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_344->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_344->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_344->secondary_workstation}}</p>
          </label>
          </div>    
        </div>
    </div>  
    <div class="panel panel-group" style="margin-top: 400px;">
      <div class="panel panel-default">
          <div class="panel-heading">345</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_345->user}}</p>
            <p style="text-decoration: <?php if ($Render_345->workstation === $Render_345->hostname) {
              if ($Render_345->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_345->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_345->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_345->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_345->secondary_workstation}}</p>
          </label>
          </div>    
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">346</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_346->user}}</p>
            <p style="text-decoration: <?php if ($Render_346->workstation === $Render_346->hostname) {
              if ($Render_346->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_346->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_346->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_346->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_346->secondary_workstation}}</p>
          </label>
          </div>    
        </div>
    </div> 
  </div>
  <!-- panel 1 -->
  </div>
 <!-- well 1 -->
 <!-- panel 2 -->
 <div class="col-sm-1" style="width: 120px; margin-left: 200px; margin-top: -1400px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">280</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_280->user}}</p>
            <p style="text-decoration: <?php if ($Render_280->workstation === $Render_280->hostname) {
              if ($Render_280->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_280->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_280->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_280->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_280->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">281</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_281->user}}</p>
            <p style="text-decoration: <?php if ($Render_281->workstation === $Render_281->hostname) {
              if ($Render_281->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_281->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_281->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_281->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_281->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">282</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_282->user}}</p>
            <p style="text-decoration: <?php if ($Render_282->workstation === $Render_282->hostname) {
              if ($Render_282->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_282->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_282->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_282->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_282->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">283</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_283->user}}</p>
            <p style="text-decoration: <?php if ($Render_283->workstation === $Render_283->hostname) {
              if ($Render_283->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_283->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_283->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_283->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_283->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">284</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_284->user}}</p>
            <p style="text-decoration: <?php if ($Render_284->workstation === $Render_284->hostname) {
              if ($Render_284->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_284->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_284->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_284->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_284->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">285</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_285->user}}</p>
            <p style="text-decoration: <?php if ($Render_285->workstation === $Render_285->hostname) {
              if ($Render_285->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_285->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_285->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_285->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_285->secondary_workstation}}</p>
          </label>
          </div>    
       </div> 
    </div>  
  </div>
 <!-- panel 2 -->
 <!-- panel 3 -->
 <div class="col-sm-1" style="width: 120px; margin-left: -30px; margin-top: 0px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">286</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_286->user}}</p>
            <p style="text-decoration: <?php if ($Render_286->workstation === $Render_286->hostname) {
              if ($Render_286->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_286->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_286->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_286->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_286->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">287</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_287->user}}</p>
            <p style="text-decoration: <?php if ($Render_287->workstation === $Render_287->hostname) {
              if ($Render_287->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_287->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_287->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_287->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_287->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">288</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_288->user}}</p>
            <p style="text-decoration: <?php if ($Render_288->workstation === $Render_288->hostname) {
              if ($Render_288->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_288->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_288->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_288->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_288->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">289</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_289->user}}</p>
            <p style="text-decoration: <?php if ($Render_289->workstation === $Render_289->hostname) {
              if ($Render_289->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_289->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_289->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_289->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_289->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">290</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_290->user}}</p>
            <p style="text-decoration: <?php if ($Render_290->workstation === $Render_290->hostname) {
              if ($Render_290->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_290->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_290->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_290->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_290->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">291</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_291->user}}</p>
            <p style="text-decoration: <?php if ($Render_291->workstation === $Render_291->hostname) {
              if ($Render_291->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_291->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_291->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_291->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_291->secondary_workstation}}</p>
          </label>
          </div>    
       </div> 
    </div>  
  </div>
 <!-- panel 3 -->
 <!-- panel 4 -->
 <div class="col-sm-1" style="width: 120px; margin-left: 30px; margin-top: 0px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">292</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_292->user}}</p>
            <p style="text-decoration: <?php if ($Render_292->workstation === $Render_292->hostname) {
              if ($Render_292->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_292->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_292->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_292->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_292->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">293</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_293->user}}</p>
            <p style="text-decoration: <?php if ($Render_293->workstation === $Render_293->hostname) {
              if ($Render_293->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_293->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_293->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_293->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_293->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">294</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_294->user}}</p>
            <p style="text-decoration: <?php if ($Render_294->workstation === $Render_294->hostname) {
              if ($Render_294->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_294->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_294->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_294->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_294->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">295</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_295->user}}</p>
            <p style="text-decoration: <?php if ($Render_295->workstation === $Render_295->hostname) {
              if ($Render_295->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_295->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_295->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_295->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_295->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">296</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_296->user}}</p>
            <p style="text-decoration: <?php if ($Render_296->workstation === $Render_296->hostname) {
              if ($Render_296->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_296->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_296->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_296->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_296->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">297</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_297->user}}</p>
            <p style="text-decoration: <?php if ($Render_297->workstation === $Render_297->hostname) {
              if ($Render_297->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_297->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_297->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_297->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_297->secondary_workstation}}</p>
          </label>
          </div>    
       </div> 
    </div>  
  </div>
 <!-- panel 4 -->
 <!-- panel 4 -->
 <div class="col-sm-1" style="width: 120px; margin-left: -30px; margin-top: 0px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">298</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_298->user}}</p>
            <p style="text-decoration: <?php if ($Render_298->workstation === $Render_298->hostname) {
              if ($Render_298->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_298->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_298->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_298->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_298->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">299</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_299->user}}</p>
            <p style="text-decoration: <?php if ($Render_299->workstation === $Render_299->hostname) {
              if ($Render_299->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_299->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_299->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_299->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_299->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">300</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_300->user}}</p>
            <p style="text-decoration: <?php if ($Render_300->workstation === $Render_300->hostname) {
              if ($Render_300->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_300->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_300->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_300->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_300->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">301</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_301->user}}</p>
            <p style="text-decoration: <?php if ($Render_301->workstation === $Render_301->hostname) {
              if ($Render_301->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_301->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_301->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_301->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_301->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">302</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_302->user}}</p>
            <p style="text-decoration: <?php if ($Render_302->workstation === $Render_302->hostname) {
              if ($Render_302->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_302->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_302->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_302->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_302->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">303</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_303->user}}</p>
            <p style="text-decoration: <?php if ($Render_303->workstation === $Render_303->hostname) {
              if ($Render_303->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_303->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_303->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_303->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_303->secondary_workstation}}</p>
          </label>
          </div>    
       </div> 
    </div>  
  </div>
 <!-- panel 4 -->
 <!-- panel 5 -->
 <div class="col-sm-1" style="width: 120px; margin-left: 30px; margin-top: 0px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">304</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_304->user}}</p>
            <p style="text-decoration: <?php if ($Render_304->workstation === $Render_304->hostname) {
              if ($Render_304->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_304->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_304->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_304->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_304->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">305</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_305->user}}</p>
            <p style="text-decoration: <?php if ($Render_305->workstation === $Render_305->hostname) {
              if ($Render_305->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_305->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_305->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_305->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_305->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">306</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_306->user}}</p>
            <p style="text-decoration: <?php if ($Render_306->workstation === $Render_306->hostname) {
              if ($Render_306->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_306->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_306->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_306->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_306->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">307</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_307->user}}</p>
            <p style="text-decoration: <?php if ($Render_307->workstation === $Render_307->hostname) {
              if ($Render_307->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_307->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_307->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_307->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_307->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">308</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_308->user}}</p>
            <p style="text-decoration: <?php if ($Render_308->workstation === $Render_308->hostname) {
              if ($Render_308->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_308->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_308->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_308->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_308->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">309</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_309->user}}</p>
            <p style="text-decoration: <?php if ($Render_309->workstation === $Render_309->hostname) {
              if ($Render_309->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_309->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_309->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_309->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_309->secondary_workstation}}</p>
          </label>
          </div>    
       </div> 
    </div>  
  </div>
 <!-- panel 5 -->
 <!-- panel 6 -->
 <div class="col-sm-1" style="width: 120px; margin-left: -30px; margin-top: 0px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">310</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_310->user}}</p>
            <p style="text-decoration: <?php if ($Render_310->workstation === $Render_310->hostname) {
              if ($Render_310->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_310->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_310->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_310->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_310->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">311</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_311->user}}</p>
            <p style="text-decoration: <?php if ($Render_311->workstation === $Render_311->hostname) {
              if ($Render_311->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_311->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_311->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_311->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_311->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">312</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_312->user}}</p>
            <p style="text-decoration: <?php if ($Render_312->workstation === $Render_312->hostname) {
              if ($Render_312->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_312->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_312->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_312->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_312->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">313</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_313->user}}</p>
            <p style="text-decoration: <?php if ($Render_313->workstation === $Render_307->hostname) {
              if ($Render_313->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_313->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_313->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_313->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_313->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">314</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_314->user}}</p>
            <p style="text-decoration: <?php if ($Render_314->workstation === $Render_314->hostname) {
              if ($Render_314->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_314->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_314->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_314->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_314->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">315</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_315->user}}</p>
            <p style="text-decoration: <?php if ($Render_315->workstation === $Render_315->hostname) {
              if ($Render_315->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_315->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_315->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_315->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_315->secondary_workstation}}</p>
          </label>
          </div>    
       </div> 
    </div>  
  </div>
 <!-- panel 6 -->
 <!-- panel 7 -->
 <div class="col-sm-1" style="width: 120px; margin-left: 30px; margin-top: 0px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">316</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_316->user}}</p>
            <p style="text-decoration: <?php if ($Render_316->workstation === $Render_316->hostname) {
              if ($Render_316->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_316->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_316->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_316->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_316->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">317</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_317->user}}</p>
            <p style="text-decoration: <?php if ($Render_317->workstation === $Render_317->hostname) {
              if ($Render_317->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_317->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_317->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_317->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_317->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">318</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_318->user}}</p>
            <p style="text-decoration: <?php if ($Render_318->workstation === $Render_318->hostname) {
              if ($Render_318->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_318->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_318->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_318->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_318->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">319</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_319->user}}</p>
            <p style="text-decoration: <?php if ($Render_319->workstation === $Render_319->hostname) {
              if ($Render_319->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_319->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_319->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_319->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_319->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">320</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_320->user}}</p>
            <p style="text-decoration: <?php if ($Render_320->workstation === $Render_320->hostname) {
              if ($Render_320->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_320->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_320->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_320->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_320->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">321</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_321->user}}</p>
            <p style="text-decoration: <?php if ($Render_321->workstation === $Render_321->hostname) {
              if ($Render_321->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_321->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_321->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_321->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_321->secondary_workstation}}</p>
          </label>
          </div>    
       </div> 
    </div>  
  </div>
 <!-- panel 7 -->
 <!-- panel 8 -->
 <div class="col-sm-1" style="width: 120px; margin-left: -30px; margin-top: 0px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">322</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_322->user}}</p>
            <p style="text-decoration: <?php if ($Render_322->workstation === $Render_322->hostname) {
              if ($Render_322->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_322->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_322->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_322->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_322->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">323</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_323->user}}</p>
            <p style="text-decoration: <?php if ($Render_323->workstation === $Render_323->hostname) {
              if ($Render_323->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_323->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_323->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_323->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_323->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">324</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_324->user}}</p>
            <p style="text-decoration: <?php if ($Render_324->workstation === $Render_324->hostname) {
              if ($Render_324->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_324->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_324->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_324->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_324->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">325</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_325->user}}</p>
            <p style="text-decoration: <?php if ($Render_325->workstation === $Render_325->hostname) {
              if ($Render_325->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_325->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_325->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_325->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_325->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">326</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_326->user}}</p>
            <p style="text-decoration: <?php if ($Render_326->workstation === $Render_326->hostname) {
              if ($Render_326->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_326->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_326->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_326->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_326->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">327</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_327->user}}</p>
            <p style="text-decoration: <?php if ($Render_327->workstation === $Render_327->hostname) {
              if ($Render_327->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_327->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_327->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_327->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_327->secondary_workstation}}</p>
          </label>
          </div>    
       </div> 
    </div>  
  </div>
 <!-- panel 8 -->
 <!-- panel 9 -->
 <div class="col-sm-1" style="width: 120px; margin-left: 30px; margin-top: 890px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">328</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_328->user}}</p>
            <p style="text-decoration: <?php if ($Render_328->workstation === $Render_328->hostname) {
              if ($Render_328->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_328->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_328->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_328->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_328->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">329</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_329->user}}</p>
            <p style="text-decoration: <?php if ($Render_329->workstation === $Render_329->hostname) {
              if ($Render_329->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_329->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_329->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_329->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_329->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">330</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_330->user}}</p>
            <p style="text-decoration: <?php if ($Render_330->workstation === $Render_330->hostname) {
              if ($Render_330->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_330->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_330->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_330->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_330->secondary_workstation}}</p>
          </label>
          </div>    
       </div>          
    </div>  
  </div>
 <!-- panel 9 -->
 <!-- panel 10 -->
 <div class="col-sm-1" style="width: 120px; margin-left: -30px; margin-top: 890px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">331</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_331->user}}</p>
            <p style="text-decoration: <?php if ($Render_331->workstation === $Render_331->hostname) {
              if ($Render_331->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_331->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_331->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_331->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_331->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">332</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_332->user}}</p>
            <p style="text-decoration: <?php if ($Render_332->workstation === $Render_332->hostname) {
              if ($Render_332->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_332->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_332->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_332->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_332->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">333</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_333->user}}</p>
            <p style="text-decoration: <?php if ($Render_333->workstation === $Render_333->hostname) {
              if ($Render_333->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_333->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_333->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_333->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_333->secondary_workstation}}</p>
          </label>
          </div>    
       </div>          
    </div>  
  </div>
 <!-- panel 10 -->
 <!-- panel 11 -->
 <div class="col-sm-1" style="width: 120px; margin-left: 30px; margin-top: 890px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">334</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_334->user}}</p>
            <p style="text-decoration: <?php if ($Render_334->workstation === $Render_334->hostname) {
              if ($Render_334->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_334->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_334->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_334->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_334->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">335</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_335->user}}</p>
            <p style="text-decoration: <?php if ($Render_335->workstation === $Render_335->hostname) {
              if ($Render_335->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_335->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_335->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_335->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_335->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">336</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_336->user}}</p>
            <p style="text-decoration: <?php if ($Render_336->workstation === $Render_336->hostname) {
              if ($Render_336->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_336->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_336->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_336->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_336->secondary_workstation}}</p>
          </label>
          </div>    
       </div>          
    </div>  
  </div>
 <!-- panel 11 -->
 <!-- panel 12 -->
 <div class="col-sm-1" style="width: 120px; margin-left: -30px; margin-top: 890px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">337</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_337->user}}</p>
            <p style="text-decoration: <?php if ($Render_337->workstation === $Render_337->hostname) {
              if ($Render_337->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_337->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_337->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_337->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_337->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">338</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_338->user}}</p>
            <p style="text-decoration: <?php if ($Render_338->workstation === $Render_338->hostname) {
              if ($Render_338->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_338->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_338->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_338->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_338->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">339</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_339->user}}</p>
            <p style="text-decoration: <?php if ($Render_339->workstation === $Render_339->hostname) {
              if ($Render_339->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_339->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_339->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_339->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_339->secondary_workstation}}</p>
          </label>
          </div>    
       </div>          
    </div>  
  </div>
 <!-- panel 12 -->
 <!-- panel 13 -->
 <div class="col-sm-1" style="width: 120px; margin-left: 30px; margin-top: 890px;">
    <div class="panel panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">340</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_340->user}}</p>
            <p style="text-decoration: <?php if ($Render_340->workstation === $Render_340->hostname) {
              if ($Render_340->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_340->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_340->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_340->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_340->secondary_workstation}}</p>
          </label>
          </div>    
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">341</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_341->user}}</p>
            <p style="text-decoration: <?php if ($Render_341->workstation === $Render_341->hostname) {
              if ($Render_341->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_341->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_341->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_341->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_341->secondary_workstation}}</p>
          </label>
          </div>    
       </div>
       <div class="panel panel-default">
          <div class="panel-heading">342</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$Render_342->user}}</p>
            <p style="text-decoration: <?php if ($Render_342->workstation === $Render_342->hostname) {
              if ($Render_342->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$Render_342->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($Render_342->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $Render_342->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$Render_342->secondary_workstation}}</p>
          </label>
          </div>    
       </div>          
    </div>  
  </div>
 <!-- panel 13 -->
</div>
<!-- row 2 -->
<!-- end -->
</body>
</html>
