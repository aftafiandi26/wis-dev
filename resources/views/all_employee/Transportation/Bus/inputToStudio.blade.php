@extends('layout')

@section('title')
   Input - Data - Transportaion
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c33' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Transportation Booking - To Studio</h1>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row" style="margin-bottom: 20px;">
  <div class="col-lg-1">
   <label class="radio-inline">
      <input type="radio" name="optradio" checked onclick="button1()" value="1">One Trip
    </label>
  </div> 
 <!--  <div class="col-lg-1">
    <input type="radio" name="optradio" onclick="button2()" value="2">Two Trip
  </div> -->
</div>
<form class="form-horizontal" action="{{route('storeInputToStudios')}}" method="post">  
  {{ csrf_field() }}
  <div class="row">  
  <!--  -->
  <div class="form-group">
      <label class="control-label col-sm-2" for="nik">NIK:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="nik"  name="nik" value="{{auth::user()->nik}}" readonly="true" required="true">
      </div>
  </div>
  <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="name" name="name" value="{{auth::user()->first_name.' '.auth::user()->last_name}}" readonly="true" required="true">
      </div>
  </div>
  <div class="form-group">
      <label class="control-label col-sm-2" for="department">Department:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="department" name="department" value="{{$departement->dept_category_name}}" readonly="true" required="true">
      </div>
  </div>
  <div class="form-group">
      <label class="control-label col-sm-2" for="project">Main Project:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="project" name="project" value="{{$project}}" readonly="true" required="true">
      </div>
  </div> 
  <div class="form-group">
      <label class="control-label col-sm-2" for="dated">Date:</label>
      <div class="col-sm-5">
        <input type="date" class="form-control" id="dated" name="dated" required="true">
      </div>
  </div>
  <div class="form-group" onclick="departuree()">
      <label class="control-label col-sm-2" for="departure">Departure Time:</label>
      <div class="col-sm-5">
       <select class="form-control" id="departure" name="departure" required="true">
         <option value="">-select departure-</option>
         <option value="08:00">08:00 AM</option>
         <option value="08:20">08:20 AM</option>
         <option value="08:40">08:40 AM</option>
         <option value="09:00">09:00 AM</option>
         <option value="09:20">09:20 AM</option>
         <option value="09:40">09:40 AM</option>        
       </select>
      </div>
  </div>
  <div class="form-group" id="departuree">     
  </div>   
  <div class="form-group" id="demo" onclick="arrivall()">      
  </div>
  <div class="form-group" id="arrivall">      
  </div>
   <div class="form-group">
     <label class="control-label col-sm-2"></label>
      <div class="col-sm-5">
       <button class="btn btn-sm btn-success" type="submit">save</button> 
       <a href="{{route('bookingg')}}" class="btn btn-sm btn-danger">back</a>
     </div>
   </div>
  <!--  --> 
</div>
</form>
<script>
function button1() {
  document.getElementById("demo").innerHTML = "";
  document.getElementById("arrivall").innerHTML = '';
}

function button2() {
  document.getElementById("demo").innerHTML = '<label class="control-label col-sm-2" for="arrival">Arrival Time:</label><div class="col-sm-5"><select class="form-control" id="arrival" name="arrival" required="true"><option value="">-select arrival-</option><option value="19:00">07:00 PM</option><option value="21:00">09:00 PM</option><option value="23:00">11:00 PM</option></select></div>';
}
function arrivall() {
  document.getElementById("arrivall").innerHTML = '<label class="control-label col-sm-2" for="arrival_destination">Arrival Destination:</label><div class="col-sm-5"><input type="text" class="form-control" id="arrival_destination" name="arrival_destination" value="Studio To Dormitory" required="true" readonly="true"></div>';
}
function departuree() {
  document.getElementById("departuree").innerHTML = '<label class="control-label col-sm-2" for="departure_destination">Departure Destination:</label><div class="col-sm-5"><input type="text" class="form-control" id="departure_destination" name="departure_destination" value="Dormitory To Studio" required="true" readonly="true"></div>';
}
</script>
 @stop 

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 

