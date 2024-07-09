@extends('layout')

@section('title')
    WS MAP - 3D Aniamtion
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

@section('body')
  
 <div class="row">
  <h1 class="page-header">Placement Updated Map</h1>  
  </div>  

  <div class="row">        
    <div class="col-lg-12">
        <div class="col-lg-1">
          
        </div>
        <?php if (auth::user()->position === "Junior Programmer"): ?>
          <div class="col-lg-8">
            <form enctype="multipart/form-data" method="post" action="{{route('ImportData3DMap', [$animasi->id])}}">
                {{ csrf_field() }}
                <div class="input-group">  
                  <span class="input-group-addon">Post All Data</i></span>          
                    <input type="file" name="mapp" id="mapp" class="form-control">
              <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="fa fa-upload"></i></button>
              </div>
              </div>
             </form>  
           </div> 
        <?php endif ?>           
      </div>
    </div> 

  <div class="row">
    <form class="form-horizontal" action="{{route('postInputDataRender', [$animasi->id])}}" method="POST" enctype="multipart/form-data">     
        <h3>Updating WS MAP</h3>
        <hr>
      
       {{ csrf_field() }}
    <div class="form-group">
      <label class="control-label  col-lg-1" for="username">Username:</label>
      <div class=" col-lg-8">
        <input type="text" class="form-control" id="username" placeholder="Nothing" value="{{$animasi->user}}" name="username">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label  col-lg-1" for="workstation">Main Workstation:</label>
      <div class=" col-lg-8">      
        <select class="form-control" id="workstation" name="workstation">
          <optgroup label="Current Workstation">
            <option value="{{$animasi->workstation}}">{{$animasi->workstation}}</option>
          </optgroup>          
          <optgroup label="Move to Workstation">
            <option value=""> </option>
            <?php foreach ($AvailabilityMap as $avaMap): ?>
              <option value="{{$avaMap->hostname}}">{{$avaMap->hostname}}</option>
            <?php endforeach ?>
          </optgroup>
        </select>
      </div>
    </div>
 <div class="form-group">
      <label class="control-label  col-lg-1" for="monitor1">Main Monitor:</label>
      <div class=" col-lg-8">
        <input type="text" class="form-control" id="monitor1" placeholder="Nothing" value="{{$animasi->monitor1}}" name="monitor1">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label  col-lg-1" for="monitor2">Secondary Monitor:</label>
      <div class=" col-lg-8">
        <input type="text" class="form-control" id="monitor2" placeholder="Nothing" value="{{$animasi->monitor2}}" name="monitor2">

      </div>
    </div>
    <div class="form-group">
      <label class="control-label  col-lg-1" for="no_seat">No Seat:</label>
      <div class=" col-lg-8">
        <input type="number" min="1" class="form-control" id="no_seat" placeholder="Nothing" value="{{$animasi->no_seat}}" name="no_seat" required="true" readonly="true">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label  col-lg-1" for="area">Area:</label>
      <div class=" col-lg-8">       
        <!-- <select class="form-control" id="area" name="area" required="true">
          <optgroup label="Current Area">
            <option value="{{$animasi->area}}">{{$animasi->area}}</option>
          </optgroup>
          <optgroup label="Move to Area">            
              <option value="3D Animation">3D Animation</option>
              <option value="Layout">Layout</option>
              <option value="Render">Render</option>
              <option value="Officer">Officer</option>
              <option value="IT Room">IT Room / WereHouse</option>
          </optgroup>
        </select> -->
        <input type="text" name="area" required="true" readonly="" value="{{$animasi->area}}" class="form-control">
      </div>
    </div>
     <div class="form-group">        
      <div class=" col-lg-offset-1  col-lg-12">       
          <button type="submit" class="btn btn-sm btn-success" title="Update Data">Save</button>
          <a href="{{route('indexRender')}}" class="btn btn-sm btn-warning" title="Back to Index MAP">Back</a>
      </div>     
    </div>
   
      <hr>
  <?php if ($ws_availability != null): ?>     
   
  <h3>View Workstation</h3>
    <hr>
     <div class="form-group">
      <label class="control-label  col-lg-1" for="no_seat">Hostname:</label>
      <div class=" col-lg-8">
        <input type="text" class="form-control" id="hostname" placeholder="Nothing" value="{{$ws_availability->hostname}}" name="hostname" readonly="true">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label  col-lg-1" for="type">Type:</label>
      <div class=" col-lg-8">
        <input type="text" class="form-control" id="type" placeholder="Nothing" value="{{$ws_availability->type}}" name="type" readonly="true">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label  col-lg-1" for="name">Username:</label>
      <div class=" col-lg-8">
        <input type="text" class="form-control" id="name" placeholder="Nothing" value="{{$ws_availability->user}}" name="name" readonly="true">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label  col-lg-1" for="os">Operation System:</label>
      <div class=" col-lg-8">       
        <select class="form-control" id="os" name="os" readonly="true">
          <optgroup label="Current OS">
            <option value="{{$ws_availability->os}}">{{$ws_availability->os}}</option>
          </optgroup>
          <optgroup label="Move to OS">
            <option value="Linux">Linux</option>
            <option value="Windows">Windows</option>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label  col-lg-1" for="memory">Memory:</label>
      <div class=" col-lg-8">
        <input type="text" class="form-control" id="memory" placeholder="Nothing" value="{{$ws_availability->memory}}" name="memory" readonly="true">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label  col-lg-1" for="vga">VGA:</label>
      <div class=" col-lg-8">
        <input type="text" class="form-control" id="vga" placeholder="Nothing" value="{{$ws_availability->vga}}" name="vga" readonly="true">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label  col-lg-1" for="notes">Notes:</label>
      <div class=" col-lg-8 ">
        <input type="text" class="form-control" id="notes" placeholder="Nothing" value="{{$ws_availability->notes}}" name="notes" readonly="true">
      </div>
    </div>      
  </form>
  </div>
<?php else: ?>

<?php endif ?> 
@stop
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop