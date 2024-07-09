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
    <h1 class="page-header">IT Room</h1>                   
  </div>
</div> 
<div class="row" style=" margin-bottom: 10px;">
  <div class="col-sm-12">
   <a href="{{route('loadHTMLITRoom')}}" class="btn btn-primary" target="_blank">Print</a>
 </div>
</div> 
<div class="container-fluid"><div class="scroll"> 
  <div class="btn-sm" style="width: 1800px;">   
    <div class="row">
      <!--  -->
      <div class="col-sm-6">
        <div class="well well-lg" style="width: 680px; height: 1000px;">
          <center>IT Room</center>
          <br>
          <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-3">
            <div class="panel panel-default" style="margin-top: 0px;">
              <div class="panel-heading">396</div>
              <div class="panel-body" style="height: 131px">
               <input type="text" name="" class="form-control text-center" value="{{$IT_396->user}}" readonly="true">        
               <a href="{{route('Detail3DMap', [$IT_396->id, $IT_396->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_396->id}}" title="Detail">{{$IT_396->workstation}}</a>
               <a href="{{route('Detail3DMap2', [$IT_396->id, $IT_396->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_396->id}}">{{$IT_396->secondary_workstation}}</a>            
             </div>
             <div class="panel-footer" style="height: 38px;">
              <center><a href="{{route('postDataLayout', [$IT_396->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
              </center>
            </div>
          </div>
          <div class="panel panel-default" style="margin-top: 40px;">
            <div class="panel-heading">399</div>
            <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_399->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_399->id, $IT_399->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_399->id}}" title="Detail">{{$IT_399->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_399->id, $IT_399->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_399->id}}">{{$IT_399->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_399->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
        </div>
        <div class="panel panel-default" style="margin-top: -20px;">
          <div class="panel-heading">402</div>
          <div class="panel-body" style="height: 131px">
           <input type="text" name="" class="form-control text-center" value="{{$IT_402->user}}" readonly="true">        
           <a href="{{route('Detail3DMap', [$IT_402->id, $IT_402->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_402->id}}" title="Detail">{{$IT_402->workstation}}</a>
           <a href="{{route('Detail3DMap2', [$IT_402->id, $IT_402->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_402->id}}">{{$IT_402->secondary_workstation}}</a>            
         </div>
         <div class="panel-footer" style="height: 38px;">
          <center><a href="{{route('postDataLayout', [$IT_402->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
          </center>
        </div>
      </div>
      <div class="panel panel-default" style="margin-top: 30px;">
        <div class="panel-heading">405</div>
        <div class="panel-body" style="height: 131px">
         <input type="text" name="" class="form-control text-center" value="{{$IT_405->user}}" readonly="true">        
         <a href="{{route('Detail3DMap', [$IT_405->id, $IT_405->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_405->id}}" title="Detail">{{$IT_405->workstation}}</a>
         <a href="{{route('Detail3DMap2', [$IT_405->id, $IT_405->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_405->id}}">{{$IT_405->secondary_workstation}}</a>            
       </div>
       <div class="panel-footer" style="height: 38px;">
        <center><a href="{{route('postDataLayout', [$IT_405->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
        </center>
      </div>
    </div>
  </div>
  <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-3">
    <div class="panel panel-default">
      <div class="panel-heading">397</div>
      <div class="panel-body" style="height: 131px">
       <input type="text" name="" class="form-control text-center" value="{{$IT_397->user}}" readonly="true">        
       <a href="{{route('Detail3DMap', [$IT_397->id, $IT_397->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_397->id}}" title="Detail">{{$IT_397->workstation}}</a>
       <a href="{{route('Detail3DMap2', [$IT_397->id, $IT_397->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_397->id}}">{{$IT_397->secondary_workstation}}</a>            
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_397->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
  </div>
  <div class="panel panel-default" style="margin-top: 40px;">
    <div class="panel-heading">400</div>
    <div class="panel-body" style="height: 131px">
     <input type="text" name="" class="form-control text-center" value="{{$IT_400->user}}" readonly="true">        
     <a href="{{route('Detail3DMap', [$IT_400->id, $IT_400->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_400->id}}" title="Detail">{{$IT_400->workstation}}</a>
     <a href="{{route('Detail3DMap2', [$IT_400->id, $IT_400->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_400->id}}">{{$IT_400->secondary_workstation}}</a>            
   </div>
   <div class="panel-footer" style="height: 38px;">
    <center><a href="{{route('postDataLayout', [$IT_400->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
    </center>
  </div>
</div>
<div class="panel panel-default" style="margin-top: -20px;">
  <div class="panel-heading">403</div>
  <div class="panel-body" style="height: 131px">
   <input type="text" name="" class="form-control text-center" value="{{$IT_403->user}}" readonly="true">        
   <a href="{{route('Detail3DMap', [$IT_403->id, $IT_403->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_403->id}}" title="Detail">{{$IT_403->workstation}}</a>
   <a href="{{route('Detail3DMap2', [$IT_403->id, $IT_403->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_403->id}}">{{$IT_403->secondary_workstation}}</a>            
 </div>
 <div class="panel-footer" style="height: 38px;">
  <center><a href="{{route('postDataLayout', [$IT_403->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
  </center>
</div>
</div>
</div>
<div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-3">
  <div class="panel panel-default">
    <div class="panel-heading">398</div>
    <div class="panel-body" style="height: 131px">
     <input type="text" name="" class="form-control text-center" value="{{$IT_398->user}}" readonly="true">        
     <a href="{{route('Detail3DMap', [$IT_398->id, $IT_398->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_398->id}}" title="Detail">{{$IT_398->workstation}}</a>
     <a href="{{route('Detail3DMap2', [$IT_398->id, $IT_398->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_398->id}}">{{$IT_398->secondary_workstation}}</a>            
   </div>
   <div class="panel-footer" style="height: 38px;">
    <center><a href="{{route('postDataLayout', [$IT_398->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
    </center>
  </div>
</div>
<div class="panel panel-default" style="margin-top: 40px;">
  <div class="panel-heading">401</div>
  <div class="panel-body" style="height: 131px">
   <input type="text" name="" class="form-control text-center" value="{{$IT_401->user}}" readonly="true">        
   <a href="{{route('Detail3DMap', [$IT_401->id, $IT_401->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_401->id}}" title="Detail">{{$IT_401->workstation}}</a>
   <a href="{{route('Detail3DMap2', [$IT_401->id, $IT_401->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_401->id}}">{{$IT_401->secondary_workstation}}</a>            
 </div>
 <div class="panel-footer" style="height: 38px;">
  <center><a href="{{route('postDataLayout', [$IT_401->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
  </center>
</div>
</div>
<div class="panel panel-default" style="margin-top: -20px;">
  <div class="panel-heading">404</div>
  <div class="panel-body" style="height: 131px">
   <input type="text" name="" class="form-control text-center" value="{{$IT_404->user}}" readonly="true">        
   <a href="{{route('Detail3DMap', [$IT_404->id, $IT_404->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_404->id}}" title="Detail">{{$IT_404->workstation}}</a>
   <a href="{{route('Detail3DMap2', [$IT_404->id, $IT_404->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_404->id}}">{{$IT_404->secondary_workstation}}</a>            
 </div>
 <div class="panel-footer" style="height: 38px;">
  <center><a href="{{route('postDataLayout', [$IT_404->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
  </center>
</div>
</div>
</div>
<div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-3">
  <div class="panel panel-default" style="margin-top: 700px;">
    <div class="panel-heading">406</div>
    <div class="panel-body" style="height: 131px">
     <input type="text" name="" class="form-control text-center" value="{{$IT_406->user}}" readonly="true">        
     <a href="{{route('Detail3DMap', [$IT_406->id, $IT_406->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_406->id}}" title="Detail">{{$IT_406->workstation}}</a>
     <a href="{{route('Detail3DMap2', [$IT_406->id, $IT_406->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_406->id}}">{{$IT_406->secondary_workstation}}</a>            
   </div>
   <div class="panel-footer" style="height: 38px;">
    <center><a href="{{route('postDataLayout', [$IT_406->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
    </center>
  </div>
</div>
</div>
</div>
</div>
<div class="col-sm-6">
 <div class="well well-lg" style="width: 895px; height: 1000px; margin-left: -180px;">
  <center>Warehouse</center>
  <div style="width: 180px; position: relative;" class="col-sm-3">
   <div class="panel-group">
    <div class="panel panel-default" style="margin-top: 15px;">
     <div class="panel-heading">417</div>
     <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_417->id, $IT_417->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_417->id}}" title="Detail">{{$IT_417->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_417->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
  </div>
  <div class="panel panel-default" style="margin-top: 0px;">
   <div class="panel-heading">418</div>
   <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_418->id, $IT_418->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_418->id}}" title="Detail">{{$IT_418->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_418->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">419</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_419->id, $IT_419->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_419->id}}" title="Detail">{{$IT_419->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_419->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">420</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_420->id, $IT_420->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_420->id}}" title="Detail">{{$IT_420->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_420->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">421</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_421->id, $IT_421->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_421->id}}" title="Detail">{{$IT_421->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_421->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">422</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_422->id, $IT_422->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_422->id}}" title="Detail">{{$IT_422->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_422->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
