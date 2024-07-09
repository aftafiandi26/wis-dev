@extends('layout')

@section('title')
    (hr) Summary Search By Date - Attendance
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
        <h1 class="page-header">Attendance</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
        <thead>
          <tr>
            <th>No</th>
            <th>NIK</th>
            <th style="width: 150px;">Name</th>
            <th>Department</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Date</th>
            <th>Total Time</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

@stop
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
@section('script')
$('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({

        processing: true,
        responsive: true,
         "dom": 'Blfrtip',
          "buttons": [{
                extend:    'excel',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                titleAttr: 'Attendance',
                title: 'Attendance'
            }],
        ajax: '{!! URL::route("hr/attendance/search/date/index/data", [$start, $end]) !!}',
        columns: [
                  { data: 'DT_Row_Index', orderable: false, searchable : false},
                  { data: 'nik'},
                  { data: 'fullname'},
                  { data: 'department'},
                  { data: 'timeIN'},
                  { data: 'timeOUT'},
                  { data: 'date_check_in'},
                  { data: 'time'},
                ]

    });

    $(document).on('click','#tables tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id,
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

@stop
