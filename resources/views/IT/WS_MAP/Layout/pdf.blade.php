<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='shortcut icon' href="{{asset('assets/12.png')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
  <title>WS- Map Layout (Asset)</title>
</head>
<body>
  <div class="row">
    <div>          
       <h1 class="page-header text-center">Layout (Asset)</h1>                   
    </div>
</div>
<!-- start -->
<?php use App\Ws_Availability; ?>
<div class="row">
  <!-- start room meeting -->
   <div class="well" style="width: 550px; height: 900px; margin-left: 600px;">
     <div class="col-sm-1" style="width: 120px; margin-left: 215px; margin-top: 650px;">
      <div class="panel panel-default">
          <div class="panel-heading">237</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_237->user}}</p>
            <p style="text-decoration: <?php if ($layout_237->workstation === $layout_237->hostname) {
              if ($layout_237->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_237->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_237->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_237->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_237->secondary_workstation}}</p>
          </label>
          </div>
        </div>
     </div>
   </div>
  <!-- end room meeting -->
  <!-- room 2 -->
  <div class="well" style="width: 300px; margin-left: 1200px; margin-top: -1200px; height: 900px">
    
   </div>
   <!--  end room 2 -->
   <!-- start room 3 -->
   <div class="well" style="width: 625px;  margin-left: 1550px; margin-top: -1200px; height: 900px;">
    <!-- start panel 1 -->
     <div class="col-sm-1" style="width: 120px;">
      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">238</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_238->user}}</p>
            <p style="text-decoration: <?php if ($layout_238->workstation === $layout_238->hostname) {
              if ($layout_238->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_238->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_238->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_238->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_238->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">239</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_239->user}}</p>
            <p style="text-decoration: <?php if ($layout_239->workstation === $layout_239->hostname) {
              if ($layout_239->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_239->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_239->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_239->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_239->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">240</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_240->user}}</p>
            <p style="text-decoration: <?php if ($layout_240->workstation === $layout_240->hostname) {
              if ($layout_240->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_240->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_240->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_240->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_240->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
         <div class="panel-heading">241</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_241->user}}</p>
            <p style="text-decoration: <?php if ($layout_241->workstation === $layout_241->hostname) {
              if ($layout_241->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_241->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_241->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_241->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_241->secondary_workstation}}</p>
          </label>
          </div>
        </div>
      </div>
     </div>
     <div class="col-sm-1" style="width: 120px; margin-left: -30px;">
      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">242</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_242->user}}</p>
            <p style="text-decoration: <?php if ($layout_242->workstation === $layout_242->hostname) {
              if ($layout_242->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_242->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_242->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_242->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_242->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
           <div class="panel-heading">243</div>
           <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_243->user}}</p>
            <p style="text-decoration: <?php if ($layout_243->workstation === $layout_243->hostname) {
              if ($layout_243->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_243->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_243->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_243->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_243->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">244</div>
           <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_244->user}}</p>
            <p style="text-decoration: <?php if ($layout_244->workstation === $layout_244->hostname) {
              if ($layout_244->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_244->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_244->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_244->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_244->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
           <div class="panel-heading">245</div>
           <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_245->user}}</p>
            <p style="text-decoration: <?php if ($layout_245->workstation === $layout_245->hostname) {
              if ($layout_245->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_245->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_245->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_245->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_245->secondary_workstation}}</p>
          </label>
          </div>
        </div>
      </div>
      <div class="col-sm-1" style="width: 120px; margin-left: 152px; margin-top: -1200px;">
      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">246</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_246->user}}</p>
            <p style="text-decoration: <?php if ($layout_246->workstation === $layout_246->hostname) {
              if ($layout_246->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_246->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_246->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_246->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_246->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
           <div class="panel-heading">247</div>
           <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_247->user}}</p>
            <p style="text-decoration: <?php if ($layout_247->workstation === $layout_247->hostname) {
              if ($layout_247->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_247->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_247->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_247->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_247->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">248</div>
           <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_248->user}}</p>
            <p style="text-decoration: <?php if ($layout_248->workstation === $layout_248->hostname) {
              if ($layout_248->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_248->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_248->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_248->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_248->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
           <div class="panel-heading">249</div>
           <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_249->user}}</p>
            <p style="text-decoration: <?php if ($layout_249->workstation === $layout_249->hostname) {
              if ($layout_249->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_249->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_249->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_249->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_249->secondary_workstation}}</p>
          </label>
          </div>
        </div>
      </div>
       <div class="col-sm-1" style="width: 120px; margin-left: 105px; margin-top: -1200px;">
      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">250</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_250->user}}</p>
            <p style="text-decoration: <?php if ($layout_250->workstation === $layout_250->hostname) {
              if ($layout_250->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_250->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_250->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_250->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_250->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
           <div class="panel-heading">251</div>
           <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_251->user}}</p>
            <p style="text-decoration: <?php if ($layout_251->workstation === $layout_251->hostname) {
              if ($layout_251->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_251->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_251->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_251->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_251->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">252</div>
           <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_252->user}}</p>
            <p style="text-decoration: <?php if ($layout_252->workstation === $layout_252->hostname) {
              if ($layout_252->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_252->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_252->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_252->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_252->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
           <div class="panel-heading">253</div>
           <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_253->user}}</p>
            <p style="text-decoration: <?php if ($layout_253->workstation === $layout_253->hostname) {
              if ($layout_253->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_253->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_253->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_253->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_253->secondary_workstation}}</p>
          </label>
          </div>
        </div>
      </div>
     </div>  
    <!-- end pane 1 -->
   </div>
 </div>
