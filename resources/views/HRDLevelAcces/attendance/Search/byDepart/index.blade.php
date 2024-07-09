@extends('layout')

@section('title')
    (hr) Attendance
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
<style type="text/css">
  div.ex1 {
  height: 75%;
  width: 100%;
  overflow-y: scroll;
}
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Attendance {{ $department->dept_category_name or ''}}</h1> 
    </div>
</div>
<div class="row" style="margin-bottom: 5px;">
  <div class="col-lg-12">
   <a class="btn btn-sm btn-info fa fa-download" title="download" href="{{ route('downloadExcelListAllAttendance', [$start_date, $department->id]) }}"></a>
   <a class="btn btn-sm btn-default" href="{{ route('indexHrAttendace') }}">back</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 ex1">    
    <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables">
      <thead>
        <tr>
          <th>No</th>
          <th>NIK</th>
          <th>Name</th>
          <th>Check In</th>        
          <th>Check Out</th>
          <th>Date</th>
          <th>Total Time</th>  <!-- 
          <th>Action</th>  -->
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dataAttendaces as $dataAttendace): ?>
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $dataAttendace->nik }}</td>
            <td>{{ $dataAttendace->first_name.' '.$dataAttendace->last_name }}</td>
            <td>{{ $dataAttendace->timeIN }}</td>
            <td>{{ $dataAttendace->timeOUT }}</td>
            <td>
                <?php if ($dataAttendace->check_out === 1): ?>
                  {{ $dataAttendace->date_check_out }}
                <?php else: ?>
                  {{ $dataAttendace->date_check_in }}
                <?php endif ?>
            </td>
            <td>
              <?php 

                  $awal  = strtotime($dataAttendace->timeIN); //waktu awal
                  $akhir = strtotime($dataAttendace->timeOUT); //waktu akhir

                  $diff  = $akhir - $awal;

                  $jam   = floor($diff / (60 * 60));
                  $menit = $diff - $jam * (60 * 60);
                  $detik = $diff - $menit * (60 * 60 * 60);

                  $waktu = $jam .' jam, ' . floor( $menit / 60 ) . ' menit';

                  if ($dataAttendace->check_out === 1) {
                    echo $waktu;
                  }
                  else{
                    echo "--";
                  }                  
               ?>
            </td><!-- 
             <td>
              <a href="{{ route('editGetListDataAttendance', [$dataAttendace->id]) }}" class="btn btn-sm btn-warning  fa fa-pencil" title="Edit"></a>
              <button type="button" class="btn btn-sm btn-success fa fa-file" data-toggle="modal" data-target="#{{ $dataAttendace->id }}" title="Detail"></button>
            </td> -->
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