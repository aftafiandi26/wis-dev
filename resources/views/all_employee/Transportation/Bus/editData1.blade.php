@extends('layout')

@section('title')
   Reschedule - Data - Transportaion
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
        <h1 class="page-header">Reschedule</h1>
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

<form class="form-horizontal" action="{{route('editData1RescheduleDataBooking', [$getData->id, $getData->key_transportation])}}" method="post">  
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
        <input type="date" class="form-control" id="dated" name="dated" required="true" value="{{$getData->date_booking}}" readonly="true">
      </div>
  </div>
  <div class="form-group" onclick="departuree()">
      <label class="control-label col-sm-2" for="departure">Departure Time:</label>
      <div class="col-sm-5">
       <select class="form-control" id="departure" name="departure" required="true">
        <option value="{{$getData->time_booking}}" selected="true">{{date("g:i A", strtotime($getData->time_booking))}}</option>
      <optgroup>-select departure</optgroup>
          <option value="08:00">08:00 AM</option>
          <option value="09:00">09:00 PM</option>         
       </select>
      </div>
  </div>
  <div class="form-group" id="departuree">     
  </div>
   <div class="form-group">
     <label class="control-label col-sm-2"></label>
      <div class="col-sm-5">
       <button class="btn btn-sm btn-warning" type="submit">edit</button> 
       <a href="{{route('bookingg')}}" class="btn btn-sm btn-danger">back</a>
     </div>
   </div>
  <!--  --> 
</div>
</form>
<script>
function departuree() {
  document.getElementById("departuree").innerHTML = '<label class="control-label col-sm-2" for="departure_destination">Departure Destination:</label><div class="col-sm-5"><input type="text" class="form-control" id="departure_destination" name="departure_destination" value="{{$getData->destination}}"  required="true" readonly="true"></div>';
}
</script>
 @stop 

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 

