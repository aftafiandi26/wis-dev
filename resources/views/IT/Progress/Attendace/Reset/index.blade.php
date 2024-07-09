@extends('layout')

@section('title')
    (it) Index Reset Attendance
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
        'c4' => 'active'
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
                    <th>Nik</th>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Check IN</th>
                    <th>Check Out</th>
                    <th>Duration</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
 @stop 


@section('bottom')
    @include('assets_script_1')
    @include('assets_script_3')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 
@section('script')
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
        ajax: '{!! URL::route("dev/attendance/reset/data") !!}',
        columns: [
                  { data: 'DT_Row_Index', orderable: false, searchable : false},
                  { data: 'nik'},
                  { data: 'fullName'},
                  { data: 'dept_category_id'},
                  { data: 'position'},
                  { data: 'timeIN'},
                  { data: 'timeOUT'},
                  { data: 'hours'},
                  { data: 'actions'}

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