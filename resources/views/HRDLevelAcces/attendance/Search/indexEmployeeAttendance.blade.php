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
  <div class="col-lg-12 ex1">
    <table class="table table-striped table-bordered table-hover table-condensed">
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

              <a class="btn btn-danger btn-sm" title="delete this data" data-toggle="modal" data-target="#deleteModal" data-role="{{ route('editGetListDataAttendance/modalDelete', $dataAttendace->id) }}" id="modalDelete"><i class="fa fa-trash"></i></a>

            </td>
          </tr>
          <!-- modal -->
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content">
            <!--  -->
        </div>
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

@section('script')

$(document).on('click','a#modalDelete',function(e) {
    var id = $(this).attr('data-role');

    console.log(id);

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});

@endsection
