@extends('layout')

@section('title')
   (Adm) Index Production Access
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
            <h1>Production Access</h1>
        </div>
    </div>
 <div class="row"> 
 <div class = "col-lg-12">
   <table class="table table-striped table-hover" width="100%" id="tables">
    <thead>
      <tr>
        <th>ID</th>
        <th>NIK</th>
        <th>Fist Name</th>
        <th>Last Name</th>
        <th>Department</th>
        <th>Position</th>
        <th>Title</th>
        <th>Level Access</th>      
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
            [ 0, "asc" ]
        ],
        
        responsive: true,       
        ajax: '{!! URL::route("getProduction") !!}'
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

