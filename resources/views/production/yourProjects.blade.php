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
            <h1 class="page-header">{{Auth::user()->first_name}} {{Auth::user()->last_name}} Projects</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
                    <table class="table table-striped table-hover table-condensed">
                     <thead>
                            <tr style="white-space:nowrap">
                                <th>Main Project</th>                             
                            </tr>
                        </thead>
                         <tbody>
                            <tr style="white-space:nowrap">
                                <td class="bg-warning">
                                    <?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_1', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_1', '=', auth::user()->project_category_id_1)->value('project_category.project_name'); echo $k; ?>
                                </td>                        
                            </tr>
                     </table>
            </div>    
        </div>
        
    </div>
    <div class="row">       
        <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr style="white-space:nowrap">
                                <th>Project Handled</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="white-space:nowrap">
                                <td>
                                    <?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_1', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_1', '=', auth::user()->project_category_id_1)->value('project_category.project_name'); echo $k; ?>
                                </td>                        
                            </tr>
                            <?php 
                                if (Auth::user()->project_category_id_2 != NULL) {                                   
                             ?>
                            <tr style="white-space:nowrap">
                                <td>
                                    <?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_2', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_2', '=', auth::user()->project_category_id_2)->value('project_category.project_name'); echo $k; ?>
                                </td>                        
                            </tr>
                            <?php
                                } else {

                                }
                             ?>
                            <?php 
                                if (Auth::user()->project_category_id_3 != NULL) {                                   
                             ?>
                            <tr style="white-space:nowrap">
                                <td>
                                    <?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_3', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_3', '=', auth::user()->project_category_id_3)->value('project_category.project_name'); echo $k; ?>
                                </td>                        
                            </tr>
                            <?php
                                } else {
                                    
                                }
                             ?>
                             <?php 
                                if (Auth::user()->project_category_id_4 != NULL) {                                   
                             ?>
                            <tr style="white-space:nowrap">
                                <td>
                                    <?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_4', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_4', '=', auth::user()->project_category_id_4)->value('project_category.project_name'); echo $k; ?>
                                </td>                        
                            </tr>
                            <?php
                                } else {
                                    
                                }
                             ?>
                              <?php 
                                if (Auth::user()->project_category_id_5 != NULL) {                                   
                             ?>
                            <tr style="white-space:nowrap">
                                <td>
                                    <?php $k = DB::table('users')->leftJoin('project_category', 'users.project_category_id_5', '=', 'project_category.id')->where('users.id', '=', auth::user()->id)->where('project_category_id_5', '=', auth::user()->project_category_id_5)->value('project_category.project_name'); echo $k; ?>
                                </td>                        
                            </tr>
                            <?php
                                } else {
                                    
                                }
                             ?>
                        </tbody>
                    </table>
                    <p class="btn-sm"><i>Note : <br><i class="text-danger">*</i>please contact administrator if your project is different !!
                    <br><i class="text-danger">*</i>The main project will determine your leave rules, if there are differences please confirm to the administrator !!</p>
                    </i>
                </div>
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

@section('script')
	$('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
    	"order": [
    		[ 0,"des" ]
    	],
        responsive: true,        
        ajax: '{!! URL::route("getApprovalOperations") !!}'
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