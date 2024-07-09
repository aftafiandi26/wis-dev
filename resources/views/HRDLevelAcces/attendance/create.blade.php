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
        <h1 class="page-header">Create Attendance</h1> 
    </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <form action="{{ route('postCreatedAttendanceHR') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="name">Name:</label>
       <select class="form-control" name="name" required="true">
         <option>-select-</option>
         <?php foreach ($users as $user): ?>
          <option value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name }}</option>           
         <?php endforeach ?>
       </select>
      </div>
       <div class="form-group">
        <label for="position">Check In:</label>
        <input type="time" class="form-control" id="check_in" name="check_in" required="true">
      </div>
       <div class="form-group">
        <label for="date">Date Attendance:</label>       
        <input type="date" class="form-control" id="date" name="date" required="true">
      </div>
      <div class="form-group">
        <label for="remark">Remarks</label>
        <textarea class="form-control" name="remarks" title="remark" maxlength="100" placeholder="max word 100 !!" required="true"></textarea>
      </div>
      <button type="submit" class="btn btn-sm btn-success">Check In</button>
      <a class="btn btn-sm btn-default" href="{{ route('indexHrAttendace') }}">Back</a>
    </form>
  </div>
</div>
@endsection
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop