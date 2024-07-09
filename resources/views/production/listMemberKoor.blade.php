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
   <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">List Members</h1>
    </div>       
   </div>

   <div class="row">
    <div class="col-lg-12">
        <p><b><?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_1', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_1', '=', auth::user()->project_category_id_1)->value('project_category.project_name'); echo $k; ?> Members</b></p>
    </div>
     <div class="col-lg-12">
         <table class="table table-striped table-hover" width="100%" id="tables">
             <thead>
                <th>ID</th>
                <th>NIK</th>
                <th>Username</th>
                 <th>First Name</th>
                <th>Last Name</th>             
            </thead>
         </table>
    </div>    
   </div>
   <br>
    <?php if (auth::user()->project_category_id_2 != null) {           
       ?>
   <div class="row">
    <div class="col-lg-12">
        <p><b><?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_2', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_2', '=', auth::user()->project_category_id_2)->value('project_category.project_name'); echo $k; ?> Members</b></p>
    </div>
     <div class="col-lg-12">
         <table class="table table-striped table-hover" width="100%" id="tables2">
             <thead>
                <th>ID</th>
                <th>NIK</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
            </thead>
         </table>
    </div>    
   </div>
   <?php } else {} ?>
   <br>
   <?php if (auth::user()->project_category_id_3 != null) {           
       ?>
   <div class="row">
    <div class="col-lg-12">
        <p><b><?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_3', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_3', '=', auth::user()->project_category_id_3)->value('project_category.project_name'); echo $k; ?> Members</b></p>
    </div>
     <div class="col-lg-12">
         <table class="table table-striped table-hover" width="100%" id="tables3">
             <thead>
                <th>ID</th>
                <th>NIK</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
            </thead>
         </table>
    </div>    
   </div>
   <?php } else {} ?>
   <br>
    <?php if (auth::user()->project_category_id_4 != null) {           
       ?>
   <div class="row">
    <div class="col-lg-12">
        <p><b><?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_4', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_4', '=', auth::user()->project_category_id_4)->value('project_category.project_name'); echo $k; ?> Members</b></p>
    </div>
     <div class="col-lg-12">
         <table class="table table-striped table-hover" width="100%" id="tables4">
             <thead>
                <th>ID</th>
                <th>NIK</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
            </thead>
         </table>
    </div>    
   </div>
   <?php } else {} ?>
   <br>
    <?php if (auth::user()->project_category_id_5 != null) {           
       ?>
   <div class="row">
    <div class="col-lg-12">
        <p><b><?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_5', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_5', '=', auth::user()->project_category_id_5)->value('project_category.project_name'); echo $k; ?> Members</b></p>
    </div>
     <div class="col-lg-12">
         <table class="table table-striped table-hover" width="100%" id="tables5">
             <thead>
                <th>ID</th>
                <th>NIK</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
            </thead>
         </table>
    </div>    
   </div>
   <?php } else {} ?>


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
@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 2,"asc" ]
        ],
        responsive: true,        
        ajax: '{!! URL::route("getList761") !!}'
    });

    $('#tables2').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 2,"asc" ]
        ],
        responsive: true,        
        ajax: '{!! URL::route("getList22") !!}'
    });

    $('#tables3').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 2,"asc" ]
        ],
        responsive: true,        
        ajax: '{!! URL::route("getList33") !!}'
    });

    $('#tables4').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 2,"asc" ]
        ],
        responsive: true,        
        ajax: '{!! URL::route("getList44") !!}'
    });

     $('#tables5').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 2,"asc" ]
        ],
        responsive: true,        
        ajax: '{!! URL::route("getList55") !!}'
    });
@stop
