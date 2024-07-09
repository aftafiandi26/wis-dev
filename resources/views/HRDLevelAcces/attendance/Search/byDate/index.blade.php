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
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<link href="{{ asset('assets/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/assets/plugins/select2/js/select2.full.js') }}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.2/css/dataTables.dateTime.min.css">

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ $dataUser->first_name.' '.$dataUser->last_name }} Attendance</h1> 
    </div>
</div>
<div class="row" >
  <div class="col-lg-12">
    <a href="{{ route('downloadExcelListAttendance', [$startDate, $endDate, $dataUser->id]) }}" class="btn btn-info btn-sm  fa fa-download" style="margin-bottom: 5px;" title="Download Attendance {{ $dataUser->first_name.' '.$dataUser->last_name }}"></a>
    <a href="{{ route('indexHrAttendace') }}" class="btn btn-sm btn-default" style="margin-bottom: 5px;">back</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">    
    <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables">
      <thead>
        <tr>
          <th>No</th>
          <th>NIK</th>
          <th>Name</th>
          <th>Department</th>
          <th>Check In</th>        
          <th>Check Out</th>
          <th>Date</th>
          <th>Total Time</th>
          <th>Action</th>         
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dataAttendaces as $dataAttendace): ?>
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $dataUser->nik }}</td>
            <td>{{ $dataUser->first_name.' '.$dataUser->last_name }}</td>
            <td>{{ $dataDept->dept_category_name }}</td>
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
            </td>
            <td>
              <a href="{{ route('editGetListDataAttendance', [$dataAttendace->id]) }}" class="btn btn-sm btn-warning  fa fa-pencil" title="Edit"></a>
              <button type="button" class="btn btn-sm btn-success fa fa-file" data-toggle="modal" data-target="#{{ $dataAttendace->id }}" title="Detail"></button>
            </td>
          </tr>
          <div class="modal fade" id="{{ $dataAttendace->id }}" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class='modal-title'>Remarks</h4>
                    <h4>{{ $dataUser->first_name.' '.$dataUser->last_name }}</h4>
                  </div>
                  <div class="modal-body">
                     <div>
                        <h4><b>{{$dataAttendace->first_name.' '.$dataAttendace->last_name}}</b></h4>
                      </div>
                      <div class='well'>
                         <p>{{ $dataAttendace->remarks }}</p>
                      </div>                   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
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