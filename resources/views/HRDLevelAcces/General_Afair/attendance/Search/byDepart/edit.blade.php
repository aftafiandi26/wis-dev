@extends('layout')

@section('title')
    (hr) Attendance - Edit
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c30003' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Attendance</h1> 
    </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <form action="{{ route('updateGetListDataGaAttendance', [$id]) }}" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="nik">NIK:</label>
        <input type="number" class="form-control" id="nik" name="nik" value="{{ $absences->nik }}" readonly="true">
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="input" class="form-control" id="name" name="name" value="{{ $absences->first_name.' '.$absences->last_name }}" readonly="true">
      </div>
      <div class="form-group">
        <label for="department">Department:</label>
        <input type="input" class="form-control" id="department" name="department" value="{{ $absences->first_name.' '.$absences->last_name }}" readonly="true">
      </div>
      <div class="form-group">
        <label for="position">Position:</label>
        <input type="input" class="form-control" id="position" name="position" value="{{ $department->dept_category_name}}" readonly="true">
      </div>
      <div class="form-group">
        <label for="check_in">Check In:</label>
        @if($absences->check_in === 1)
        <input type="time" class="form-control" id="check_in" name="check_in" value="{{ $absences->timeIN }}" readonly="true">
        @else
        <input type="time" class="form-control" id="check_in" name="check_in" value="{{ $absences->timeIN }}">
        @endif
      </div>
      <div class="form-group">
        <label for="check_out">Check Out:</label>
        @if($absences->check_out === 1)
        <input type="time" class="form-control" id="check_out" name="check_out" value="{{ $absences->timeOUT }}" readonly="true">
        @else
        <input type="time" class="form-control" id="check_out" name="check_out" value="{{ $absences->timeOUT }}" required="true">
        @endif
      </div>
      <div class="form-group">
        <label for="date">Date Attendance:</label>       
        <input type="date" class="form-control" id="date" name="date" value="{{ $absences->date_check_in }}" readonly="true">
      </div>
      <button type="submit" class="btn btn-sm btn-success">Update</button>
      <a class="btn btn-sm btn-default" href="{{ route('indexHrGaAttendace') }}">Back</a>
    </form>
  </div>
</div>
@endsection
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop