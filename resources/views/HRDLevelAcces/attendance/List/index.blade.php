@extends('layout')

@section('title')
    (hr) Stocked
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3003' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Summary Attendance</h1> 
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
          <th>Check In</th>
          <th>Check Out</th>
          <th>Time</th>
          <th>Action</th>
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
    $('#tables').DataTable({
        "columnDefs": [
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [] }
        ],
        "order": [
           [0, "asc" ]
        ],
        processing: true,
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": [{
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                titleAttr: 'Attendance'
            }],
        ajax: '{!! URL::route("indexDataAttendance") !!}',
        columns: [
                  { data: 'DT_Row_Index', orderable: false, searchable : false},
                  { data: 'nik'},
                  { data: 'fullname'},
                  { data: 'date_check_in'},
                  { data: 'date_check_out'},
                  { data: 'time'},
                  { data: 'action'}
                ]

    });    
   
@stop