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
            <h1 class="page-header">Layout</h1>                   
        </div>
    </div> 
<div class="row" style=" margin-bottom: 10px;">
        <div class="col-sm-12">
          <a href="{{route('PDF-2D-Layout')}}" class="btn btn-sm btn-warning" target="_blank">PDF</a>             
        </div>
</div>
<div class="container-fluid"><div class="scroll"> 
<div class="btn-sm" style="width: 2500px;"> 
<div class="row">
  <div class="col-sm-12">   
    <div class="col-sm-6" style="margin-left: 400px;">
      <div class="well well-lg" style="width: 750px; height: 900px;">
        <center>MEETING ROOM 2</center>
           <div style="width: 180px; margin-left: 265px; margin-top: 500px; position: relative;" class="col-sm-12">
             <div class="panel panel-default">
                  <div class="panel-heading">237</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_237->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_237->id, $layout_237->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_237->id}}" title="Detail">{{$layout_237->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_237->id, $layout_237->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_237->id}}">{{$layout_237->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">                    
                  </div>
             </div>
          </div>
      </div>
    </div>
    <div class="col-sm-1" style="margin-left: -450px;"> 
      <div class="well well-lg" style="width: 440px; height: 900px;">
        </div>
    </div>
    <div class="col-sm-4" style="margin-left: -575px;">
      <div style="width: 180px; margin-left: 600px; margin-top: 0px; position: relative;">     
      <div class="well well-lg" style="width: 750px; height: 900px;">
        <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
             <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">238</div>
                   <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_238->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_238->id, $layout_238->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_238->id}}" title="Detail">{{$layout_238->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_238->id, $layout_238->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_238->id}}">{{$layout_238->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">239</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_239->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_239->id, $layout_239->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_239->id}}" title="Detail">{{$layout_239->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_239->id, $layout_239->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_239->id}}">{{$layout_239->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">240</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_240->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_240->id, $layout_240->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_240->id}}" title="Detail">{{$layout_240->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_240->id, $layout_240->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_240->id}}">{{$layout_240->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">241</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_241->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_241->id, $layout_241->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_241->id}}" title="Detail">{{$layout_241->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_241->id, $layout_241->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_241->id}}">{{$layout_241->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
            </div>
      </div>
      <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
             <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">242</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_242->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_242->id, $layout_242->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_242->id}}" title="Detail">{{$layout_242->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_242->id, $layout_242->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_242->id}}">{{$layout_242->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">243</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_243->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_243->id, $layout_243->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_243->id}}" title="Detail">{{$layout_243->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_243->id, $layout_243->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_243->id}}">{{$layout_243->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">244</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_244->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_244->id, $layout_244->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_244->id}}" title="Detail">{{$layout_244->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_244->id, $layout_244->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_244->id}}">{{$layout_244->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">245</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_245->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_245->id, $layout_245->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_245->id}}" title="Detail">{{$layout_245->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_245->id, $layout_245->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_245->id}}">{{$layout_245->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
            </div>
      </div>
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
             <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">246</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_246->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_246->id, $layout_246->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_246->id}}" title="Detail">{{$layout_246->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_246->id, $layout_246->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_246->id}}">{{$layout_246->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">247</div>
                    <div class="panel-body" style="height: 131px">
                       <input type="text" name="" class="form-control text-center" value="{{$layout_247->user}}" readonly="true">        
                       <a href="{{route('Detail3DMap', [$layout_247->id, $layout_247->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_247->id}}" title="Detail">{{$layout_247->workstation}}</a>
                       <a href="{{route('Detail3DMap2', [$layout_247->id, $layout_247->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_247->id}}">{{$layout_247->secondary_workstation}}</a>            
                    </div>
                     <div class="panel-footer" style="height: 38px;">
                    </div>
                  </div>
          
                 <div class="panel panel-default">
                  <div class="panel-heading">248</div>
                    <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_248->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_248->id, $layout_248->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_248->id}}" title="Detail">{{$layout_248->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_248->id, $layout_248->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_248->id}}">{{$layout_248->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">249</div>
                    <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_249->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_249->id, $layout_249->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_249->id}}" title="Detail">{{$layout_249->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_249->id, $layout_249->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_249->id}}">{{$layout_249->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
            </div>
      </div>
      <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
             <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">250</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_250->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_250->id, $layout_250->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_250->id}}" title="Detail">{{$layout_250->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_250->id, $layout_250->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_250->id}}">{{$layout_250->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">251</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_251->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_251->id, $layout_251->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_251->id}}" title="Detail">{{$layout_251->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_251->id, $layout_251->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_251->id}}">{{$layout_251->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">252</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_252->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_252->id, $layout_252->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_252->id}}" title="Detail">{{$layout_252->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_252->id, $layout_252->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_252->id}}">{{$layout_252->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">253</div>
                  <div class="panel-body" style="height: 131px">
                     <input type="text" name="" class="form-control text-center" value="{{$layout_253->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$layout_253->id, $layout_253->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_253->id}}" title="Detail">{{$layout_253->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$layout_253->id, $layout_253->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_253->id}}">{{$layout_252->secondary_workstation}}</a>            
                  </div>
                   <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
            </div>
      </div>
    </div>
    </div>
  </div>
</div>
    <div class="row">

        <!-- Page 1 -->
      <div style="width: 180px; margin-left: 0px; margin-top: 350px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">160</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_160->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_160->id, $layout_160->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_160->id}}" title="Detail">{{$layout_160->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_160->id, $layout_160->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_160->id}}">{{$layout_160->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>              
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">161</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_161->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_161->id, $layout_161->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_161->id}}" title="Detail">{{$layout_161->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_161->id, $layout_161->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_161->id}}">{{$layout_161->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>  
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">162</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_162->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_162->id, $layout_162->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_162->id}}" title="Detail">{{$layout_162->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_162->id, $layout_162->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_162->id}}">{{$layout_162->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">163</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_163->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_163->id, $layout_163->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_163->id}}" title="Detail">{{$layout_163->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_163->id, $layout_163->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_163->id}}">{{$layout_163->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div> 
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">164</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_164->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_164->id, $layout_164->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_164->id}}" title="Detail">{{$layout_164->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_164->id, $layout_164->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_164->id}}">{{$layout_164->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div> 
            </div>                       
        </div>
      </div>
    <!-- Page 1 -->
    <!-- Page 2 -->
    <div style="width: 180px; margin-left: 0px; margin-top: 350px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">165</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_165->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_165->id, $layout_165->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_165->id}}" title="Detail">{{$layout_165->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_165->id, $layout_165->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_165->id}}">{{$layout_165->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div> 
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">166</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_166->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_166->id, $layout_166->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_166->id}}" title="Detail">{{$layout_166->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_166->id, $layout_166->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_166->id}}">{{$layout_166->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div> 
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">167</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_167->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_167->id, $layout_167->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_167->id}}" title="Detail">{{$layout_167->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_167->id, $layout_167->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_167->id}}">{{$layout_167->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>          
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">168</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_168->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_168->id, $layout_168->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_168->id}}" title="Detail">{{$layout_168->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_168->id, $layout_168->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_168->id}}">{{$layout_168->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">169</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_169->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_169->id, $layout_169->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_169->id}}" title="Detail">{{$layout_169->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_169->id, $layout_169->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_169->id}}">{{$layout_169->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>      
    <!-- Page 2 -->
    <!-- Page 3 -->
    <div style="width: 180px; margin-left: -30px; margin-top: 350px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">170</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_170->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_170->id, $layout_170->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_170->id}}" title="Detail">{{$layout_170->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_170->id, $layout_170->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_170->id}}">{{$layout_170->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">171</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_171->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_171->id, $layout_171->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_171->id}}" title="Detail">{{$layout_171->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_171->id, $layout_171->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_171->id}}">{{$layout_171->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">172</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_172->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_172->id, $layout_172->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_172->id}}" title="Detail">{{$layout_172->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_172->id, $layout_172->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_172->id}}">{{$layout_172->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">173</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_173->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_173->id, $layout_173->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_173->id}}" title="Detail">{{$layout_173->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_173->id, $layout_173->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_173->id}}">{{$layout_173->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div> 
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">174</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_174->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_174->id, $layout_174->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_174->id}}" title="Detail">{{$layout_174->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_174->id, $layout_174->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_174->id}}">{{$layout_174->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div> 
            </div>                       
        </div>
      </div>
    <!-- Page 3 -->
    <!-- Page 4 -->
    <div style="width: 180px; margin-left: 0px; margin-top: 350px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">175</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_175->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_175->id, $layout_175->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_175->id}}" title="Detail">{{$layout_175->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_175->id, $layout_175->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_175->id}}">{{$layout_175->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div> 
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">176</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_176->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_176->id, $layout_176->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_176->id}}" title="Detail">{{$layout_176->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_176->id, $layout_176->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_176->id}}">{{$layout_176->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div> 
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">177</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_177->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_177->id, $layout_177->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_177->id}}" title="Detail">{{$layout_177->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_177->id, $layout_177->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_177->id}}">{{$layout_177->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>            
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">178</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_178->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_178->id, $layout_178->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_178->id}}" title="Detail">{{$layout_178->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_178->id, $layout_178->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_178->id}}">{{$layout_178->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">179</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_179->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_179->id, $layout_179->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_179->id}}" title="Detail">{{$layout_179->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_179->id, $layout_179->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_179->id}}">{{$layout_179->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>      
    <!-- Page 4 -->
    <!-- Page 5 -->
    <div style="width: 180px; margin-left: -30px; position: relative; margin-top: 350px;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">180</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_180->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_180->id, $layout_180->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_180->id}}" title="Detail">{{$layout_180->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_180->id, $layout_180->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_180->id}}">{{$layout_180->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">181</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_181->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_181->id, $layout_181->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_181->id}}" title="Detail">{{$layout_181->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_181->id, $layout_181->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_181->id}}">{{$layout_181->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">182</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_182->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_182->id, $layout_182->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_182->id}}" title="Detail">{{$layout_182->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_182->id, $layout_182->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_182->id}}">{{$layout_182->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">183</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_183->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_183->id, $layout_183->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_183->id}}" title="Detail">{{$layout_183->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_183->id, $layout_183->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_183->id}}">{{$layout_183->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div> 
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">184</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_184->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_184->id, $layout_184->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_184->id}}" title="Detail">{{$layout_184->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_184->id, $layout_184->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_184->id}}">{{$layout_184->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>
    <!-- Page 5 -->
    <!-- Page 6 -->
     <div style="width: 180px; margin-left: 30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">185</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_185->user}}" readonly="true" autofocus="true">        
                 <a href="{{route('Detail3DMap', [$layout_185->id, $layout_185->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_185->id}}" title="Detail">{{$layout_185->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_185->id, $layout_185->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_185->id}}">{{$layout_185->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">186</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_186->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_186->id, $layout_186->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_186->id}}" title="Detail">{{$layout_186->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_186->id, $layout_186->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_186->id}}">{{$layout_186->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">187</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_187->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_187->id, $layout_186->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_187->id}}" title="Detail">{{$layout_187->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_187->id, $layout_187->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_187->id}}">{{$layout_187->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">188</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_188->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_188->id, $layout_188->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_188->id}}" title="Detail">{{$layout_188->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_188->id, $layout_188->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_188->id}}">{{$layout_188->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">189</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_189->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_189->id, $layout_189->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_189->id}}" title="Detail">{{$layout_189->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_189->id, $layout_189->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_189->id}}">{{$layout_189->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">190</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_190->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_190->id, $layout_190->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_190->id}}" title="Detail">{{$layout_190->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_190->id, $layout_190->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_190->id}}">{{$layout_190->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>
    <!-- Page 6 -->
    <!-- Page 7 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">191</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_191->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_191->id, $layout_191->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_191->id}}" title="Detail">{{$layout_191->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_191->id, $layout_191->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_191->id}}">{{$layout_191->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">192</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_192->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_192->id, $layout_192->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_192->id}}" title="Detail">{{$layout_192->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_192->id, $layout_192->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_192->id}}">{{$layout_192->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">193</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_193->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_193->id, $layout_193->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_193->id}}" title="Detail">{{$layout_193->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_193->id, $layout_193->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_193->id}}">{{$layout_193->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>        
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">194</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_194->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_194->id, $layout_194->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_194->id}}" title="Detail">{{$layout_194->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_194->id, $layout_194->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_194->id}}">{{$layout_194->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">195</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_195->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_195->id, $layout_195->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_195->id}}" title="Detail">{{$layout_195->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_195->id, $layout_195->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_195->id}}">{{$layout_195->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">196</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_196->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_196->id, $layout_196->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_196->id}}" title="Detail">{{$layout_196->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_196->id, $layout_196->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_196->id}}">{{$layout_196->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>
    <!-- Page 7 -->
    <!-- Page 8 -->
     <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">197</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_197->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_197->id, $layout_197->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_197->id}}" title="Detail">{{$layout_197->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_197->id, $layout_197->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_197->id}}">{{$layout_197->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">198</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_198->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_198->id, $layout_198->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_198->id}}" title="Detail">{{$layout_198->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_198->id, $layout_198->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_198->id}}">{{$layout_198->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">199</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_199->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_199->id, $layout_199->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_199->id}}" title="Detail">{{$layout_199->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_199->id, $layout_199->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_199->id}}">{{$layout_199->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">200</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_200->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_200->id, $layout_200->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_200->id}}" title="Detail">{{$layout_200->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_200->id, $layout_200->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_200->id}}">{{$layout_200->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">201</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_201->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_201->id, $layout_201->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_201->id}}" title="Detail">{{$layout_201->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_201->id, $layout_201->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_201->id}}">{{$layout_201->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">202</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_202->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_202->id, $layout_202->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_202->id}}" title="Detail">{{$layout_202->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_202->id, $layout_202->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_202->id}}">{{$layout_202->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>
    <!-- Page 8 -->
    <!-- Page 9 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">203</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_203->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_203->id, $layout_203->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_203->id}}" title="Detail">{{$layout_203->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_203->id, $layout_203->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_203->id}}">{{$layout_203->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">204</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_204->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_204->id, $layout_204->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_204->id}}" title="Detail">{{$layout_204->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_204->id, $layout_204->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_204->id}}">{{$layout_204->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">205</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_205->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_205->id, $layout_205->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_205->id}}" title="Detail">{{$layout_205->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_205->id, $layout_205->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_205->id}}">{{$layout_205->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>          
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">206</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_206->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_206->id, $layout_206->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_206->id}}" title="Detail">{{$layout_206->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_206->id, $layout_206->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_206->id}}">{{$layout_206->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">207</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_207->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_207->id, $layout_207->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_207->id}}" title="Detail">{{$layout_207->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_207->id, $layout_207->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_207->id}}">{{$layout_207->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">208</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_208->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_208->id, $layout_208->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_208->id}}" title="Detail">{{$layout_208->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_208->id, $layout_208->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_208->id}}">{{$layout_208->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>
    <!-- Page 9 -->
    <!-- Page 10 -->
     <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">209</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_209->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_209->id, $layout_209->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_209->id}}" title="Detail">{{$layout_209->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_209->id, $layout_209->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_209->id}}">{{$layout_209->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">210</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_210->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_210->id, $layout_210->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_210->id}}" title="Detail">{{$layout_210->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_210->id, $layout_210->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_210->id}}">{{$layout_210->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">211</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_211->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_211->id, $layout_211->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_211->id}}" title="Detail">{{$layout_211->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_211->id, $layout_211->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_211->id}}">{{$layout_211->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>          
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">212</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_212->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_212->id, $layout_212->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_212->id}}" title="Detail">{{$layout_212->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_212->id, $layout_212->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_212->id}}">{{$layout_212->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">213</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_213->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_213->id, $layout_213->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_213->id}}" title="Detail">{{$layout_213->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_213->id, $layout_213->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_213->id}}">{{$layout_213->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">214</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_214->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_214->id, $layout_214->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_214->id}}" title="Detail">{{$layout_214->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_214->id, $layout_214->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_214->id}}">{{$layout_214->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>
    <!-- Page 10 -->
    <!-- Page 11 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">215</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_215->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_215->id, $layout_215->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_215->id}}" title="Detail">{{$layout_215->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_215->id, $layout_215->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_215->id}}">{{$layout_215->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">216</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_216->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_216->id, $layout_216->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_216->id}}" title="Detail">{{$layout_216->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_216->id, $layout_216->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_216->id}}">{{$layout_216->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">217</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_217->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_217->id, $layout_217->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_217->id}}" title="Detail">{{$layout_217->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_217->id, $layout_217->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_217->id}}">{{$layout_217->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>          
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">218</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_218->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_218->id, $layout_218->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_218->id}}" title="Detail">{{$layout_218->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_218->id, $layout_218->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_218->id}}">{{$layout_218->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">219</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_219->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_219->id, $layout_219->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_219->id}}" title="Detail">{{$layout_219->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_219->id, $layout_219->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_219->id}}">{{$layout_219->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">220</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_220->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_220->id, $layout_220->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_220->id}}" title="Detail">{{$layout_220->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_220->id, $layout_220->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_220->id}}">{{$layout_220->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>
    <!-- Page 11 -->
    <!-- Page 12 -->
     <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">221</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_221->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_221->id, $layout_221->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_221->id}}" title="Detail">{{$layout_221->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_221->id, $layout_221->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_221->id}}">{{$layout_221->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">222</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_222->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_222->id, $layout_222->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_222->id}}" title="Detail">{{$layout_221->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_222->id, $layout_222->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_222->id}}">{{$layout_222->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">223</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_223->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_223->id, $layout_223->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_223->id}}" title="Detail">{{$layout_223->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_223->id, $layout_223->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_223->id}}">{{$layout_223->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>          
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">224</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_224->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_224->id, $layout_224->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_224->id}}" title="Detail">{{$layout_224->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_224->id, $layout_224->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_224->id}}">{{$layout_224->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">225</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_225->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_225->id, $layout_225->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_225->id}}" title="Detail">{{$layout_225->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_225->id, $layout_225->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_225->id}}">{{$layout_225->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">226</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_226->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_226->id, $layout_226->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_226->id}}" title="Detail">{{$layout_226->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_226->id, $layout_226->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_226->id}}">{{$layout_226->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>
    <!-- Page 12 -->
    <!-- Page 13 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">227</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_227->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_227->id, $layout_227->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_227->id}}" title="Detail">{{$layout_227->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_227->id, $layout_227->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_227->id}}">{{$layout_227->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">228</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_228->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_228->id, $layout_228->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_228->id}}" title="Detail">{{$layout_228->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_228->id, $layout_228->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_228->id}}">{{$layout_228->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">229</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_229->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_229->id, $layout_229->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_229->id}}" title="Detail">{{$layout_229->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_229->id, $layout_229->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_229->id}}">{{$layout_229->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">230</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_230->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_230->id, $layout_230->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_230->id}}" title="Detail">{{$layout_230->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_230->id, $layout_230->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_230->id}}">{{$layout_230->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">231</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_231->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_231->id, $layout_231->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_231->id}}" title="Detail">{{$layout_231->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_231->id, $layout_231->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_231->id}}">{{$layout_231->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">232</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_232->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_232->id, $layout_232->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_232->id}}" title="Detail">{{$layout_232->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_232->id, $layout_232->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_232->id}}">{{$layout_232->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>                       
        </div>
      </div>
    <!-- Page 13 -->
    <!-- Page 14 -->
     <div style="width: 180px; margin-left: 60px; position: relative;" class="col-sm-1">
      <div class="well well-lg" style="height: 600px; width: 200px;">
        <div class="container-fluid">
          <div class="row">
             <div class="panel panel-default">
              <div class="panel-heading">233</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_233->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_233->id, $layout_233->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_233->id}}" title="Detail">{{$layout_233->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_233->id, $layout_233->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_233->id}}">{{$layout_233->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
              <div class="panel panel-default">
              <div class="panel-heading">234</div>
              <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_234->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_234->id, $layout_234->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_234->id}}" title="Detail">{{$layout_234->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_234->id, $layout_234->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_234->id}}">{{$layout_234->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            
          </div>          
        </div>
      </div>
      <div class="well well-lg" style="height: 600px; width: 200px;">
        <div class="container-fluid">
          <div class="row">
             <div class="panel panel-default">
              <div class="panel-heading">235</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_235->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_235->id, $layout_235->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_235->id}}" title="Detail">{{$layout_235->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_235->id, $layout_235->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_235->id}}">{{$layout_235->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
              <div class="panel panel-default">
              <div class="panel-heading">236</div>
               <div class="panel-body" style="height: 131px">
                 <input type="text" name="" class="form-control text-center" value="{{$layout_236->user}}" readonly="true">        
                 <a href="{{route('Detail3DMap', [$layout_236->id, $layout_236->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$layout_236->id}}" title="Detail">{{$layout_236->workstation}}</a>
                 <a href="{{route('Detail3DMap2', [$layout_236->id, $layout_236->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$layout_236->id}}">{{$layout_236->secondary_workstation}}</a>            
              </div>
               <div class="panel-footer" style="height: 38px;">
              </div>
            </div>
            
          </div>          
        </div>
      </div>
      </div>
      <!-- Page 14 -->


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