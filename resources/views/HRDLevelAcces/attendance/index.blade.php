@extends('layout')

@section('title')
    (hr) Attendance
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')

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
        <h1 class="page-header">Summary Attendance</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <form action="{{ route('hr/attendance/search/date/index') }}" method="get" class="form-inline">
        {{ csrf_field() }}
        <label for="search">Search Date :</label>
        <input type="date" name="start" id="start" class="form-control" required>
        -
        <input type="date" name="end" id="end" class="form-control" requiredj>
        <button type="submit" class="btn btn-sm btn-info fa fa-search"></button>
    </form>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-12">
    <form class="form-inline" method="get" action="{{ route('getListtAttendance') }}">
      {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Name:</label>
            <select class="form-control select2" id="name" required="true" name="name">
               <option value="">- select employee -</option>
             <?php foreach ($users as $user): ?>
               <option value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name }}</option>
             <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="start_date">Date:</label>
            <input type="date" class="form-control" name="start_date" id="start_date" required="true"></input>
            <input type="date" class="form-control" name="end_date" id="start_date" required="true"></input>
          </div>
          <div class="form-group">
            <button class="btn btn-sm btn-info  fa fa-search"></button>
          </div>
    </form>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-6">
    <form class="form-inline" method="get" action="{{ route('getDataAttendanceDepartment') }}">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="dept">Department:</label>
        <select class="form-control select2" id="dept" name="dept" required="true">
          <option value="">- select department -</option>
          <?php foreach ($dept as $department): ?>
            <option value="{{ $department->id }}">{{ $department->dept_category_name }}</option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label for="startDep">Date:</label>
        <input type="date" class="form-control" name="start_date" id="startDep" required="true"></input>
      </div>
      <div class="form-group">
            <button class="btn btn-sm btn-info  fa fa-search"></button>
      </div>
    </form>
  </div>
  <div class="col-lg-6 pull-right">
    <div class="pull-right">
      <a class="btn btn-sm btn-primary" href="{{ route('createAttendanceHR') }}">Create</a>
    </div>
  </div>
</div>
<hr>
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
          <th style="width: 200px;">Remarks</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
@endpush

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
        ajax: '{!! URL::route("indexDataAttendance") !!}',
        columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable : false},
                    
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

    $(document).ready(function() {
        $('select.select2').select2();
    });

@stop
