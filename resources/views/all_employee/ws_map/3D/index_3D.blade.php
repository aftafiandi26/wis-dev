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
.text-center {
  text-align: center;
}
</style>
@section('body')
<div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">3D Animation</h1>                   
        </div>
    </div> 
<div class="row" style=" margin-bottom: 10px;">
        <div class="col-sm-12">
          <a href="{{route('PDF-3D-Animation')}}" class="btn btn-warning btn-sm" target="_blank">PDF</a> 
        </div>
    </div> 
<div class="container-fluid"><div class="scroll"> 
<div class="btn-sm" style="width: 3500px;">   
    <div class="row">

        <!-- Page 1 -->
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">1</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_1->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$anim_1->id, $anim_1->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_1->id}}" title="Detail">{{$anim_1->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$anim_1->id, $anim_1->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_1->id}}">{{$anim_1->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">               
              </div>              
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">2</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_2->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_2->id, $anim_2->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_2->id}}">{{$anim_2->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_2->id, $anim_2->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_2->id}}">{{$anim_2->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">              
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">3</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_3->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_3->id, $anim_3->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_3->id}}">{{$anim_3->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_3->id, $anim_3->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_3->id}}">{{$anim_3->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                            
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">4</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_4->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_4->id, $anim_4->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_4->id}}">{{$anim_4->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_4->id, $anim_4->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_4->id}}">{{$anim_4->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                       
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">5</div>
               <div class="panel-body" style="height: 131px">
                   <input type="text" name="" class="form-control text-center" value="{{$anim_5->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_5->id, $anim_5->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_5->id}}">{{$anim_5->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_5->id, $anim_5->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_5->id}}">{{$anim_5->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                       
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">6</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_6->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_6->id, $anim_6->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_6->id}}">{{$anim_6->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_6->id, $anim_6->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_6->id}}">{{$anim_6->secondary_workstation}}</a>
              </div>  
             <div class="panel-footer" style="height: 38px;">                           
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">7</div>
              <div class="panel-body" style="height: 131px">
                   <input type="text" name="" class="form-control text-center" value="{{$anim_7->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_7->id, $anim_7->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_7->id}}">{{$anim_7->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_7->id, $anim_7->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_7->id}}">{{$anim_7->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                            
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">8</div>
               <div class="panel-body" style="height: 131px">
                   <input type="text" name="" class="form-control text-center" value="{{$anim_8->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_8->id, $anim_8->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_8->id}}">{{$anim_8->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_8->id, $anim_8->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_8->id}}">{{$anim_8->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 1 -->
    <!-- Page 2 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">9</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_9->user}}" readonly="true">
                 <a href="{{route('Detail3DMap', [$anim_9->id, $anim_9->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_9->id}}">{{$anim_9->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_9->id, $anim_9->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_9->id}}">{{$anim_9->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                        
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">10</div>
               <div class="panel-body" style="height: 131px">
                   <input type="text" name="" class="form-control text-center" value="{{$anim_10->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_10->id, $anim_10->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_10->id}}">{{$anim_10->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_10->id, $anim_10->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_10->id}}">{{$anim_10->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                         
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">11</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_11->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_11->id, $anim_11->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_11->id}}">{{$anim_11->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_11->id, $anim_11->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_11->id}}">{{$anim_11->secondary_workstation}}</a>
              </div>  
             <div class="panel-footer" style="height: 38px;">                          
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">12</div>
              <div class="panel-body" style="height: 131px">
                <input type="text" name="" class="form-control text-center" value="{{$anim_12->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_12->id, $anim_12->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_12->id}}">{{$anim_12->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_12->id, $anim_12->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_12->id}}">{{$anim_12->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                         
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">13</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_13->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_13->id, $anim_13->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_13->id}}">{{$anim_13->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_13->id, $anim_13->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_13->id}}">{{$anim_13->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                          
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">14</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_14->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_14->id, $anim_14->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_14->id}}">{{$anim_14->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_14->id, $anim_14->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_14->id}}">{{$anim_14->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                          
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">15</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_15->user}}" readonly="true">
                   <a href="{{route('Detail3DMap', [$anim_15->id, $anim_15->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_15->id}}">{{$anim_15->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_15->id, $anim_15->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_15->id}}">{{$anim_15->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                     
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">16</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_16->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_16->id, $anim_16->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_15->id}}">{{$anim_16->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_16->id, $anim_16->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_16->id}}">{{$anim_16->secondary_workstation}}</a>
              </div>
              </div>
             <div class="panel-footer" style="height: 38px;">                   
              </div>
            </div>            
        </div>

    <!-- Page 2 -->

    <!-- Page 3  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">17</div>
              <div class="panel-body" style="height: 131px">
                   <input type="text" name="" class="form-control text-center" value="{{$anim_17->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_17->id, $anim_17->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_17->id}}">{{$anim_17->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_17->id, $anim_17->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_17->id}}">{{$anim_17->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                    
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">18</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_18->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_18->id, $anim_18->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_18->id}}">{{$anim_18->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_18->id, $anim_18->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_18->id}}">{{$anim_18->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">                         
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">19</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_19->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_19->id, $anim_19->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_19->id}}">{{$anim_19->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_19->id, $anim_19->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_19->id}}">{{$anim_19->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">20</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_20->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_20->id, $anim_20->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_20->id}}">{{$anim_20->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_20->id, $anim_20->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_20->id}}">{{$anim_20->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">21</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_21->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_21->id, $anim_21->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_21->id}}">{{$anim_21->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_21->id, $anim_21->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_21->id}}">{{$anim_21->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">22</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_22->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_22->id, $anim_22->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_22->id}}">{{$anim_22->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_22->id, $anim_22->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_22->id}}">{{$anim_22->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">23</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_23->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_23->id, $anim_23->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_23->id}}">{{$anim_23->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_23->id, $anim_23->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_23->id}}">{{$anim_23->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">24</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_24->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_24->id, $anim_24->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_24->id}}">{{$anim_24->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_24->id, $anim_24->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_24->id}}">{{$anim_24->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 3 -->
    <!-- Page 4 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">25</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_25->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_25->id, $anim_25->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_25->id}}">{{$anim_25->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_25->id, $anim_25->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_25->id}}">{{$anim_25->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">26</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_26->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_26->id, $anim_26->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_26->id}}">{{$anim_26->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_26->id, $anim_26->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_26->id}}">{{$anim_26->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">27</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_27->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_27->id, $anim_27->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_27->id}}">{{$anim_27->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_27->id, $anim_27->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_27->id}}">{{$anim_27->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">28</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_28->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_28->id, $anim_28->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_28->id}}">{{$anim_28->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_28->id, $anim_28->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_28->id}}">{{$anim_28->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">29</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_29->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_29->id, $anim_29->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_29->id}}">{{$anim_29->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_29->id, $anim_29->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_29->id}}">{{$anim_29->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">30</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_30->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_30->id, $anim_30->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_30->id}}">{{$anim_30->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_30->id, $anim_30->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_30->id}}">{{$anim_30->secondary_workstation}}</a>
              </div> 
             <div class="panel-footer" style="height: 38px;">
              </div>          
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">31</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_31->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_31->id, $anim_31->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_31->id}}">{{$anim_31->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_31->id, $anim_31->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_31->id}}">{{$anim_31->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">32</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_32->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_32->id, $anim_32->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_32->id}}">{{$anim_32->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_32->id, $anim_32->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_32->id}}">{{$anim_32->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 4 -->

     <!-- Page 5  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">33</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_33->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_33->id, $anim_33->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_33->id}}">{{$anim_33->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_33->id, $anim_33->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_33->id}}">{{$anim_33->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">34</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_34->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_34->id, $anim_34->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_34->id}}">{{$anim_34->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_34->id, $anim_34->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_34->id}}">{{$anim_34->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">35</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_35->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_35->id, $anim_35->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_35->id}}">{{$anim_35->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_35->id, $anim_35->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_35->id}}">{{$anim_35->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">36</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_36->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_36->id, $anim_36->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_36->id}}">{{$anim_36->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_36->id, $anim_36->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_36->id}}">{{$anim_36->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">37</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_37->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_37->id, $anim_37->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_37->id}}">{{$anim_37->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_37->id, $anim_37->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_37->id}}">{{$anim_37->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">38</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_38->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_38->id, $anim_38->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_38->id}}">{{$anim_38->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_38->id, $anim_38->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_38->id}}">{{$anim_38->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">39</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_39->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_39->id, $anim_39->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_39->id}}">{{$anim_39->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_39->id, $anim_39->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_39->id}}">{{$anim_39->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">40</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_40->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_40->id, $anim_40->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_40->id}}">{{$anim_40->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_40->id, $anim_40->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_40->id}}">{{$anim_40->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 5 -->
    <!-- Page 6 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">41</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_41->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_41->id, $anim_41->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_41->id}}">{{$anim_41->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_41->id, $anim_41->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_41->id}}">{{$anim_41->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">42</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_42->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_42->id, $anim_42->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_42->id}}">{{$anim_42->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_42->id, $anim_42->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_42->id}}">{{$anim_42->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">43</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_43->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_43->id, $anim_43->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_43->id}}">{{$anim_43->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_43->id, $anim_43->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_43->id}}">{{$anim_43->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>       
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">44</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_44->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_44->id, $anim_44->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_44->id}}">{{$anim_44->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_44->id, $anim_44->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_44->id}}">{{$anim_44->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">45</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_45->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_45->id, $anim_45->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_45->id}}">{{$anim_45->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_45->id, $anim_45->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_45->id}}">{{$anim_45->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">46</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_46->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_46->id, $anim_46->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_46->id}}">{{$anim_46->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_46->id, $anim_46->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_46->id}}">{{$anim_46->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>      
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">47</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_47->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_47->id, $anim_47->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_47->id}}">{{$anim_47->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_47->id, $anim_47->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_47->id}}">{{$anim_47->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">48</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_48->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_48->id, $anim_48->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_48->id}}">{{$anim_48->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_48->id, $anim_48->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_48->id}}">{{$anim_48->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 6 -->

    <!-- Page 7  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 130px;">
              <div class="panel-heading">156</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_156->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_156->id, $anim_156->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_156->id}}">{{$anim_156->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_156->id, $anim_156->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_156->id}}">{{$anim_156->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>           
            <div class="panel panel-default" style="margin-top: 87px;">
              <div class="panel-heading">49</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_49->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_49->id, $anim_49->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_49->id}}">{{$anim_49->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_49->id, $anim_49->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_49->id}}">{{$anim_49->secondary_workstation}}</a>
              </div> 
             <div class="panel-footer" style="height: 38px;">
              </div>          
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">50</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_50->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_50->id, $anim_50->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_50->id}}">{{$anim_50->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_50->id, $anim_50->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_50->id}}">{{$anim_50->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">51</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_51->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_51->id, $anim_51->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_51->id}}">{{$anim_51->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_51->id, $anim_51->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_51->id}}">{{$anim_51->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">52</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_52->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_52->id, $anim_52->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_52->id}}">{{$anim_52->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_52->id, $anim_52->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_52->id}}">{{$anim_52->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">53</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_53->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_53->id, $anim_53->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_53->id}}">{{$anim_53->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_53->id, $anim_53->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_53->id}}">{{$anim_53->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">54</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_54->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_54->id, $anim_54->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_54->id}}">{{$anim_54->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_54->id, $anim_54->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_54->id}}">{{$anim_54->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 7 -->
    <!-- Page 8  -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 130px;">
              <div class="panel-heading">157</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_157->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_157->id, $anim_157->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_157->id}}">{{$anim_157->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_157->id, $anim_157->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_157->id}}">{{$anim_157->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>           
            <div class="panel panel-default" style="margin-top: 87px;">
              <div class="panel-heading">55</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_55->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_55->id, $anim_55->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_55->id}}">{{$anim_55->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_55->id, $anim_55->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_55->id}}">{{$anim_55->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">56</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_56->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_56->id, $anim_56->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_56->id}}">{{$anim_56->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_56->id, $anim_56->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_56->id}}">{{$anim_56->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">57</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_57->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_57->id, $anim_57->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_57->id}}">{{$anim_57->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_57->id, $anim_57->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_57->id}}">{{$anim_57->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">58</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_58->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_58->id, $anim_58->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_58->id}}">{{$anim_58->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_58->id, $anim_58->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_58->id}}">{{$anim_58->secondary_workstation}}</a>
              </div> 
             <div class="panel-footer" style="height: 38px;">
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">59</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_59->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_59->id, $anim_59->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_59->id}}">{{$anim_59->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_59->id, $anim_59->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_59->id}}">{{$anim_59->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">60</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_60->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_60->id, $anim_60->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_60->id}}">{{$anim_60->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_60->id, $anim_60->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_60->id}}">{{$anim_60->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 8 -->

    <!-- Page 9  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 130px;">
              <div class="panel-heading">158</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_158->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_158->id, $anim_158->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_158->id}}">{{$anim_158->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_158->id, $anim_158->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_158->id}}">{{$anim_158->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>           
            <div class="panel panel-default" style="margin-top: 87px;">
              <div class="panel-heading">61</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_61->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_61->id, $anim_61->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_61->id}}">{{$anim_61->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_61->id, $anim_61->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_61->id}}">{{$anim_61->secondary_workstation}}</a>
              </div> 
             <div class="panel-footer" style="height: 38px;">
              </div>          
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">62</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_62->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_62->id, $anim_62->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_62->id}}">{{$anim_62->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_62->id, $anim_62->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_62->id}}">{{$anim_62->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">63</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_63->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_63->id, $anim_63->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_63->id}}">{{$anim_63->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_63->id, $anim_63->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_63->id}}">{{$anim_63->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">64</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_64->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_64->id, $anim_64->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_64->id}}">{{$anim_64->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_64->id, $anim_64->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_64->id}}">{{$anim_64->secondary_workstation}}</a>
                </div>
             <div class="panel-footer" style="height: 38px;">
              </div>       
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">65</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_65->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_65->id, $anim_65->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_65->id}}">{{$anim_65->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_65->id, $anim_65->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_65->id}}">{{$anim_65->secondary_workstation}}</a>
              </div>            
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">66</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_66->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_66->id, $anim_66->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_66->id}}">{{$anim_66->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_66->id, $anim_66->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_66->id}}">{{$anim_66->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 9 -->
    <!-- Page 10  -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 130px;">
              <div class="panel-heading">159</div>
              <div class="panel-body" style="height: 131px">
                <input type="text" name="" class="form-control text-center" value="{{$anim_159->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_159->id, $anim_159->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_159->id}}">{{$anim_159->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_159->id, $anim_159->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_159->id}}">{{$anim_159->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>           
            <div class="panel panel-default" style="margin-top: 87px;">
              <div class="panel-heading">67</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_67->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_67->id, $anim_67->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_67->id}}">{{$anim_67->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_67->id, $anim_67->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_67->id}}">{{$anim_67->secondary_workstation}}</a>
              </div> 
             <div class="panel-footer" style="height: 38px;">
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">68</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_68->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_68->id, $anim_68->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_68->id}}">{{$anim_68->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_68->id, $anim_68->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_68->id}}">{{$anim_68->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">69</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_69->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_69->id, $anim_69->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_69->id}}">{{$anim_69->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_69->id, $anim_69->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_69->id}}">{{$anim_69->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">70</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_70->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_70->id, $anim_70->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_70->id}}">{{$anim_70->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_70->id, $anim_70->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_70->id}}">{{$anim_70->secondary_workstation}}</a>
              </div>  
             <div class="panel-footer" style="height: 38px;">
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">71</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_71->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_71->id, $anim_71->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_71->id}}">{{$anim_71->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_71->id, $anim_71->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_71->id}}">{{$anim_71->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">72</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_72->user}}" readonly="true">
                  <a href="{{route('Detail3DMap', [$anim_72->id, $anim_72->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_72->id}}">{{$anim_72->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_72->id, $anim_72->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_72->id}}">{{$anim_72->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 10 -->

     <!-- Page 11  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 210px;">
              <div class="panel-heading">73</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_73->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_73->id, $anim_73->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_73->id}}">{{$anim_73->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_73->id, $anim_73->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_73->id}}">{{$anim_73->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">74</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_74->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_74->id, $anim_74->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_74->id}}">{{$anim_74->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_74->id, $anim_74->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_74->id}}">{{$anim_74->secondary_workstation}}</a>
              </div> 
             <div class="panel-footer" style="height: 38px;">
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">75</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_75->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_75->id, $anim_75->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_75->id}}">{{$anim_75->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_75->id, $anim_75->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_75->id}}">{{$anim_75->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">76</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_76->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_76->id, $anim_76->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_76->id}}">{{$anim_76->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_76->id, $anim_76->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_76->id}}">{{$anim_76->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">77</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_77->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_77->id, $anim_77->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_77->id}}">{{$anim_77->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_77->id, $anim_77->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_77->id}}">{{$anim_77->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">78</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_78->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_78->id, $anim_78->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_78->id}}">{{$anim_78->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_78->id, $anim_78->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_78->id}}">{{$anim_78->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">79</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_79->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_79->id, $anim_79->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_79->id}}">{{$anim_79->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_79->id, $anim_79->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_79->id}}">{{$anim_79->secondary_workstation}}</a>        
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 11 -->
    <!-- Page 12 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default"  style="margin-top: 210px;">
              <div class="panel-heading">80</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_80->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_80->id, $anim_80->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_80->id}}">{{$anim_80->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_80->id, $anim_80->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_80->id}}">{{$anim_80->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">81</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_81->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_81->id, $anim_81->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_81->id}}">{{$anim_81->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_81->id, $anim_81->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_81->id}}">{{$anim_81->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">82</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_82->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_82->id, $anim_82->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_82->id}}">{{$anim_82->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_82->id, $anim_82->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_82->id}}">{{$anim_82->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">83</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_83->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_83->id, $anim_83->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_83->id}}">{{$anim_83->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_83->id, $anim_83->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_83->id}}">{{$anim_83->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">84</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_84->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_84->id, $anim_84->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_84->id}}">{{$anim_84->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_84->id, $anim_84->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_84->id}}">{{$anim_84->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">85</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_85->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_85->id, $anim_85->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_85->id}}">{{$anim_85->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_85->id, $anim_85->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_85->id}}">{{$anim_85->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">86</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_86->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_86->id, $anim_86->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_86->id}}">{{$anim_86->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_86->id, $anim_86->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_86->id}}">{{$anim_86->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>

    <!-- Page 12 -->
 <!-- Page 13  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 210px;">
              <div class="panel-heading">87</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_87->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_87->id, $anim_87->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_87->id}}">{{$anim_87->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_87->id, $anim_87->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_87->id}}">{{$anim_87->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">88</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_88->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_88->id, $anim_88->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_88->id}}">{{$anim_88->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_88->id, $anim_88->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_88->id}}">{{$anim_88->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">89</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_89->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_89->id, $anim_89->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_89->id}}">{{$anim_89->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_89->id, $anim_89->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_89->id}}">{{$anim_89->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">90</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_90->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_90->id, $anim_90->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_90->id}}">{{$anim_90->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_90->id, $anim_90->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_90->id}}">{{$anim_90->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">91</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_91->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_91->id, $anim_91->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_91->id}}">{{$anim_91->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_91->id, $anim_91->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_91->id}}">{{$anim_91->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">92</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_92->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_92->id, $anim_92->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_92->id}}">{{$anim_92->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_92->id, $anim_92->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_92->id}}">{{$anim_92->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">93</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_93->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_93->id, $anim_93->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_93->id}}">{{$anim_93->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_93->id, $anim_93->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_93->id}}">{{$anim_93->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 13 -->
    <!-- Page 14 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default"  style="margin-top: 210px;">
              <div class="panel-heading">94</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_94->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_94->id, $anim_94->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_94->id}}">{{$anim_94->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_94->id, $anim_94->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_94->id}}">{{$anim_94->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">95</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_95->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_95->id, $anim_95->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_95->id}}">{{$anim_95->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_95->id, $anim_95->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_95->id}}">{{$anim_95->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">96</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_96->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_96->id, $anim_96->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_96->id}}">{{$anim_96->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_96->id, $anim_96->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_96->id}}">{{$anim_96->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">97</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_97->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_97->id, $anim_97->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_97->id}}">{{$anim_97->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_97->id, $anim_97->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_97->id}}">{{$anim_97->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">98</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_98->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_98->id, $anim_98->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_98->id}}">{{$anim_98->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_98->id, $anim_98->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_98->id}}">{{$anim_98->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">99</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_99->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_99->id, $anim_99->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_99->id}}">{{$anim_99->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_99->id, $anim_99->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_99->id}}">{{$anim_99->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">100</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_100->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_100->id, $anim_100->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_100->id}}">{{$anim_100->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_100->id, $anim_100->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_100->id}}">{{$anim_100->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 14 -->

      <!-- Page 15 -->
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">101</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_101->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_101->id, $anim_101->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_101->id}}">{{$anim_101->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_101->id, $anim_101->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_101->id}}">{{$anim_101->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">102</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_102->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_102->id, $anim_102->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_102->id}}">{{$anim_102->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_102->id, $anim_102->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_102->id}}">{{$anim_102->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">103</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_103->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_103->id, $anim_103->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_103->id}}">{{$anim_103->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_103->id, $anim_103->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_103->id}}">{{$anim_103->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">104</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_104->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_104->id, $anim_104->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_104->id}}">{{$anim_104->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_104->id, $anim_103->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_104->id}}">{{$anim_104->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">105</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_105->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_105->id, $anim_105->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_105->id}}">{{$anim_105->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_105->id, $anim_105->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_105->id}}">{{$anim_105->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">106</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_106->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_106->id, $anim_106->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_106->id}}">{{$anim_106->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_106->id, $anim_106->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_106->id}}">{{$anim_106->secondary_workstation}}</a>
              </div>    
             <div class="panel-footer" style="height: 38px;">
              </div>       
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">107</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_107->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_107->id, $anim_107->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_107->id}}">{{$anim_107->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_107->id, $anim_107->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_107->id}}">{{$anim_107->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">108</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_108->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_108->id, $anim_108->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_108->id}}">{{$anim_108->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_108->id, $anim_108->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_108->id}}">{{$anim_108->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 15 -->
    <!-- Page 16 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">109</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_109->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_109->id, $anim_109->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_109->id}}">{{$anim_109->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_109->id, $anim_109->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_109->id}}">{{$anim_109->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">110</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_110->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_110->id, $anim_110->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_110->id}}">{{$anim_110->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_110->id, $anim_110->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_110->id}}">{{$anim_110->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">111</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_111->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_111->id, $anim_111->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_111->id}}">{{$anim_111->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_111->id, $anim_111->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_111->id}}">{{$anim_111->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">112</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_112->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_112->id, $anim_112->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_112->id}}">{{$anim_112->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_112->id, $anim_112->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_112->id}}">{{$anim_112->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">113</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_113->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_113->id, $anim_113->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_113->id}}">{{$anim_113->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_113->id, $anim_113->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_113->id}}">{{$anim_113->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">114</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_114->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_114->id, $anim_114->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_114->id}}">{{$anim_114->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_114->id, $anim_114->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_114->id}}">{{$anim_114->secondary_workstation}}</a>
              </div>    
             <div class="panel-footer" style="height: 38px;">
              </div>       
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">115</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_115->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_115->id, $anim_115->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_115->id}}">{{$anim_115->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_115->id, $anim_115->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_115->id}}">{{$anim_115->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">116</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_116->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_116->id, $anim_116->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_116->id}}">{{$anim_116->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_116->id, $anim_116->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_116->id}}">{{$anim_116->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 16 -->

      <!-- Page 17 -->
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">117</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_117->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_117->id, $anim_117->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_117->id}}">{{$anim_117->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_117->id, $anim_117->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_117->id}}">{{$anim_117->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">118</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_118->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_118->id, $anim_118->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_118->id}}">{{$anim_118->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_118->id, $anim_118->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_118->id}}">{{$anim_118->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">119</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_119->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_119->id, $anim_119->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_119->id}}">{{$anim_119->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_119->id, $anim_119->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_119->id}}">{{$anim_119->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">120</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_120->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_120->id, $anim_120->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_120->id}}">{{$anim_120->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_120->id, $anim_120->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_120->id}}">{{$anim_120->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">121</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_121->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_121->id, $anim_121->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_121->id}}">{{$anim_121->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_121->id, $anim_121->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_121->id}}">{{$anim_121->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">122</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_122->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_122->id, $anim_122->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_122->id}}">{{$anim_122->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_122->id, $anim_122->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_122->id}}">{{$anim_122->secondary_workstation}}</a>
              </div>  
             <div class="panel-footer" style="height: 38px;">
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">123</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_123->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_123->id, $anim_123->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_123->id}}">{{$anim_123->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_123->id, $anim_123->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_123->id}}">{{$anim_123->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">124</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_124->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_124->id, $anim_124->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_124->id}}">{{$anim_124->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_124->id, $anim_124->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_124->id}}">{{$anim_124->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 1 -->
    <!-- Page 2 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">125</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_125->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_125->id, $anim_125->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_125->id}}">{{$anim_125->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_125->id, $anim_125->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_125->id}}">{{$anim_125->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">126</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_126->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_126->id, $anim_126->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_126->id}}">{{$anim_126->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_126->id, $anim_126->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_126->id}}">{{$anim_126->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">127</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_127->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_127->id, $anim_127->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_127->id}}">{{$anim_127->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_127->id, $anim_127->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_127->id}}">{{$anim_127->secondary_workstation}}</a>
              </div>    
             <div class="panel-footer" style="height: 38px;">
              </div>       
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">128</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_128->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_128->id, $anim_128->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_128->id}}">{{$anim_128->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_128->id, $anim_128->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_128->id}}">{{$anim_128->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">129</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_129->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_129->id, $anim_129->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_129->id}}">{{$anim_129->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_129->id, $anim_129->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_129->id}}">{{$anim_129->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">130</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_130->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_130->id, $anim_130->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_130->id}}">{{$anim_130->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_130->id, $anim_130->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_130->id}}">{{$anim_130->secondary_workstation}}</a>
              </div>  
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">131</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_131->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_131->id, $anim_131->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_131->id}}">{{$anim_131->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_131->id, $anim_131->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_131->id}}">{{$anim_131->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">132</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_132->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_132->id, $anim_132->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_132->id}}">{{$anim_132->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_132->id, $anim_132->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_132->id}}">{{$anim_132->secondary_workstation}}</a>
                </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>  
    <!-- Page 18 -->

      <!-- Page 19 -->
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">133</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_133->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_133->id, $anim_133->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_133->id}}">{{$anim_133->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_133->id, $anim_133->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_133->id}}">{{$anim_133->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">134</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_134->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_134->id, $anim_134->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_134->id}}">{{$anim_134->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_134->id, $anim_134->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_134->id}}">{{$anim_134->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">135</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_135->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_135->id, $anim_135->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_135->id}}">{{$anim_135->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_135->id, $anim_135->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_135->id}}">{{$anim_135->secondary_workstation}}</a>
              </div>  
             <div class="panel-footer" style="height: 38px;">
              </div>         
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">136</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_136->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_136->id, $anim_136->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_136->id}}">{{$anim_136->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_136->id, $anim_136->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_136->id}}">{{$anim_136->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">137</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_137->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_137->id, $anim_137->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_137->id}}">{{$anim_137->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_137->id, $anim_137->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_137->id}}">{{$anim_137->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">138</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_138->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_138->id, $anim_138->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_138->id}}">{{$anim_138->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_138->id, $anim_138->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_138->id}}">{{$anim_138->secondary_workstation}}</a>
              </div>   
             <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">139</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_139->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_139->id, $anim_139->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_139->id}}">{{$anim_139->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_139->id, $anim_139->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_139->id}}">{{$anim_139->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">140</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_140->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_140->id, $anim_140->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_140->id}}">{{$anim_140->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_140->id, $anim_140->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_140->id}}">{{$anim_140->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 19 -->
    <!-- Page 20 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">141</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_141->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_141->id, $anim_141->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_141->id}}">{{$anim_141->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_141->id, $anim_141->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_141->id}}">{{$anim_141->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">142</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_142->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_142->id, $anim_142->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_142->id}}">{{$anim_142->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_142->id, $anim_142->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_142->id}}">{{$anim_142->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">143</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_143->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_143->id, $anim_143->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_143->id}}">{{$anim_143->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_143->id, $anim_143->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_143->id}}">{{$anim_143->secondary_workstation}}</a>
              </div>    
             <div class="panel-footer" style="height: 38px;">
              </div>       
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">144</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_144->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_144->id, $anim_144->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_144->id}}">{{$anim_144->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_144->id, $anim_144->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_144->id}}">{{$anim_144->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">145</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_145->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_145->id, $anim_145->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_145->id}}">{{$anim_145->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_145->id, $anim_145->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_145->id}}">{{$anim_145->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">146</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_146->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_146->id, $anim_146->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_146->id}}">{{$anim_146->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_146->id, $anim_146->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_146->id}}">{{$anim_146->secondary_workstation}}</a>
              </div>    
             <div class="panel-footer" style="height: 38px;">
              </div>       
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">147</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_147->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_147->id, $anim_147->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_147->id}}">{{$anim_147->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_147->id, $anim_147->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_147->id}}">{{$anim_147->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">148</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_148->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_148->id, $anim_148->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_148->id}}">{{$anim_148->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_148->id, $anim_148->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_148->id}}">{{$anim_148->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 20 -->


    <!-- Page 21 -->
        <div style="width: 180px; margin-top: 75px; position: relative;" class="col-sm-1">
         <div class="panel-group">           
            <div class="panel panel-default">
              <div class="panel-heading">149</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_149->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_149->id, $anim_149->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_149->id}}">{{$anim_149->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_149->id, $anim_149->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_149->id}}">{{$anim_149->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">150</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_150->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_150->id, $anim_150->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_150->id}}">{{$anim_150->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_150->id, $anim_150->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_150->id}}">{{$anim_150->secondary_workstation}}</a>
              </div>    
             <div class="panel-footer" style="height: 38px;">
              </div>       
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">151</div>
              <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_151->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_151->id, $anim_151->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_151->id}}">{{$anim_151->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_151->id, $anim_151->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_151->id}}">{{$anim_151->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">152</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_152->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_152->id, $anim_152->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_152->id}}">{{$anim_152->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_152->id, $anim_152->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_152->id}}">{{$anim_152->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">153</div>
               <div class="panel-body" style="height: 131px">
                  <input type="text" name="" class="form-control text-center" value="{{$anim_153->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_153->id, $anim_153->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_153->id}}">{{$anim_153->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_153->id, $anim_153->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_153->id}}">{{$anim_153->secondary_workstation}}</a>
              </div>    
             <div class="panel-footer" style="height: 38px;">
              </div>       
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">154</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_154->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_154->id, $anim_154->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_154->id}}">{{$anim_154->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_154->id, $anim_154->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_154->id}}">{{$anim_154->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">155</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$anim_155->user}}" readonly="true">
                  <a href="{{route('Detail3DMap',  [$anim_155->id, $anim_155->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$anim_155->id}}">{{$anim_155->workstation}}</a>                
                  <a href="{{route('Detail3DMap2', [$anim_155->id, $anim_155->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$anim_155->id}}">{{$anim_155->secondary_workstation}}</a>
              </div>
             <div class="panel-footer" style="height: 38px;">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 21 -->

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
  <script type="text/javascript"> 
        function zoomin() { 
            var GFG = document.getElementById("geeks"); 
            var currWidth = GFG.clientWidth; 
            GFG.style.width = (currWidth + 100) + "px"; 
        } 
          
        function zoomout() { 
            var GFG = document.getElementById("geeks"); 
            var currWidth = GFG.clientWidth; 
            GFG.style.width = (currWidth - 100) + "px"; 
        } 
    </script> 