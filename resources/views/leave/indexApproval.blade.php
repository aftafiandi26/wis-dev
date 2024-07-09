@extends('layout')

@section('title')
    (hd) Leave
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
            <h1 class="page-header">Leave Approval</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">	
            <div>
			<?php if (auth::user()->dept_category_id != 3): ?>
             <table class="table table-striped table-hover" width="100%" id="tables">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Leave Date</td>
                        <td>NIK</td>
                        <td>Name</td>
                        <td>Leave Category</td>
                        <td>Department</td>
                        <td>Total Day</td>                      
                        <td>Head <br>of Department Approval</td>
                        <td>HR Verify</td>
                        <td>Status</td>
                        <td style="width: 78px;">Approval</td>
                    </tr>
                </thead>
            </table>   
            <?php endif ?>
            <?php if (auth::user()->dept_category_id == 3): ?>
             <table class="table table-striped table-hover" width="100%" id="tablesHRD">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Leave Date</td>
                        <td>NIK</td>
                        <td>Name</td>
                        <td>Leave Category</td>
                        <td>Department</td>
                        <td>Total Day</td>                      
                        <td>HR Verify</td>
                        <td>Head <br>of Department Approval</td>
                        <td>Status</td>
                        <td style="width: 78px;">Approval</td>
                    </tr>
                </thead>
            </table>   
            <?php endif ?>
            </div>
        </div>
    </div>
   <?php if (auth::user()->dept_category_id === 7): ?>
    <hr> 
     <div class="row">
        <div class="col-lg-12"> 
            <div>
            <table class="table table-striped table-hover" width="100%" id="tables1">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Leave Date</td>
                        <td>NIK</td>
                        <td>Name</td>
                        <td>Leave Category</td>
                        <td>Department</td>
                        <td>Total Day</td>                      
                        <td>Head <br>of Studio Approval</td>
                        <td>HR Verify</td>
                        <td>Status</td>
                        <td style="width: 78px;">Approval</td>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>  
     <hr> 
     <div class="row">
        <div class="col-lg-12"> 
            <div>
            <table class="table table-striped table-hover" width="100%" id="tables2">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Leave Date</td>
                        <td>NIK</td>
                        <td>Name</td>
                        <td>Leave Category</td>
                        <td>Department</td>
                        <td>Total Day</td>                      
                        <td>Head <br>of Studio Approval</td>
                        <td>HR Verify</td>
                        <td>Status</td>
                        <td style="width: 78px;">Approval</td>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>   
   <?php endif ?>

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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 9] }
        ],
    	"order": [
    		[ 0,"des" ]
    	],
        responsive: true,        
        ajax: '{!! URL::route("leave/getindexHD_Approval") !!}'
    });

    $('#tables1').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 9] }
        ],
        "order": [
            [ 0,"des" ]
        ],
        responsive: true,        
        ajax: '{!! URL::route("leave/getIndexLeaveApprovalForFacilities") !!}'
    });

    $('#tables2').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 9] }
        ],
        "order": [
            [ 0,"des" ]
        ],
        responsive: true,        
        ajax: '{!! URL::route("leave/getIndexLeaveMiaSinaga") !!}'
    });

    $('#tablesHRD').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 9] }
        ],
        "order": [
            [ 0,"des" ]
        ],
        responsive: true,        
        ajax: '{!! URL::route("leave/HRApproval") !!}'
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

    $(document).on('click','#tables1 tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

    $(document).on('click','#tables2 tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

     $(document).on('click','#tablesHRD tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

@stop