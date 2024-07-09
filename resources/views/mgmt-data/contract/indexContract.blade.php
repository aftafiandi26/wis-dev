@extends('layout')

@section('title')
    Leave
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 <div class="row">
        <div class="col-lg-12">
             <h1><i class="fas fa-sync"></i> Contract Staff</h1><hr>
        </div>
    </div>
 <div class="row">
   <!--  <div class="col-lg-12">
         <a class="btn btn-sm btn-info pull-right" href="{!! URL::route('Contract-Post') !!}">Suspend</a>
        <br>
    </div>
     <div class="col-lg-12">        
        <br>
    </div> -->
 <div class = "col-lg-12">
   <table class="table table-striped table-hover" width="100%" id="tables">
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
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 7] }
        ],
        "order": [
           [ 6, "desc" ]
        ],
        
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": ['excel'],
        ajax: '{!! URL::route("End-Contract-Index") !!}'
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

