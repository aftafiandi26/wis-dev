@extends('layout')

@section('title')
WS MAP
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c2' => 'active'
])
@stop
<style>
  .scroll{
    width: auto; 
    padding: 0px;
    overflow-x: scroll;
    height: 680px;
  }
</style>
@section('body')

<div class="row">
  <div class="col-sm-12">
    <h1 class="page-header">Officer</h1>                   
  </div>
</div> 
<div class="row" style=" margin-bottom: 10px;">
  <div class="col-sm-12">
   <a href="{{route('loadHTMLOfficer')}}" class="btn btn-warning" target="_blank">Print</a>
 </div>
</div> 
<div class="container-fluid"><div class="scroll"> 
  <div class="btn-sm" style="width: 1800px;">   
    <div class="row">
      <!--  -->
      <div class="col-sm-4">
        <div class="well well-lg" style="width: 600px;">
          <center>HR Room</center>
          <br>
          <div class="well well-lg" style="background: white; height: 1090px;">
            <div class="row">
              <div class="well well-l col-sm-6"  style="height: 300px;">
                <center>Manager Room</center>
                <div style="width: 180px; margin-left: 20px; position: relative;">
                 <div class="panel panel-default">
                  <div class="panel-heading">380</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Officer_380->user}}" readonly="true">        
                    <a href="{{route('DetailMobileMap', [$Officer_380->id, $Officer_380->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_380->id}}" title="Detail">{{$Officer_380->workstation}}</a>
                    <a href="{{route('Detail3DMap2', [$Officer_380->id, $Officer_380->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_380->id}}">{{$Officer_380->secondary_workstation}}</a>              
                  </div>
                  <div class="panel-footer" style="height: 38px;">
                    <center><a href="{{route('postDataOfficerMobileMap', [$Officer_380->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
                    </center>
                  </div>         
                </div>
              </div>
            </div>
            <div class="well well-l col-sm-6" style="height: 300px;">
              <p style="margin-top: 70px;"><center>Bunker</center></p>
            </div>
          </div>
          <div class="row">
            <div class="well well-lg col-sm-3"  style="height: 200px;">
             <p style="margin-top: 70px;"><center>Panel Room</center></p>
           </div>
         </div> 
         <div class="row">
          <div class="well well-lg col-sm-12"  style="height: 500px;">
           <center>HR Staff Room</center>
           <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
             <div class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">381</div>
                <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$Officer_381->user}}" readonly="true">
                 <a href="{{route('Detail3DMap',  [$Officer_381->id, $Officer_381->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_381->id}}">{{$Officer_381->workstation}}</a>                
                 <a href="{{route('Detail3DMap2', [$Officer_381->id, $Officer_381->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_381->id}}">{{$Officer_381->secondary_workstation}}</a>
               </div>
               <div class="panel-footer" style="height: 38px;">
                 <center><a href="{{route('postDataOfficerMap', [$Officer_381->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
                 </center>
               </div>
             </div>
             <div class="panel panel-default">
              <div class="panel-heading">382</div>
              <div class="panel-body" style="height: 131px">
               <input type="text" name="" class="form-control text-center" value="{{$Officer_383->user}}" readonly="true">
               <a href="{{route('DetailMobileMap',  [$Officer_383->id, $Officer_383->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_383->id}}">{{$Officer_383->workstation}}</a>                
               <a href="{{route('Detail3DMap2', [$Officer_383->id, $Officer_383->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_383->id}}">{{$Officer_383->secondary_workstation}}</a>
             </div>
             <div class="panel-footer" style="height: 38px;">
               <center><a href="{{route('postDataOfficerMobileMap', [$Officer_383->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
               </center>
             </div>
           </div>
         </div>
       </div>
       <div style="width: 180px; margin-left: 0px; margin-top: 215px; position: relative;" class="col-sm-1">
         <div class="panel-group">                        
           <div class="panel panel-default">
            <div class="panel-heading">383</div>
            <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$Officer_384->user}}" readonly="true">
             <a href="{{route('Detail3DMap',  [$Officer_384->id, $Officer_384->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_384->id}}">{{$Officer_384->workstation}}</a>                
             <a href="{{route('Detail3DMap2', [$Officer_384->id, $Officer_384->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_384->id}}">{{$Officer_384->secondary_workstation}}</a>
           </div>
           <div class="panel-footer" style="height: 38px;">
             <center><a href="{{route('postDataOfficerMap', [$Officer_384->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
             </center>
           </div>
         </div>
       </div>
       <div style="width: 180px; margin-left: 135px; margin-top: -230px; position: relative;" class="col-sm-1">
         <div class="panel-group"> 
          <div class="panel panel-default">
            <div class="panel-heading">384</div>
            <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$Officer_382->user}}" readonly="true">
             <a href="{{route('Detail3DMap',  [$Officer_382->id, $Officer_382->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_382->id}}">{{$Officer_382->workstation}}</a>                
             <a href="{{route('Detail3DMap2', [$Officer_382->id, $Officer_382->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_382->id}}">{{$Officer_382->secondary_workstation}}</a>
           </div>
           <div class="panel-footer" style="height: 38px;">
             <center><a href="{{route('postDataOfficerMap', [$Officer_382->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
             </center>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>

