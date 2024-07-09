@extends('layout')

@section('title')
   Transportaion
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
        <h1 class="page-header">Booking Transportation - tes</h1> 
    </div>
</div>

<div class="row">
  <div class="col-lg-12"> 
     <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Destination</th>                     
                      <!--   <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                   <?php use App\Dept_Category; foreach ($bus as $buss): ?>
                       <tr>
                           <td>{{$no++}}</td>
                           <td>{{$buss->nik}}</td>
                           <td>{{$buss->name_employee}}</td>
                           <td><?php  $k = Dept_Category::where('id', $buss->department)->first(); echo $k->dept_category_name;?></td>
                           <td>{{$buss->date_booking}}</td>
                           <td>{{$buss->time_booking}}</td>
                           <td>{{$buss->destination}}</td>
                       </tr>
                   <?php endforeach ?>
                </tbody>
            </table>
  </div>
</div>
 @stop 

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 