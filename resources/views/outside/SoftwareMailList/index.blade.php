<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="{{asset('assets/iconic2.png')}}">
        <title>List Software - WIS</title>
        @include('assets_css_1')
    </head>
<link href="https://fonts.googleapis.com/css?family=Notable&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Lobster+Two&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Sniglet&display=swap" rel="stylesheet"> 
<style type="text/css">
    body {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  background-color: skyblue;
  background-image: -webkit-linear-gradient(90deg, skyblue 10%, steelblue 100%);
  background-attachment: fixed;
  background-size: 100% 100%;
  overflow: hidden;
  font-family: "Georgia", cursive;
  -webkit-font-smoothing: antialiased;
}

::selection {
  background: transparent;
}
/* CLOUDS */
body:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  width: 0;
  height: 0;
  margin: auto;
  border-radius: 100%;
  background: transparent;
  display: block;
  /*box-shadow: 0 0 150px 100px rgba(255, 255, 255, 0.6),
    200px 0 200px 150px rgba(255, 255, 255, 0.6),
    -250px 0 300px 150px rgba(255, 255, 255, 0.6),
    550px 0 300px 200px rgba(255, 255, 255, 0.6),
    -550px 0 300px 200px rgba(255, 255, 255, 0.6);*/
}
/* JUMP */
h1 {
  cursor: default;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100px;
  margin: auto;
  display: block;
  text-align: center;
}

h1 span {
  position: relative;
  top: 20px;
  display: inline-block;
  -webkit-animation: bounce 0.7s ease infinite alternate;
  font-size: 24px;
  color: #fff;
  text-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc,
    0 5px 0 #ccc, 0 6px 0 transparent, 0 7px 0 transparent, 0 8px 0 transparent,
    0 9px 0 transparent, 0 10px 10px rgba(0, 0, 0, 0.4);
}

h1 span:nth-child(2) {
  -webkit-animation-delay: 0.1s;
}

h1 span:nth-child(3) {
  -webkit-animation-delay: 0.2s;
}

h1 span:nth-child(4) {
  -webkit-animation-delay: 0.3s;
}

h1 span:nth-child(5) {
  -webkit-animation-delay: 0.4s;
}

h1 span:nth-child(6) {
  -webkit-animation-delay: 0.5s;
}

h1 span:nth-child(7) {
  -webkit-animation-delay: 0.6s;
}

h1 span:nth-child(8) {
  -webkit-animation-delay: 0.2s;
}

h1 span:nth-child(9) {
  -webkit-animation-delay: 0.3s;
}

h1 span:nth-child(10) {
  -webkit-animation-delay: 0.4s;
}

h1 span:nth-child(11) {
  -webkit-animation-delay: 0.5s;
}

h1 span:nth-child(12) {
  -webkit-animation-delay: 0.6s;
}

h1 span:nth-child(13) {
  -webkit-animation-delay: 0.7s;
}

h1 span:nth-child(14) {
  -webkit-animation-delay: 0.8s;
}
h1 span:nth-child(15) {
  -webkit-animation-delay: 0.4s;
}
h1 span:nth-child(16) {
  -webkit-animation-delay: 0.6s;
}
h1 span:nth-child(17) {
  -webkit-animation-delay: 0.8s;
}
h1 span:nth-child(18) {
  -webkit-animation-delay: 1s;
}
h1 span:nth-child(19) {
  -webkit-animation-delay: 0.7s;
}
h1 span:nth-child(20) {
  -webkit-animation-delay: 0.4s;
}
h1 span:nth-child(21) {
  -webkit-animation-delay: 0.1s;
}