</div>
</div>
</div>
<div class="col-sm-4">
  <div class="well well-lg" style="width: 480px; margin-left: 30px">       
    <br>
    <div class="well well-lg" style="background: white; height: 1525px;">
      <div class="row">
        <div class="well well-l col-sm-6"  style="height: 265px; width: 410px;">
          <center>Client Room</center>
          <div style="width: 180px; margin-left: 90px; position: relative;">
           <div class="panel panel-default">
            <div class="panel-heading">385</div>
            <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$Officer_385->user}}" readonly="true">
             <a href="{{route('Detail3DMap',  [$Officer_385->id, $Officer_385->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_385->id}}">{{$Officer_385->workstation}}</a>                
             <a href="{{route('Detail3DMap2', [$Officer_385->id, $Officer_385->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_385->id}}">{{$Officer_385->secondary_workstation}}</a>
           </div>
           <div class="panel-footer" style="height: 38px;">
             <center><a href="{{route('postDataOfficerMap', [$Officer_385->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
             </center>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="row">
    <div class="well well-lg col-sm-6"  style="height: 265px; width: 410px;">
     <center>Finance Manager Room</center>
     <div style="width: 180px; margin-left: 90px; position: relative;">
      <div class="panel panel-default">
        <div class="panel-heading">386</div>
        <div class="panel-body" style="height: 131px">
         <input type="text" name="" class="form-control text-center" value="{{$Officer_386->user}}" readonly="true">
         <a href="{{route('DetailMobileMap',  [$Officer_386->id, $Officer_386->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_386->id}}">{{$Officer_386->workstation}}</a>                
         <a href="{{route('Detail3DMap2', [$Officer_386->id, $Officer_386->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_386->id}}">{{$Officer_386->secondary_workstation}}</a>
       </div>
       <div class="panel-footer" style="height: 38px;">
         <center><a href="{{route('postDataOfficerMobileMap', [$Officer_386->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
         </center>
       </div>
     </div>
   </div>
 </div>
</div> 
<div class="row">
  <div class="well well-lg col-sm-12"  style="height: 910px;">
   <center>Finance Staff Room</center>
   <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
     <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading">387</div>
        <div class="panel-body" style="height: 131px">
         <input type="text" name="" class="form-control text-center" value="{{$Officer_387->user}}" readonly="true">
         <a href="{{route('Detail3DMap',  [$Officer_387->id, $Officer_387->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_387->id}}">{{$Officer_387->workstation}}</a>                
         <a href="{{route('Detail3DMap2', [$Officer_387->id, $Officer_387->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_387->id}}">{{$Officer_387->secondary_workstation}}</a>
       </div>
       <div class="panel-footer" style="height: 38px;">
         <center><a href="{{route('postDataOfficerMap', [$Officer_387->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
         </center>
       </div>
     </div>
   </div>
 </div>
 <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">388</div>
      <div class="panel-body" style="height: 131px">
       <input type="text" name="" class="form-control text-center" value="{{$Officer_388->user}}" readonly="true">
       <a href="{{route('Detail3DMap',  [$Officer_388->id, $Officer_388->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_388->id}}">{{$Officer_388->workstation}}</a>                
       <a href="{{route('Detail3DMap2', [$Officer_388->id, $Officer_388->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_388->id}}">{{$Officer_388->secondary_workstation}}</a>
     </div>
     <div class="panel-footer" style="height: 38px;">
       <center><a href="{{route('postDataOfficerMap', [$Officer_388->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
       </center>
     </div>
   </div>
   <div class="panel panel-default">
    <div class="panel-heading">389</div>
    <div class="panel-body" style="height: 131px">
     <input type="text" name="" class="form-control text-center" value="{{$Officer_389->user}}" readonly="true">
     <a href="{{route('Detail3DMap',  [$Officer_389->id, $Officer_389->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_389->id}}">{{$Officer_389->workstation}}</a>                
     <a href="{{route('Detail3DMap2', [$Officer_389->id, $Officer_389->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_389->id}}">{{$Officer_389->secondary_workstation}}</a>
   </div>
   <div class="panel-footer" style="height: 38px;">
     <center><a href="{{route('postDataOfficerMap', [$Officer_389->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
     </center>
   </div>
 </div>
 <div class="panel panel-default">
  <div class="panel-heading">390</div>
  <div class="panel-body" style="height: 131px">
   <input type="text" name="" class="form-control text-center" value="{{$Officer_390->user}}" readonly="true">
   <a href="{{route('Detail3DMap',  [$Officer_390->id, $Officer_390->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_390->id}}">{{$Officer_390->workstation}}</a>                
   <a href="{{route('Detail3DMap2', [$Officer_390->id, $Officer_390->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_390->id}}">{{$Officer_390->secondary_workstation}}</a>
 </div>
 <div class="panel-footer" style="height: 38px;">
   <center><a href="{{route('postDataOfficerMap', [$Officer_390->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
   </center>
 </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">391</div>
  <div class="panel-body" style="height: 131px">
   <input type="text" name="" class="form-control text-center" value="{{$Officer_391->user}}" readonly="true">
   <a href="{{route('Detail3DMap',  [$Officer_391->id, $Officer_391->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_391->id}}">{{$Officer_391->workstation}}</a>                
   <a href="{{route('Detail3DMap2', [$Officer_391->id, $Officer_391->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_391->id}}">{{$Officer_391->secondary_workstation}}</a>
 </div>
 <div class="panel-footer" style="height: 38px;">
   <center><a href="{{route('postDataOfficerMap', [$Officer_391->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
   </center>
 </div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