</div>
</div>
   <!-- end room 3 -->

</div>
<div class="container-fluid">
<div class="row">
<!-- start Layout -->
<!-- Panel 0 -->
<div class="col-sm-1" style="width: 10px; margin-top: 150px;  margin-top: 435px;">
</div>
<!-- pnael 0 -->
    <!-- panel 1 -->
   <div class="col-sm-1" style="width: 120px; margin-top: 150px;  margin-top: 435px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">160</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_160->user}}</p>
            <p style="text-decoration: <?php if ($layout_160->workstation === $layout_160->hostname) {
              if ($layout_160->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_160->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_160->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_160->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_160->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">161</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_161->user}}</p>
            <p style="text-decoration: <?php if ($layout_161->workstation === $layout_161->hostname) {
              if ($layout_161->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_161->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_161->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_161->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_161->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">162</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_162->user}}</p>
            <p style="text-decoration: <?php if ($layout_162->workstation === $layout_162->hostname) {
              if ($layout_162->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_162->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_162->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_162->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_162->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">163</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_163->user}}</p>
            <p style="text-decoration: <?php if ($layout_163->workstation === $layout_163->hostname) {
              if ($layout_163->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_163->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_163->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_163->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_163->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">164</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_164->user}}</p>
            <p style="text-decoration: <?php if ($layout_164->workstation === $layout_164->hostname) {
              if ($layout_164->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_164->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_164->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_164->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_164->secondary_workstation}}</p>
          </label>
          </div>
        </div>
    </div>
   </div>
   <!-- panel 1 -->
   <!-- panel 2 -->
   <div class="col-sm-1" style="width: 120px; margin-left: 10px;  margin-top: 435px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">165</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_165->user}}</p>
            <p style="text-decoration: <?php if ($layout_165->workstation === $layout_165->hostname) {
              if ($layout_165->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_165->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_165->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_165->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_165->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">166</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_166->user}}</p>
            <p style="text-decoration: <?php if ($layout_166->workstation === $layout_166->hostname) {
              if ($layout_166->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_166->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_166->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_166->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_166->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">167</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_167->user}}</p>
            <p style="text-decoration: <?php if ($layout_167->workstation === $layout_167->hostname) {
              if ($layout_167->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_167->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_167->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_167->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_167->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">168</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_168->user}}</p>
            <p style="text-decoration: <?php if ($layout_168->workstation === $layout_168->hostname) {
              if ($layout_168->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_168->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_168->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_168->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_168->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">169</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_169->user}}</p>
            <p style="text-decoration: <?php if ($layout_169->workstation === $layout_169->hostname) {
              if ($layout_169->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_169->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_169->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_169->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_169->secondary_workstation}}</p>
          </label>
          </div>
        </div>
    </div>
   </div>
   <!-- panel 2 -->
   <!-- panel 3 -->
   <div class="col-sm-1" style="width: 120px; margin-left: -30px;  margin-top: 435px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">170</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_170->user}}</p>
            <p style="text-decoration: <?php if ($layout_170->workstation === $layout_170->hostname) {
              if ($layout_170->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_170->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_170->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_170->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_170->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">171</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_171->user}}</p>
            <p style="text-decoration: <?php if ($layout_171->workstation === $layout_171->hostname) {
              if ($layout_171->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_171->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_171->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_171->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_171->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">172</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_172->user}}</p>
            <p style="text-decoration: <?php if ($layout_172->workstation === $layout_172->hostname) {
              if ($layout_172->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_172->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_172->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_172->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_172->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">173</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_173->user}}</p>
            <p style="text-decoration: <?php if ($layout_173->workstation === $layout_173->hostname) {
              if ($layout_173->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_173->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_173->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_173->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_173->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">174</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_174->user}}</p>
            <p style="text-decoration: <?php if ($layout_174->workstation === $layout_174->hostname) {
              if ($layout_174->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_174->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_174->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_174->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_174->secondary_workstation}}</p>
          </label>
          </div>
        </div>
    </div>
   </div>
   <!-- panel 3 -->
   <!-- panel 4 -->
   <div class="col-sm-1" style="width: 120px; margin-left: 10px; margin-top: 435px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">175</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_175->user}}</p>
            <p style="text-decoration: <?php if ($layout_175->workstation === $layout_175->hostname) {
              if ($layout_175->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_175->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_175->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_175->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_175->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">176</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_176->user}}</p>
            <p style="text-decoration: <?php if ($layout_176->workstation === $layout_171->hostname) {
              if ($layout_176->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_176->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_176->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_176->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_176->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">177</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_177->user}}</p>
            <p style="text-decoration: <?php if ($layout_177->workstation === $layout_177->hostname) {
              if ($layout_177->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_177->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_177->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_177->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_177->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">178</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_178->user}}</p>
            <p style="text-decoration: <?php if ($layout_178->workstation === $layout_178->hostname) {
              if ($layout_178->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_178->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_178->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_178->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_178->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">179</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_179->user}}</p>
            <p style="text-decoration: <?php if ($layout_179->workstation === $layout_179->hostname) {
              if ($layout_179->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_179->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_179->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_179->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_179->secondary_workstation}}</p>
          </label>
          </div>
        </div>
    </div>
   </div>
   <!-- panel 4 -->
   <!-- panel 5 -->
   <div class="col-sm-1" style="width: 120px; margin-left: -30px; margin-top: 435px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">180</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_180->user}}</p>
            <p style="text-decoration: <?php if ($layout_180->workstation === $layout_180->hostname) {
              if ($layout_180->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_180->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_180->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_180->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_180->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">181</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_181->user}}</p>
            <p style="text-decoration: <?php if ($layout_181->workstation === $layout_181->hostname) {
              if ($layout_181->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_181->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_181->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_181->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_181->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">182</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_182->user}}</p>
            <p style="text-decoration: <?php if ($layout_182->workstation === $layout_182->hostname) {
              if ($layout_182->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_182->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_182->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_182->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_182->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">183</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_183->user}}</p>
            <p style="text-decoration: <?php if ($layout_183->workstation === $layout_183->hostname) {
              if ($layout_183->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_183->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_183->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_183->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_183->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">184</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_184->user}}</p>
            <p style="text-decoration: <?php if ($layout_184->workstation === $layout_184->hostname) {
              if ($layout_184->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_184->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_184->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_184->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_184->secondary_workstation}}</p>
          </label>
          </div>
        </div>
    </div>
   </div>
   <!-- panel 5 -->
   <!-- panel 6 -->
   <div class="col-sm-1" style="width: 120px; margin-left: 20px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">185</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_185->user}}</p>
            <p style="text-decoration: <?php if ($layout_185->workstation === $layout_185->hostname) {
              if ($layout_185->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_185->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_185->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_185->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_185->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">186</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_186->user}}</p>
            <p style="text-decoration: <?php if ($layout_186->workstation === $layout_186->hostname) {
              if ($layout_186->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_186->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_186->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_186->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_186->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">187</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_187->user}}</p>
            <p style="text-decoration: <?php if ($layout_187->workstation === $layout_187->hostname) {
              if ($layout_187->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_187->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_187->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_187->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_187->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">188</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_188->user}}</p>
            <p style="text-decoration: <?php if ($layout_188->workstation === $layout_188->hostname) {
              if ($layout_188->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_188->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_188->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_188->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_188->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">189</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_189->user}}</p>
            <p style="text-decoration: <?php if ($layout_189->workstation === $layout_189->hostname) {
              if ($layout_189->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_189->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_189->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_189->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_189->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">190</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_190->user}}</p>
            <p style="text-decoration: <?php if ($layout_190->workstation === $layout_190->hostname) {
              if ($layout_190->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_190->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_190->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_190->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_190->secondary_workstation}}</p>
          </label>
          </div>
        </div>       
    </div>
   </div>
   <!-- panel 6 -->
   <!-- panel 7 -->
   <div class="col-sm-1" style="width: 120px; margin-left: -30px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">191</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_191->user}}</p>
            <p style="text-decoration: <?php if ($layout_191->workstation === $layout_191->hostname) {
              if ($layout_191->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_191->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_191->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_191->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_191->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">192</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_192->user}}</p>
            <p style="text-decoration: <?php if ($layout_192->workstation === $layout_192->hostname) {
              if ($layout_192->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_192->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_192->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_192->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_192->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">193</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_193->user}}</p>
            <p style="text-decoration: <?php if ($layout_193->workstation === $layout_193->hostname) {
              if ($layout_193->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_193->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_193->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_193->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_193->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">194</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_194->user}}</p>
            <p style="text-decoration: <?php if ($layout_194->workstation === $layout_194->hostname) {
              if ($layout_194->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_194->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_194->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_194->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_194->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">195</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_195->user}}</p>
            <p style="text-decoration: <?php if ($layout_195->workstation === $layout_195->hostname) {
              if ($layout_195->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_189->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_189->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_195->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_195->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">196</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_196->user}}</p>
            <p style="text-decoration: <?php if ($layout_196->workstation === $layout_196->hostname) {
              if ($layout_196->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_196->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_196->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_196->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_196->secondary_workstation}}</p>
          </label>
          </div>
        </div>       
    </div>
   </div>
   <!-- panel 7 -->
   <!-- panel 8 -->
   <div class="col-sm-1" style="width: 120px; margin-left: 0px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">197</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_197->user}}</p>
            <p style="text-decoration: <?php if ($layout_197->workstation === $layout_197->hostname) {
              if ($layout_197->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_197->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_197->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_197->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_197->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">198</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_198->user}}</p>
            <p style="text-decoration: <?php if ($layout_198->workstation === $layout_198->hostname) {
              if ($layout_198->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_198->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_198->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_198->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_198->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">199</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_199->user}}</p>
            <p style="text-decoration: <?php if ($layout_199->workstation === $layout_199->hostname) {
              if ($layout_199->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_199->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_199->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_199->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_199->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">200</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_200->user}}</p>
            <p style="text-decoration: <?php if ($layout_200->workstation === $layout_200->hostname) {
              if ($layout_200->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_200->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_200->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_200->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_200->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">201</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_201->user}}</p>
            <p style="text-decoration: <?php if ($layout_201->workstation === $layout_201->hostname) {
              if ($layout_201->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_201->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_201->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_201->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_201->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">202</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_202->user}}</p>
            <p style="text-decoration: <?php if ($layout_202->workstation === $layout_202->hostname) {
              if ($layout_202->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_202->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_202->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_202->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_202->secondary_workstation}}</p>
          </label>
          </div>
        </div>       
    </div>
   </div>
   <!-- panel 8 -->
   <!-- panel 9 -->
   <div class="col-sm-1" style="width: 120px; margin-left: -30px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">203</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_203->user}}</p>
            <p style="text-decoration: <?php if ($layout_203->workstation === $layout_203->hostname) {
              if ($layout_203->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_203->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_203->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_203->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_203->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">204</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_204->user}}</p>
            <p style="text-decoration: <?php if ($layout_204->workstation === $layout_204->hostname) {
              if ($layout_204->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_204->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_204->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_204->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_204->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">205</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_205->user}}</p>
            <p style="text-decoration: <?php if ($layout_205->workstation === $layout_205->hostname) {
              if ($layout_205->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_205->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_205->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_205->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_205->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">206</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_206->user}}</p>
            <p style="text-decoration: <?php if ($layout_206->workstation === $layout_206->hostname) {
              if ($layout_206->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_206->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_206->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_206->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_206->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">207</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_207->user}}</p>
            <p style="text-decoration: <?php if ($layout_207->workstation === $layout_207->hostname) {
              if ($layout_207->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_207->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_207->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_207->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_207->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">208</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_208->user}}</p>
            <p style="text-decoration: <?php if ($layout_208->workstation === $layout_208->hostname) {
              if ($layout_208->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_208->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_208->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_208->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_208->secondary_workstation}}</p>
          </label>
          </div>
        </div>       
    </div>
   </div>
   <!-- panel 9 -->
   <!-- panel 10 -->
   <div class="col-sm-1" style="width: 120px; margin-left: 0px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">209</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_209->user}}</p>
            <p style="text-decoration: <?php if ($layout_209->workstation === $layout_209->hostname) {
              if ($layout_209->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_209->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_209->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_209->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_209->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">210</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_210->user}}</p>
            <p style="text-decoration: <?php if ($layout_210->workstation === $layout_210->hostname) {
              if ($layout_210->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_210->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_210->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_210->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_210->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">211</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_211->user}}</p>
            <p style="text-decoration: <?php if ($layout_211->workstation === $layout_211->hostname) {
              if ($layout_211->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_211->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_211->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_211->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_211->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">212</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_212->user}}</p>
            <p style="text-decoration: <?php if ($layout_212->workstation === $layout_212->hostname) {
              if ($layout_212->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_212->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_212->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_212->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_212->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">213</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_213->user}}</p>
            <p style="text-decoration: <?php if ($layout_213->workstation === $layout_213->hostname) {
              if ($layout_213->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_213->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_213->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_213->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_213->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">214</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_214->user}}</p>
            <p style="text-decoration: <?php if ($layout_214->workstation === $layout_214->hostname) {
              if ($layout_214->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_214->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_214->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_214->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_214->secondary_workstation}}</p>
          </label>
          </div>
        </div>       
    </div>
   </div>
   <!-- panel 10 -->
   <!-- panel 11 -->
   <div class="col-sm-1" style="width: 120px; margin-left: -30px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">215</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_215->user}}</p>
            <p style="text-decoration: <?php if ($layout_215->workstation === $layout_215->hostname) {
              if ($layout_215->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_215->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_215->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_215->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_215->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">216</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_216->user}}</p>
            <p style="text-decoration: <?php if ($layout_216->workstation === $layout_216->hostname) {
              if ($layout_216->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_216->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_216->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_216->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_216->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">217</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_217->user}}</p>
            <p style="text-decoration: <?php if ($layout_217->workstation === $layout_217->hostname) {
              if ($layout_217->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_217->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_217->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_217->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_217->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">218</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_218->user}}</p>
            <p style="text-decoration: <?php if ($layout_218->workstation === $layout_218->hostname) {
              if ($layout_218->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_218->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_218->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_218->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_218->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">219</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_219->user}}</p>
            <p style="text-decoration: <?php if ($layout_219->workstation === $layout_219->hostname) {
              if ($layout_219->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_219->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_219->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_219->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_219->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">220</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_220->user}}</p>
            <p style="text-decoration: <?php if ($layout_220->workstation === $layout_220->hostname) {
              if ($layout_220->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_220->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_220->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_220->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_220->secondary_workstation}}</p>
          </label>
          </div>
        </div>       
    </div>
   </div>
   <!-- panel 11 -->
   <!-- panel 12 -->
   <div class="col-sm-1" style="width: 120px; margin-left: 0px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">221</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_221->user}}</p>
            <p style="text-decoration: <?php if ($layout_221->workstation === $layout_221->hostname) {
              if ($layout_221->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_221->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_221->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_221->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_221->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">222</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_222->user}}</p>
            <p style="text-decoration: <?php if ($layout_222->workstation === $layout_222->hostname) {
              if ($layout_222->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_222->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_222->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_222->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_222->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">223</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_223->user}}</p>
            <p style="text-decoration: <?php if ($layout_223->workstation === $layout_223->hostname) {
              if ($layout_223->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_223->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_223->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_223->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_223->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">224</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_224->user}}</p>
            <p style="text-decoration: <?php if ($layout_224->workstation === $layout_224->hostname) {
              if ($layout_224->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_224->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_224->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_224->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_224->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">225</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_225->user}}</p>
            <p style="text-decoration: <?php if ($layout_225->workstation === $layout_225->hostname) {
              if ($layout_225->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_225->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_225->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_225->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_225->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">226</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>PORT<br>LAN FULL</p>
            <p style="text-decoration: <?php if ($layout_226->workstation === $layout_226->hostname) {
              if ($layout_226->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_226->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_226->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_226->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_226->secondary_workstation}}</p>
          </label>
          </div>
        </div>       
    </div>
   </div>
   <!-- panel 12 -->
   <!-- panel 13 -->
   <div class="col-sm-1" style="width: 120px; margin-left: -30px;">
    <div class="panel-group">
      <div class="panel panel-default">
          <div class="panel-heading">227</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_227->user}}</p>
            <p style="text-decoration: <?php if ($layout_227->workstation === $layout_227->hostname) {
              if ($layout_227->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_227->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_227->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_227->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_227->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">228</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_228->user}}</p>
            <p style="text-decoration: <?php if ($layout_228->workstation === $layout_228->hostname) {
              if ($layout_228->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_228->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_228->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_228->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_228->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">229</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_229->user}}</p>
            <p style="text-decoration: <?php if ($layout_229->workstation === $layout_229->hostname) {
              if ($layout_229->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_229->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_229->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_229->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_229->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">230</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_230->user}}</p>
            <p style="text-decoration: <?php if ($layout_230->workstation === $layout_230->hostname) {
              if ($layout_230->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_230->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_230->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_230->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_230->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">231</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_231->user}}</p>
            <p style="text-decoration: <?php if ($layout_231->workstation === $layout_231->hostname) {
              if ($layout_231->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_231->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_231->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_231->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_231->secondary_workstation}}</p>
          </label>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">232</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_232->user}}</p>
            <p style="text-decoration: <?php if ($layout_232->workstation === $layout_232->hostname) {
              if ($layout_232->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_232->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_232->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_232->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_232->secondary_workstation}}</p>
          </label>
          </div>
        </div>       
    </div>
   </div>
   <!-- panel 13 -->
   <!-- room 4 -->
    <div class="col-sm-1" style="width: 300px; margin-left: 30px;">
      <div class="well" style="height: 600px;">
       <div class="col-sm-1" style="width: 120px; margin-left: -10px;">
          <div class="panel panel-default">
          <div class="panel-heading">233</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_233->user}}</p>
            <p style="text-decoration: <?php if ($layout_233->workstation === $layout_233->hostname) {
              if ($layout_233->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_233->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_233->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_233->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_233->secondary_workstation}}</p>
          </label>
          </div>
          </div>        
       </div>
       <div class="col-sm-1" style="width: 120px; margin-left: 120px;">
          <div class="panel panel-default">
          <div class="panel-heading">234</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_234->user}}</p>
            <p style="text-decoration: <?php if ($layout_234->workstation === $layout_234->hostname) {
              if ($layout_234->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_234->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_234->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_234->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_234->secondary_workstation}}</p>
          </label>
          </div>
          </div>        
       </div>
      </div>
      <div class="well" style="height: 600px;">
       <div class="col-sm-1" style="width: 120px; margin-left: -10px;">
          <div class="panel panel-default">
          <div class="panel-heading">235</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_235->user}}</p>
            <p style="text-decoration: <?php if ($layout_235->workstation === $layout_235->hostname) {
              if ($layout_235->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_235->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_235->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_235->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_235->secondary_workstation}}</p>
          </label>
          </div>
          </div>        
       </div>
       <div class="col-sm-1" style="width: 120px; margin-left: 120px;">
          <div class="panel panel-default">
          <div class="panel-heading">236</div>
          <div class="panel-body text-center" style="height: 150px; font-size: 18px; ">
            <label>
            <p>{{$layout_236->user}}</p>
            <p style="text-decoration: <?php if ($layout_236->workstation === $layout_236->hostname) {
              if ($layout_236->os === 'Linux') {
             echo "underline";
               }         
            }?>;">{{$layout_236->workstation}}</p>       
            <p style="text-decoration: <?php
            if ($layout_236->secondary_workstation != null) {
               $Linux_1 = Ws_Availability::where('hostname', '=', $layout_236->secondary_workstation)->first();
                if ($Linux_1->os === 'Linux') {
                  echo "underline";
                }
            }
            ?>;">{{$layout_236->secondary_workstation}}</p>
          </label>
          </div>
          </div>        
       </div>
      </div>
    </div>
   <!-- room 4 -->
<!-- end Layout -->
</div>
</div>
<!-- end -->
</body>
</html>
