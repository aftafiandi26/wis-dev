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
        <h1 class="page-header">Transportation Booking - From Studio</h1> 
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
      <input type="radio" name="optradio" checked>One Trip
    </label>
  </div> 
</div>

<div class="row">  
  <!--  -->
  <form class="form-horizontal" action="{{route('storeInputFromStudio')}}" method="post">
   {{ csrf_field() }}
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
  <div class="form-group">
      <label class="control-label col-sm-2" for="departure">Departure Time:</label>
      <div class="col-sm-5">
       <select class="form-control" id="departure" name="departure" required="true">
         <option value="">-select departure-</option>   
         <?php if (date('D') === "Fri" or date('D') === "Sat" or date('D') === "Sun"): ?>
          <option value="17:00">05:00 PM</option>
         <?php endif ?>
         <option value="19:00">07:00 PM</option>
         <option value="21:00">09:00 PM</option>
         <option value="23:00">11:00 PM</option>
       </select>
      </div>
  </div>
  <div class="form-group" id="demo">      
  </div>
  <div class="form-group">
      <label class="control-label col-sm-2" for="destination">Destination:</label>
      <div class="col-sm-5">
       <input type="text" class="form-control" id="destination" name="destination" value="From Studio To Dormitory" required="true" readonly="true">
      </div>
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

 @stop 

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 

