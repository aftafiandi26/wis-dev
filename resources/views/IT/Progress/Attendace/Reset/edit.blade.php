@extends('layout')

@section('title')
    (it) Edit Reset Attendance
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c4' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Edit Attendance</h1> 
    </div>
</div>

<div class="row">
 <div class="col-lg-12">
     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
 </div> 
</div>

<form method="post" action="{{ route('dev/attendance/reset/update', $absences->id) }}">
    {{ csrf_field() }}
    <div class="row">
       <div class="col-lg-2">
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" class="form-control" id="nik" value="{{ $absences->nik }}" readonly>
            </div>  
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="employee">Employe:</label>
                <input type="text" class="form-control" id="employee" value="{{ $absences->first_name.' '.$absences->last_name }}" readonly>
            </div>  
        </div> 
        <div class="col-lg-2">
            <div class="form-group">
                <label for="dept">Department:</label>
                <input type="text" class="form-control" id="dept" value="{{ $dept }}" readonly>
            </div>  
        </div> 
        <div class="col-lg-2">
            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" class="form-control" id="position" value="{{ $absences->position }}" readonly>
            </div>  
        </div>    
    </div>

    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="timeIN">Time In:</label>
                <input type="time" name="timeIN" class="form-control" id="timeIN" value="{{ $absences->timeIN }}">
            </div>            
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="timeOUT">Time Out:</label>
                <input type="time" name="timeOUT" class="form-control" id="timeOUT" value="{{ $absences->timeOUT }}">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="checkOut">Cek Out:</label>
                <input type="text" name="checkOut" class="form-control" id="checkOut" value="{{ $absences->check_out }}">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="hours">Duration:</label>
                <input type="text" name="hours" class="form-control" id="timeOUT" value="{{ $absences->hours }}">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="dateIn">Date Check In:</label>
                <input type="date" name="dateIn", class="form-control" id="dateIn" value="{{ $absences->date_check_in }}" >
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="dateOut">Date Check Out:</label>
                <input type="date" name="dateOut", class="form-control" id="dateOut" value="{{ $absences->date_check_out }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('dev/attendance/reset') }}" class="btn btn-default">back</a>
        </div>
    </div>
    
</form>
    
 @stop 


@section('bottom')
    @include('assets_script_1')
    @include('assets_script_3')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 