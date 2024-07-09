@extends('layout')

@section('title')
    (hr) Index Contract Employee
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')

 <div class="row">
        <div class="col-lg-12">
             <h1>Contract Employee</h1><hr>
        </div>
      <div class="col-lg-12">
            <div align="right">
        <!--  {!! Form::open(['route' => 'upload-update', 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
         {{ csrf_field() }} 
          <label for="photo">
                <input type="file" name="photo" id="photo" >
            </label>
       <button class="fa fa-upload btn btn-sm btn-warning" data-original-title="Upload Data Employee" data-toggle="tooltip" data-placement="bottom" style="color: black; text-align: left; width: 200px;">  Upload File Update Employee</button>
         {!! Form::close() !!} -->
     </div> 
    </div>
    <hr class="my-5">
    </div>
    
 <div class="row">
 <div class = "col-lg-12">
   <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
    <thead>
      <tr>
        <th>ID</th>
        <th>NIK</th>
        <th>Fist Name</th>
        <th>Last Name</th>
        <th>Department</th>
        <th>Join Date</th>
        <th>End Date</th>
        <th>Status</th>
        <th>Actions</th>
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
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 6, "desc" ]
        ],
        "processing": true,
        "scrollX": true,
        "dom": 'Blfrtip',
        "buttons": ['excel'],
        ajax: '{!! URL::route("getContract") !!}'
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