</div>
</div>
<div style="width: 180px; position: relative;" class="col-sm-3">
 <div class="panel-group">
  <div class="panel panel-default" style="margin-top: 15px;">
   <div class="panel-heading">423</div>
   <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_423->id, $IT_423->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_423->id}}" title="Detail">{{$IT_423->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_423->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">424</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_424->id, $IT_424->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_424->id}}" title="Detail">{{$IT_424->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_424->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">425</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_425->id, $IT_425->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_425->id}}" title="Detail">{{$IT_425->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_425->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">426</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_426->id, $IT_426->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_426->id}}" title="Detail">{{$IT_426->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_426->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">427</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_427->id, $IT_427->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_427->id}}" title="Detail">{{$IT_427->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_427->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">428</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_428->id, $IT_428->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_428->id}}" title="Detail">{{$IT_428->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_428->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
</div>
</div>
<div style="width: 180px; position: relative;" class="col-sm-3">
 <div class="panel-group">
  <div class="panel panel-default" style="margin-top: 15px;">
   <div class="panel-heading">429</div>
   <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_429->id, $IT_429->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_429->id}}" title="Detail">{{$IT_429->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_429->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">430</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_430->id, $IT_430->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_430->id}}" title="Detail">{{$IT_430->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_430->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">431</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_431->id, $IT_431->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_431->id}}" title="Detail">{{$IT_431->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_431->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">432</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_432->id, $IT_432->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_432->id}}" title="Detail">{{$IT_432->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_432->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">433</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_433->id, $IT_433->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_433->id}}" title="Detail">{{$IT_433->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_433->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">434</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_434->id, $IT_434->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_434->id}}" title="Detail">{{$IT_434->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_434->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