/* ANIMATION */
@-webkit-keyframes bounce {
  100% {
    top: -20px;
    text-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc,
      0 5px 0 #ccc, 0 6px 0 #ccc, 0 7px 0 #ccc, 0 8px 0 #ccc, 0 9px 0 #ccc,
      0 50px 25px rgba(0, 0, 0, 0.2);
  }
}
/* ////////////////////// */
</style>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-offset-0" style="margin-top: 10%;"> 
                 <!--  <div class="col-md-12">
                   <img src="{{asset('assets/Infinite_Studios_kinema')}}">
                  </div> -->
                  <div class="col-md-12">
                    <!-- <a href=""><center> <img width="60px" height="40px" style="margin-top: 15px;" src="{!! URL::route('assets/img/logo') !!}"></center></a> -->
                    <a href=""><center> <img width="100px" height="60px"  src="{{asset('assets/Graphic2.png')}}"></center></a>
                  </div>                
                  <div class="col-md-12" style="margin-bottom: 60px;">
                  <center>
                   <h1 style="margin-bottom: -90px;">
                            <span>W</span><span>i</span><span>d</span><span>e</span> <span style="margin-left: 5px;">I</span><span>n</span><span>f</span><span>o</span><span>r</span><span>m</span><span>a</span><span>t</span><span>i</span><span>o</span><span>n</span> <span>S</span><span>y</span><span>s</span><span>t</span><span>e</span><span>m</span>
                         <!--    <span>Wide</span><span style="margin-left: 7px;">Information</span><span style="margin-left: 7px;">System</span> -->

                    </h1>  
                </center>
               </div>       
               
                <div class="col-md-12">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <b>List Software <a href="{{route('index')}}" class="pull-right btn btn-sm btn-primary" style="margin-top: -5px;">Login</a></b>
                            </h5>
                        </div>

                        <div class="panel-body">
                         <div class="row">
                         	 <div class="col-md-12">

                          	<div class="table-responsive" style="overflow-y: scroll; height: 350px;">                          		 
                          	<table class="table table-condensed table-hover table-bordered">
                          		<thead>
                          			<tr>                          		
                          				<th>Product</th>
                          				<th>Software Name</th>
                          				<th>Version</th>
                          				<th>Qty</th>
                          				<th>Total Price</th>
                          				<th>Type Software</th>
                          				<th>Status</th>
                          				<th>Expiring Date</th>
                          				<th>Time Limit</th>
                          				<th>Condition</th>
                          			</tr>
                          		</thead>
                          		<tbody>
                          			<?php foreach ($getData as $value): ?>
                          			<?php 
                          					$date1=date_create($value->expiring_date);
											$date2=date_create(date("Y-m-d"));
											$diff=date_diff($date2,$date1);
											
											if($value->expiring_date === "0000-00-00")
											{
												$cat = "Countless";
											}else{
												$cat = $diff->format("%R%a days");
											}
                          			 ?>
                          			<tr>                          				
                          				<td>{{$value->product}}</td>
                          				<td>{{$value->name_software}}</td>
                          				<td class="text-center">{{$value->version}}</td>
                          				<td class="text-center">{{$value->qty}}</td>
                          				<td>{{$value->total_price}}</td>
                          				<td>{{$value->type_software}}</td>
                          				<td>{{$value->status_software}}</td>
                          				<td class="text-center">{{date('M, d Y', strtotime($value->expiring_date))}}</td>
                          				<td>{{$cat}}</td>
                          				<td><?php if ($value->expiring_date === date('Y-m-d', strtotime("now"))): ?>
					                       Expired 
					                     <?php else: ?>
					                       End Soon   
					                     <?php endif ?>
					                    </td>
                          			</tr>	
                          			<?php endforeach ?>  
                          			<?php foreach ($getData1 as $key): ?>
                          				<?php 
                          					$date1=date_create($key->expiring_date);
											$date2=date_create(date("Y-m-d"));
											$diff=date_diff($date2,$date1);
											
											if($key->expiring_date === "0000-00-00")
											{
												$cat1 = "Countless";
											}else{
												$cat1 = $diff->format("%R%a days");
											}
                          				 ?>
                          				<tr class="danger">
                          					<td>{{$key->product}}</td>
                          					<td>{{$key->name_software}}</td>
                          					<td class="text-center">{{$key->version}}</td>
                          					<td class="text-center">{{$key->qty}}</td>
                          					<td>{{$key->total_price}}</td>
                          					<td>{{$key->type_software}}</td>
                          					<td>{{$key->status_software}}</td>
                          					<td class="text-center">{{date('M, d Y', strtotime($key->expiring_date))}}</td>
                          					<td>{{$cat1}}</td>
	                          				<td>Expired</td>
	                          				</tr>                        				
                          			<?php endforeach ?>                        			
                          		</tbody>
                          	</table>               	                            	                         	
                          	</div>                          	
                          </div>
                         </div>
                        </div>
                    </div>
                </div>
                <a href=""><center> <img width="300px" height="60px"  src="{{asset('assets/Infinite_Studios_kinema.png')}}"></center></a>
                <br>
                <a href=""><center> <img width="250px" height="60px"  src="{{asset('assets/Infinite_Studios_Logo-03.png')}}"></center></a>
                </div>

            </div>

        </div>

          @include('assets_script_1')
    </body>
</html>
<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>