<div class="col-sm-4">
  <div class="well well-lg" style="width: 380px; margin-left: -60px">
   
    <div class="well well-lg" style="background: white; height: 1176px;">
      <div class="row">
        <div class="well well-l col-sm-12"  style="height: 265px;">
          <center>Client Room</center>
          <div style="width: 180px; margin-left: 45px; position: relative;">
           <div class="panel panel-default">
            <div class="panel-heading">392</div>
            <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$Officer_392->user}}" readonly="true">
             <a href="{{route('Detail3DMap',  [$Officer_392->id, $Officer_392->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_392->id}}">{{$Officer_392->workstation}}</a>                
             <a href="{{route('Detail3DMap2', [$Officer_392->id, $Officer_392->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_392->id}}">{{$Officer_392->secondary_workstation}}</a>
           </div>
           <div class="panel-footer" style="height: 38px;">
             <center><a href="{{route('postDataOfficerMap', [$Officer_392->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
             </center>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="row">
    <div class="well well-lg col-sm-12"  style="height: 265px;">
     <center>Head Production Room</center>
     <div style="width: 180px; margin-left: 45px; position: relative;">
       <div class="panel panel-default">
        <div class="panel-heading">393</div>
        <div class="panel-body" style="height: 131px">
         <input type="text" name="" class="form-control text-center" value="{{$Officer_393->user}}" readonly="true">
         <a href="{{route('Detail3DMap',  [$Officer_393->id, $Officer_393->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_393->id}}">{{$Officer_393->workstation}}</a>                
         <a href="{{route('DetailMobileMap2', [$Officer_393->id, $Officer_393->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_393->id}}">{{$Officer_393->secondary_workstation}}</a>
       </div>
       <div class="panel-footer" style="height: 38px;">
         <center><a href="{{route('postDataOfficerMobileMap', [$Officer_393->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
         </center>
       </div>
     </div>
   </div>
 </div>
</div> 
<div class="row">
  <div class="well well-lg col-sm-12"  style="height: 265px;">
   <center>Pipeline Room</center>
   <div style="width: 180px; margin-left: 45px; position: relative;">
     <div class="panel panel-default">
      <div class="panel-heading">394</div>
      <div class="panel-body" style="height: 131px">
       <input type="text" name="" class="form-control text-center" value="{{$Officer_394->user}}" readonly="true">
       <a href="{{route('Detail3DMap',  [$Officer_394->id, $Officer_394->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_394->id}}">{{$Officer_394->workstation}}</a>                
       <a href="{{route('Detail3DMap2', [$Officer_394->id, $Officer_394->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_394->id}}">{{$Officer_394->secondary_workstation}}</a>
     </div>
     <div class="panel-footer" style="height: 38px;">
       <center><a href="{{route('postDataOfficerMap', [$Officer_394->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
       </center>
     </div>
   </div>
 </div>
</div>
</div>
<div class="row">
  <div class="well well-lg col-sm-12"  style="height: 265px;">
   <center>GM Room</center>
   <div style="width: 180px; margin-left: 45px; position: relative;">
     <div class="panel panel-default">
      <div class="panel-heading">395</div>
      <div class="panel-body" style="height: 131px">
       <input type="text" name="" class="form-control text-center" value="{{$Officer_395->user}}" readonly="true">
       <a href="{{route('Detail3DMap',  [$Officer_395->id, $Officer_395->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Officer_395->id}}">{{$Officer_395->workstation}}</a>                
       <a href="{{route('Detail3DMap2', [$Officer_395->id, $Officer_395->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Officer_395->id}}">{{$Officer_395->secondary_workstation}}</a>
     </div>
     <div class="panel-footer" style="height: 38px;">
       <center><a href="{{route('postDataOfficerMap', [$Officer_395->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
       </center>
     </div>
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>
<!--  -->
</div>
</div>
</div>
</div>


<?php foreach ($animasii as $kartun): ?>
  <div class="modal fade" id="showModal{{$kartun->id}}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="modal-content">
        <!--  -->
      </div>
    </div>
  </div>  
  <div class="modal fade" id="showModal2{{$kartun->id}}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="modal-content">
        <!--  -->
      </div>
    </div>
  </div>
<?php endforeach ?>


@stop
@section('bottom')
@include('assets_script_1')
@include('assets_script_2')
@include('assets_script_7')
@stop