</div>
</div>
<div style="width: 180px; position: relative;" class="col-sm-3">
   <div class="panel-group">
    <div class="panel panel-default" style="margin-top: 15px;">
     <div class="panel-heading">435</div>
     <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_417->id, $IT_417->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_417->id}}" title="Detail">{{$IT_417->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_417->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
  </div>
  <div class="panel panel-default" style="margin-top: 0px;">
   <div class="panel-heading">436</div>
   <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_418->id, $IT_418->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_418->id}}" title="Detail">{{$IT_418->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_418->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
 <div class="panel-heading">437</div>
 <div class="panel-body" style="height: 65px">       
       <a href="{{route('Detail3DMap', [$IT_419->id, $IT_419->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_419->id}}" title="Detail">{{$IT_419->workstation}}</a>          
     </div>
     <div class="panel-footer" style="height: 38px;">
      <center><a href="{{route('postDataLayout', [$IT_419->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
      </center>
    </div>
</div>

</div>
</div>
</div>
</div>
<div class="row">
 <div class="col-sm-12" style="width: 180px; position: relative; margin-left: 15px;">
  <div class="well well-lg" style="width: 780px; height: 770px;">
   <center>Server Room</center>
   <br>
   <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-3">
    <div class="panel panel-default">
      <div class="panel-heading">407</div>
      <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_407->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_407->id, $IT_407->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_407->id}}" title="Detail">{{$IT_407->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_407->id, $IT_407->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_407->id}}">{{$IT_407->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_407->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
   </div>
   <div class="panel panel-default" style="margin-top: 0px;">
    <div class="panel-heading">411</div>
    <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_411->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_411->id, $IT_411->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_411->id}}" title="Detail">{{$IT_411->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_411->id, $IT_411->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_411->id}}">{{$IT_411->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_411->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
  </div>
  <div class="panel panel-default" style="margin-top: 0px;">
    <div class="panel-heading">415</div>
    <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_415->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_415->id, $IT_415->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_415->id}}" title="Detail">{{$IT_415->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_415->id, $IT_415->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_415->id}}">{{$IT_415->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_415->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
  </div>
</div>
<div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-3">
  <div class="panel panel-default">
    <div class="panel-heading">408</div>
    <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_408->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_408->id, $IT_408->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_408->id}}" title="Detail">{{$IT_408->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_408->id, $IT_408->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_408->id}}">{{$IT_408->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_408->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
 </div>
 <div class="panel panel-default" style="margin-top: 0px;">
  <div class="panel-heading">412</div>
  <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_412->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_412->id, $IT_412->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_412->id}}" title="Detail">{{$IT_412->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_412->id, $IT_412->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_412->id}}">{{$IT_412->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_412->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
</div>
<div class="panel panel-default" style="margin-top: 0px;">
  <div class="panel-heading">416</div>
  <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_416->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_416->id, $IT_416->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_416->id}}" title="Detail">{{$IT_416->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_416->id, $IT_416->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_416->id}}">{{$IT_416->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_416->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
</div>
</div>
<div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-3">
  <div class="panel panel-default">
    <div class="panel-heading">409</div>
    <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_409->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_409->id, $IT_409->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_409->id}}" title="Detail">{{$IT_409->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_409->id, $IT_409->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_409->id}}">{{$IT_409->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_409->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
 </div>
 <div class="panel panel-default" style="margin-top: 0px;">
  <div class="panel-heading">413</div>
  <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_413->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_413->id, $IT_413->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_413->id}}" title="Detail">{{$IT_413->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_413->id, $IT_413->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_413->id}}">{{$IT_413->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_413->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
</div>

</div>
<div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-3">
  <div class="panel panel-default">
    <div class="panel-heading">410</div>
    <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_410->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_410->id, $IT_410->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_410->id}}" title="Detail">{{$IT_410->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_410->id, $IT_410->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_410->id}}">{{$IT_410->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_410->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
            </center>
          </div>
 </div>
 <div class="panel panel-default" style="margin-top: 0px;">
  <div class="panel-heading">414</div>
  <div class="panel-body" style="height: 131px">
             <input type="text" name="" class="form-control text-center" value="{{$IT_414->user}}" readonly="true">        
             <a href="{{route('Detail3DMap', [$IT_414->id, $IT_414->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$IT_414->id}}" title="Detail">{{$IT_414->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$IT_414->id, $IT_414->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$IT_414->id}}">{{$IT_414->secondary_workstation}}</a>            
           </div>
           <div class="panel-footer" style="height: 38px;">
            <center><a href="{{route('postDataLayout', [$IT_414->id])}}" class="btn btn-sm btn-danger" style="color: black; margin-top: -5px; color: white;">Edit</a>
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
@stop
@section('bottom')
@include('assets_script_1')
@include('assets_script_2')
@include('assets_script_7')
@stop