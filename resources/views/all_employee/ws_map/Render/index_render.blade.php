@extends('layout')

@section('title')
WS MAP - Render
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
    height: 720px;
  }
</style>
@section('body')
<script src="https://code.easypz.io/easypz.latest.min.js"></script>

<div class="row">
  <div class="col-sm-12">
    <h1 class="page-header">Render</h1>
  </div>
</div> 
<div class="row" style=" margin-bottom: 10px;">
  <div class="col-sm-12">
    <a href="{{route('PDF-Render-Area')}}" class="btn btn-warning btn-sm" target="_blank">PDF</a>   
             
  </div>
</div>
<div class="container-fluid">
  <div class="scroll"> 
    <div class="btn-sm" style="width: 2000px;"> 
      <div class="row">
        <div class="col-sm-12">   
          <div class="col-sm-3">
            <div class="well well-lg" style="width: 720px; height: 1620px;">             
              <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
                <div class="panel-group">
                 <div class="panel panel-default">
                  <div class="panel-heading">254</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_254->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_254->id, $Render_254->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_254->id}}" title="Detail">{{$Render_254->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_254->id, $Render_254->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_254->id}}">{{$Render_254->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">258</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_258->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_258->id, $Render_258->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_258->id}}" title="Detail">{{$Render_258->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_258->id, $Render_258->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_258->id}}">{{$Render_258->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default" style="margin-top: 33px">
                  <div class="panel-heading">262</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_262->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_262->id, $Render_262->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_262->id}}" title="Detail">{{$Render_262->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_262->id, $Render_262->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_262->id}}">{{$Render_262->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">266</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_266->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_266->id, $Render_266->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_266->id}}" title="Detail">{{$Render_266->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_266->id, $Render_266->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_266->id}}">{{$Render_266->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default" style="margin-top: 33px">
                  <div class="panel-heading">270</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_270->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_270->id, $Render_270->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_270->id}}" title="Detail">{{$Render_270->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_270->id, $Render_270->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_270->id}}">{{$Render_270->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">274</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_274->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_274->id, $Render_274->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_274->id}}" title="Detail">{{$Render_274->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_274->id, $Render_274->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_274->id}}">{{$Render_274->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default" style="margin-top: 33px">
                  <div class="panel-heading">278</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_278->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_278->id, $Render_278->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_278->id}}" title="Detail">{{$Render_278->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_278->id, $Render_278->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_278->id}}">{{$Render_278->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
              </div>
            </div>
            <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">255</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_255->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_255->id, $Render_255->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_255->id}}" title="Detail">{{$Render_255->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_255->id, $Render_255->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_255->id}}">{{$Render_255->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">259</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_255->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_255->id, $Render_255->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_255->id}}" title="Detail">{{$Render_255->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_255->id, $Render_255->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_255->id}}">{{$Render_255->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default" style="margin-top: 33px">
                  <div class="panel-heading">263</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_263->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_263->id, $Render_263->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_263->id}}" title="Detail">{{$Render_263->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_263->id, $Render_263->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_263->id}}">{{$Render_263->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">267</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_267->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_267->id, $Render_267->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_267->id}}" title="Detail">{{$Render_267->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_267->id, $Render_267->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_267->id}}">{{$Render_267->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default" style="margin-top: 33px">
                  <div class="panel-heading">271</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_271->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_271->id, $Render_271->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_271->id}}" title="Detail">{{$Render_271->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_271->id, $Render_271->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_271->id}}">{{$Render_271->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">275</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_275->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_275->id, $Render_275->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_275->id}}" title="Detail">{{$Render_275->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_275->id, $Render_275->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_275->id}}">{{$Render_275->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
                <div class="panel panel-default" style="margin-top: 33px">
                  <div class="panel-heading">279</div>
                  <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_279->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_279->id, $Render_279->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_279->id}}" title="Detail">{{$Render_279->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_279->id, $Render_279->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_279->id}}">{{$Render_279->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
                </div>
              </div>
            </div>
            <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
              <div class="panel-group">
               <div class="panel panel-default">
                <div class="panel-heading">256</div>
                 <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_256->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_256->id, $Render_256->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_256->id}}" title="Detail">{{$Render_256->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_256->id, $Render_256->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_256->id}}">{{$Render_256->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">260</div>
                <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_260->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_260->id, $Render_260->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_260->id}}" title="Detail">{{$Render_260->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_260->id, $Render_260->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_260->id}}">{{$Render_260->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
              </div>
              <div class="panel panel-default" style="margin-top: 33px">
                <div class="panel-heading">264</div>
                <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_264->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_264->id, $Render_264->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_264->id}}" title="Detail">{{$Render_264->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_264->id, $Render_264->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_264->id}}">{{$Render_264->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">268</div>
                <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_268->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_268->id, $Render_268->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_268->id}}" title="Detail">{{$Render_268->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_268->id, $Render_268->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_268->id}}">{{$Render_268->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
              </div>
              <div class="panel panel-default" style="margin-top: 33px">
                <div class="panel-heading">272</div>
                <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_272->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_272->id, $Render_272->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_272->id}}" title="Detail">{{$Render_272->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_272->id, $Render_272->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_272->id}}">{{$Render_272->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">276</div>
                <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_276->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_276->id, $Render_276->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_276->id}}" title="Detail">{{$Render_276->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_276->id, $Render_276->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_276->id}}">{{$Render_276->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
              </div>
            </div>
          </div>
          <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
            <div class="panel-group">
             <div class="panel panel-default">
              <div class="panel-heading">257</div>
               <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_257->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_257->id, $Render_257->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_257->id}}" title="Detail">{{$Render_257->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_257->id, $Render_257->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_257->id}}">{{$Render_257->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">261</div>
              <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_261->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_261->id, $Render_261->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_261->id}}" title="Detail">{{$Render_261->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_261->id, $Render_261->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_261->id}}">{{$Render_261->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
            </div>
            <div class="panel panel-default" style="margin-top: 33px">
              <div class="panel-heading">265</div>
              <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_265->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_265->id, $Render_265->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_265->id}}" title="Detail">{{$Render_265->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_265->id, $Render_265->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_265->id}}">{{$Render_265->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">269</div>
              <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_269->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_269->id, $Render_269->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_269->id}}" title="Detail">{{$Render_269->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_269->id, $Render_269->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_269->id}}">{{$Render_269->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
            </div>
            <div class="panel panel-default" style="margin-top: 33px">
              <div class="panel-heading">273</div>
              <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_273->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_273->id, $Render_273->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_273->id}}" title="Detail">{{$Render_273->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_273->id, $Render_273->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_273->id}}">{{$Render_273->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">277</div>
              <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_277->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_277->id, $Render_277->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_277->id}}" title="Detail">{{$Render_277->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_277->id, $Render_277->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_277->id}}">{{$Render_277->secondary_workstation}}</a>               
                  </div>
                 <div class="panel-footer" style="height: 38px;">
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-1" style="margin-left: 235px; width: 590px;">
      <div class="well well-lg" style="width: 590px; height: 1620px;">       
        <div style="width: 180px; margin-left: 0px; position: relative; margin-top: -15px;" class="col-sm-1">
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">347</div>
              <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_347->id, $Render_347->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_347->id}}" title="Detail">{{$Render_347->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">350</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_350->id, $Render_350->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_350->id}}" title="Detail">{{$Render_350->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">353</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_350->id, $Render_350->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_350->id}}" title="Detail">{{$Render_350->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">356</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_350->id, $Render_350->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_350->id}}" title="Detail">{{$Render_350->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">359</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_359->id, $Render_359->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_359->id}}" title="Detail">{{$Render_359->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">362</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_362->id, $Render_362->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_362->id}}" title="Detail">{{$Render_362->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">365</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_365->id, $Render_365->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_365->id}}" title="Detail">{{$Render_365->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">368</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_368->id, $Render_368->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_368->id}}" title="Detail">{{$Render_368->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">371</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_371->id, $Render_371->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_371->id}}" title="Detail">{{$Render_371->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">374</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_371->id, $Render_374->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_374->id}}" title="Detail">{{$Render_374->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">377</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_377->id, $Render_377->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_377->id}}" title="Detail">{{$Render_377->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
        </div>
      </div>
        <div style="width: 180px; margin-left: 0px; margin-top: -15px; position: relative;" class="col-sm-1">
          <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">348</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_348->id, $Render_348->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_348->id}}" title="Detail">{{$Render_348->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">351</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_351->id, $Render_351->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_351->id}}" title="Detail">{{$Render_351->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">354</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_354->id, $Render_354->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_354->id}}" title="Detail">{{$Render_354->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">357</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_357->id, $Render_357->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_357->id}}" title="Detail">{{$Render_357->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">360</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_360->id, $Render_360->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_360->id}}" title="Detail">{{$Render_360->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">363</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_363->id, $Render_363->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_363->id}}" title="Detail">{{$Render_363->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">366</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_366->id, $Render_366->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_366->id}}" title="Detail">{{$Render_366->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">369</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_369->id, $Render_369->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_369->id}}" title="Detail">{{$Render_369->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">372</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_372->id, $Render_372->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_372->id}}" title="Detail">{{$Render_372->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">375</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_377->id, $Render_377->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_377->id}}" title="Detail">{{$Render_377->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">378</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_378->id, $Render_378->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_378->id}}" title="Detail">{{$Render_378->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
        </div>
      </div>
        <div style="width: 180px; margin-left: 0px; margin-top: -15px; position: relative;" class="col-sm-1">
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">349</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_349->id, $Render_349->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_349->id}}" title="Detail">{{$Render_349->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">352</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_352->id, $Render_352->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_352->id}}" title="Detail">{{$Render_352->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">355</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_355->id, $Render_355->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_355->id}}" title="Detail">{{$Render_355->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">358</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_358->id, $Render_358->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_358->id}}" title="Detail">{{$Render_358->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">361</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_361->id, $Render_361->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_361->id}}" title="Detail">{{$Render_361->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">364</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_364->id, $Render_364->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_364->id}}" title="Detail">{{$Render_364->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">367</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_367->id, $Render_367->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_367->id}}" title="Detail">{{$Render_367->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">370</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_370->id, $Render_370->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_370->id}}" title="Detail">{{$Render_370->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">373</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_373->id, $Render_373->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_373->id}}" title="Detail">{{$Render_373->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">376</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_376->id, $Render_376->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_376->id}}" title="Detail">{{$Render_376->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">379</div>
            <div class="panel-body" style="height: 63px;">                        
                 <a href="{{route('Detail3DMap', [$Render_379->id, $Render_379->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_379->id}}" title="Detail">{{$Render_379->workstation}}</a>                                
              </div>
              <div class="panel-footer" style="height: 38px;">
               </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="col-sm-3">
      <div class="well well-lg" style="width: 720px; margin-left: 10px; height: 1620px;">
        <center>MEETING ROOM 1</center>
        <div style="width: 180px; margin-left: 240px; position: relative;" class="col-sm-1">
          <div class="panel panel-default" style="margin-top: 1325px;">
            <div class="panel-heading">343</div>
            <div class="panel-body" style="height: 131px">
                    <input type="text" name="" class="form-control text-center" value="{{$Render_343->user}}" readonly="true">        
                     <a href="{{route('Detail3DMap', [$Render_343->id, $Render_343->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_343->id}}" title="Detail">{{$Render_343->workstation}}</a>
                     <a href="{{route('Detail3DMap2', [$Render_343->id, $Render_343->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_343->id}}">{{$Render_343->secondary_workstation}}</a>               
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
<!--  -->
<div class="container-fluid"> 
<div class="btn-sm" style="width: 1500px;">  
<div class="row">
  <!-- Page 1 -->
<div class="col-lg-2">
  <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
    <div class="well well-lg" style="margin-top: 60px; height: 630px; width: 370px;">
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
        <div class="panel panel-default" style="margin-top: 160px;">
          <div class="panel-heading">344</div>
          <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_344->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_344->id, $Render_344->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_344->id}}" title="Detail">{{$Render_344->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_344->id, $Render_344->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_344->id}}">{{$Render_344->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
        </div>
      </div>
    </div>
    <div class="well well-lg" style="height: 630px; width: 370px;">
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
        <div class="panel-group" style="margin-top: 60px;">
          <div class="panel panel-default">
            <div class="panel-heading">345</div>
            <div class="panel-body" style="height: 131px">
              <input type="text" name="" class="form-control text-center" value="{{$Render_345->user}}" readonly="true">        
              <a href="{{route('Detail3DMap', [$Render_345->id, $Render_345->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_345->id}}" title="Detail">{{$Render_345->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$Render_345->id, $Render_345->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_345->id}}">{{$Render_345->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">346</div>
            <div class="panel-body" style="height: 131px">
              <input type="text" name="" class="form-control text-center" value="{{$Render_346->user}}" readonly="true">        
              <a href="{{route('Detail3DMap', [$Render_346->id, $Render_346->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_346->id}}" title="Detail">{{$Render_346->workstation}}</a>
             <a href="{{route('Detail3DMap2', [$Render_346->id, $Render_346->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_346->id}}">{{$Render_346->secondary_workstation}}</a>               
            </div>
            <div class="panel-footer" style="height: 38px;">
            </div>         
          </div>
        </div>                      
      </div>
    </div>
  </div>
</div>
<!--  -->
<div style="width: 2700px;">
 <div style="width: 180px; margin-left: 220px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 60px;">
      <div class="panel panel-default">
        <div class="panel-heading">280</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_280->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_280->id, $Render_280->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_280->id}}" title="Detail">{{$Render_280->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_280->id, $Render_280->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_280->id}}">{{$Render_280->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">281</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_281->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_281->id, $Render_281->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_281->id}}" title="Detail">{{$Render_281->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_281->id, $Render_281->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_281->id}}">{{$Render_281->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">282</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_282->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_282->id, $Render_282->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_282->id}}" title="Detail">{{$Render_282->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_282->id, $Render_282->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_282->id}}">{{$Render_282->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">283</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_283->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_283->id, $Render_283->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_283->id}}" title="Detail">{{$Render_282->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_283->id, $Render_283->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_283->id}}">{{$Render_283->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">284</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_284->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_284->id, $Render_284->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_284->id}}" title="Detail">{{$Render_284->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_284->id, $Render_284->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_284->id}}">{{$Render_284->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">285</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_285->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_285->id, $Render_285->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_285->id}}" title="Detail">{{$Render_285->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_285->id, $Render_285->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_285->id}}">{{$Render_285->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>
  </div>
  <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 60px;">
      <div class="panel panel-default">
        <div class="panel-heading">286</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_286->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_286->id, $Render_286->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_286->id}}" title="Detail">{{$Render_286->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_286->id, $Render_286->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_286->id}}">{{$Render_286->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">287</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_287->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_287->id, $Render_287->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_287->id}}" title="Detail">{{$Render_287->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_287->id, $Render_287->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_287->id}}">{{$Render_287->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">288</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_288->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_288->id, $Render_288->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_288->id}}" title="Detail">{{$Render_288->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_288->id, $Render_288->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_288->id}}">{{$Render_288->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">289</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_289->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_289->id, $Render_289->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_289->id}}" title="Detail">{{$Render_289->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_289->id, $Render_289->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_289->id}}">{{$Render_289->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">290</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_290->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_290->id, $Render_290->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_290->id}}" title="Detail">{{$Render_290->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_290->id, $Render_290->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_290->id}}">{{$Render_290->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">291</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_291->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_291->id, $Render_291->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_291->id}}" title="Detail">{{$Render_291->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_291->id, $Render_291->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_291->id}}">{{$Render_291->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>
  </div>
  <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 60px;">
      <div class="panel panel-default">
        <div class="panel-heading">292</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_292->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_292->id, $Render_292->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_292->id}}" title="Detail">{{$Render_292->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_292->id, $Render_292->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_292->id}}">{{$Render_292->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">293</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_293->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_293->id, $Render_293->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_293->id}}" title="Detail">{{$Render_293->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_293->id, $Render_293->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_293->id}}">{{$Render_293->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">294</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_294->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_294->id, $Render_294->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_294->id}}" title="Detail">{{$Render_294->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_294->id, $Render_294->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_294->id}}">{{$Render_294->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">295</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_295->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_295->id, $Render_295->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_295->id}}" title="Detail">{{$Render_295->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_295->id, $Render_295->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_295->id}}">{{$Render_295->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">296</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_296->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_296->id, $Render_296->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_296->id}}" title="Detail">{{$Render_296->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_296->id, $Render_296->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_296->id}}">{{$Render_296->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">297</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_297->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_297->id, $Render_297->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_297->id}}" title="Detail">{{$Render_297->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_297->id, $Render_297->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_297->id}}">{{$Render_297->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>
  </div>
  <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 60px;">
      <div class="panel panel-default">
        <div class="panel-heading">298</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_298->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_298->id, $Render_298->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_298->id}}" title="Detail">{{$Render_298->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_298->id, $Render_298->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_298->id}}">{{$Render_298->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">299</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_299->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_299->id, $Render_299->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_299->id}}" title="Detail">{{$Render_299->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_299->id, $Render_299->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_299->id}}">{{$Render_299->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">300</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_300->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_300->id, $Render_300->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_300->id}}" title="Detail">{{$Render_300->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_300->id, $Render_300->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_300->id}}">{{$Render_300->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">301</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_301->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_301->id, $Render_301->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_301->id}}" title="Detail">{{$Render_301->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_301->id, $Render_301->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_301->id}}">{{$Render_301->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">302</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_302->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_302->id, $Render_302->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_302->id}}" title="Detail">{{$Render_302->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_302->id, $Render_302->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_302->id}}">{{$Render_302->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">303</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_303->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_303->id, $Render_303->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_303->id}}" title="Detail">{{$Render_303->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_303->id, $Render_303->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_303->id}}">{{$Render_303->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>
  </div>
  <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 60px;">
      <div class="panel panel-default">
        <div class="panel-heading">304</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_304->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_304->id, $Render_304->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_304->id}}" title="Detail">{{$Render_304->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_304->id, $Render_304->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_304->id}}">{{$Render_304->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">305</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_305->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_305->id, $Render_305->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_305->id}}" title="Detail">{{$Render_305->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_305->id, $Render_305->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_305->id}}">{{$Render_305->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">306</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_306->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_306->id, $Render_306->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_306->id}}" title="Detail">{{$Render_306->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_306->id, $Render_306->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_306->id}}">{{$Render_306->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">307</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_307->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_307->id, $Render_307->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_307->id}}" title="Detail">{{$Render_307->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_307->id, $Render_307->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_307->id}}">{{$Render_307->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">308</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_308->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_308->id, $Render_308->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_308->id}}" title="Detail">{{$Render_308->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_308->id, $Render_308->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_308->id}}">{{$Render_308->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">309</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_309->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_309->id, $Render_309->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_309->id}}" title="Detail">{{$Render_309->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_309->id, $Render_309->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_309->id}}">{{$Render_309->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>
  </div>
  <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 60px;">
      <div class="panel panel-default">
        <div class="panel-heading">310</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_310->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_310->id, $Render_310->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_310->id}}" title="Detail">{{$Render_310->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_310->id, $Render_310->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_310->id}}">{{$Render_310->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">311</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_311->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_311->id, $Render_311->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_311->id}}" title="Detail">{{$Render_311->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_311->id, $Render_311->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_311->id}}">{{$Render_311->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">312</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_312->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_312->id, $Render_312->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_312->id}}" title="Detail">{{$Render_312->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_312->id, $Render_312->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_312->id}}">{{$Render_312->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">313</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_313->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_313->id, $Render_313->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_313->id}}" title="Detail">{{$Render_313->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_313->id, $Render_313->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_313->id}}">{{$Render_313->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">314</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_314->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_314->id, $Render_314->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_314->id}}" title="Detail">{{$Render_314->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_314->id, $Render_314->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_314->id}}">{{$Render_314->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">315</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_315->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_315->id, $Render_315->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_315->id}}" title="Detail">{{$Render_315->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_315->id, $Render_315->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_315->id}}">{{$Render_315->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>
  </div>
  <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 60px;">
      <div class="panel panel-default">
        <div class="panel-heading">316</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_316->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_316->id, $Render_316->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_316->id}}" title="Detail">{{$Render_316->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_316->id, $Render_316->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_316->id}}">{{$Render_316->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">317</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_317->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_317->id, $Render_317->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_317->id}}" title="Detail">{{$Render_317->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_317->id, $Render_317->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_317->id}}">{{$Render_317->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">318</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_318->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_318->id, $Render_318->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_318->id}}" title="Detail">{{$Render_318->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_318->id, $Render_318->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_318->id}}">{{$Render_318->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">319</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_319->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_319->id, $Render_319->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_319->id}}" title="Detail">{{$Render_319->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_319->id, $Render_319->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_319->id}}">{{$Render_319->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">320</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_320->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_320->id, $Render_320->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_320->id}}" title="Detail">{{$Render_320->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_320->id, $Render_320->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_320->id}}">{{$Render_320->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">321</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_321->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_321->id, $Render_321->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_321->id}}" title="Detail">{{$Render_321->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_321->id, $Render_321->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_321->id}}">{{$Render_321->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>    
  </div>  
<div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 60px;">
      <div class="panel panel-default">
        <div class="panel-heading">322</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_322->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_322->id, $Render_322->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_322->id}}" title="Detail">{{$Render_322->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_322->id, $Render_322->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_322->id}}">{{$Render_322->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">323</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_323->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_323->id, $Render_323->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_323->id}}" title="Detail">{{$Render_323->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_323->id, $Render_323->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_323->id}}">{{$Render_323->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">324</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_324->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_324->id, $Render_324->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_324->id}}" title="Detail">{{$Render_324->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_324->id, $Render_324->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_324->id}}">{{$Render_324->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">325</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_325->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_325->id, $Render_325->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_325->id}}" title="Detail">{{$Render_325->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_325->id, $Render_325->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_325->id}}">{{$Render_325->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">326</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_326->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_326->id, $Render_326->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_326->id}}" title="Detail">{{$Render_326->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_326->id, $Render_326->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_326->id}}">{{$Render_326->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">327</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_327->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_327->id, $Render_327->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_327->id}}" title="Detail">{{$Render_327->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_327->id, $Render_327->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_327->id}}">{{$Render_327->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>    
  </div>

<div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 900px;">
      <div class="panel panel-default">
        <div class="panel-heading">328</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_328->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_328->id, $Render_328->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_328->id}}" title="Detail">{{$Render_328->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_328->id, $Render_328->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_328->id}}">{{$Render_328->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">329</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_329->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_329->id, $Render_329->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_329->id}}" title="Detail">{{$Render_329->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_329->id, $Render_329->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_329->id}}">{{$Render_329->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">330</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_330->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_330->id, $Render_330->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_330->id}}" title="Detail">{{$Render_330->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_330->id, $Render_330->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_330->id}}">{{$Render_330->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>    
</div>
<div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 900px;">
      <div class="panel panel-default">
        <div class="panel-heading">331</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_331->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_331->id, $Render_331->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_331->id}}" title="Detail">{{$Render_331->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_331->id, $Render_331->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_331->id}}">{{$Render_331->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">332</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_332->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_332->id, $Render_332->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_332->id}}" title="Detail">{{$Render_332->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_332->id, $Render_332->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_332->id}}">{{$Render_332->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">333</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_333->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_333->id, $Render_333->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_333->id}}" title="Detail">{{$Render_333->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_333->id, $Render_333->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_333->id}}">{{$Render_333->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>    
</div>
<div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 900px;">
      <div class="panel panel-default">
        <div class="panel-heading">334</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_334->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_334->id, $Render_334->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_334->id}}" title="Detail">{{$Render_334->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_334->id, $Render_334->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_334->id}}">{{$Render_334->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">335</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_335->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_335->id, $Render_335->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_335->id}}" title="Detail">{{$Render_335->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_335->id, $Render_335->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_335->id}}">{{$Render_335->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">336</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_336->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_336->id, $Render_336->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_336->id}}" title="Detail">{{$Render_336->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_336->id, $Render_336->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_336->id}}">{{$Render_336->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>    
</div>
<div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 900px;">
      <div class="panel panel-default">
        <div class="panel-heading">337</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_337->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_337->id, $Render_337->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_337->id}}" title="Detail">{{$Render_337->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_337->id, $Render_337->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_337->id}}">{{$Render_337->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">338</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_338->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_338->id, $Render_338->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_338->id}}" title="Detail">{{$Render_338->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_338->id, $Render_338->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_338->id}}">{{$Render_338->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">339</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_339->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_339->id, $Render_339->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_339->id}}" title="Detail">{{$Render_339->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_339->id, $Render_339->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_339->id}}">{{$Render_339->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>    
</div>
<div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
    <div class="panel-group" style="margin-top: 900px;">
      <div class="panel panel-default">
        <div class="panel-heading">340</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_340->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_340->id, $Render_340->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_340->id}}" title="Detail">{{$Render_340->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_340->id, $Render_340->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_340->id}}">{{$Render_340->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">341</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_341->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_341->id, $Render_341->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_341->id}}" title="Detail">{{$Render_341->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_341->id, $Render_341->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_341->id}}">{{$Render_341->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">342</div>
        <div class="panel-body" style="height: 131px">
            <input type="text" name="" class="form-control text-center" value="{{$Render_342->user}}" readonly="true">        
            <a href="{{route('Detail3DMap', [$Render_342->id, $Render_342->workstation])}}" class="btn btn-md btn-primary form-control" data-toggle="modal" data-target="#showModal{{$Render_342->id}}" title="Detail">{{$Render_342->workstation}}</a>
            <a href="{{route('Detail3DMap2', [$Render_342->id, $Render_342->secondary_workstation])}}" class="btn btn-md btn-success form-control" data-toggle="modal" data-target="#showModal2{{$Render_342->id}}">{{$Render_342->secondary_workstation}}</a>               
        </div>
        <div class="panel-footer" style="height: 38px;">
        </div>
      </div>
    </div>    
</div></div>
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