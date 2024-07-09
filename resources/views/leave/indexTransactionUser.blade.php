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
            <h1 class="page-header">Leave Transactions</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
			<div align="right">
				<!-- <a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{!! URL::route('mgmt-data/user/create') !!}"><span class="fa fa-plus"></span></a> -->
			</div>
         
             <div>  
            <?php if (Auth::user()->dept_category_id != 6) { ?>
                 <?php if (auth::user()->dept_category_id === 4): ?>
                     <table class="table table-striped table-hover" width="100%" id="tablesOperations">
                        <thead>
                              <td>ID</td>
                                <td>NIK</td>
                                <td>Name</td>
                                <td>Leave Category</td>
                                <td>Leave Date</td>
                                <td>Total Day</td>                        
                                <td>Head of Department Approval</td> 
                                <td>HR Verify</td>
                                <td>HRD Approval</td>  
                                <td>resend</td>
                                <td>statOff</td>
                                <td style="width: 78px;">Detail</td>
                                <td>Reminder</td>
                                <td>Delete</td>
                        </thead>
                    </table>
                <?php elseif (auth::user()->dept_category_id === 3):?>
                    <table class="table table-striped table-hover" width="100%" id="tablesHRD">
                        <thead>
                              <td>ID</td>
                                <td>NIK</td>
                                <td>Name</td>
                                <td>Leave Category</td>
                                <td>Leave Date</td>
                                <td>Total Day</td>
                                <td>HR Verify</td>
                                <td>HR Manager Approval</td>  
                                <td>resend</td>
                                <td>statOff</td>
                                <td style="width: 78px;">Detail</td>
                                <td>Reminder</td>
                                <td>Delete</td>
                        </thead>
                    </table>
                 <?php else: ?>
                    <table class="table table-striped table-hover" width="100%" id="tablesOfficer">
                        <thead>
                                <td>ID</td>
                                <td>NIK</td>
                                <td>Name</td>
                                <td>Leave Category</td>
                                <td>Leave Date</td>
                                <td>Total Day</td>                        
                                <td>Head of Department Approval</td> 
                                <td>HR Verify</td>
                                <td>HRD Approval</td>  
                                <td>resend</td>
                                <td>StatOff</td> 
                                <td style="width: 78px;">Detail</td>
                                <td>Reminder</td>                                
                                <td>Delete</td>  
                                               
                        </thead>
                    </table>
                 <?php endif ?>                    
           <?php }
                else
                {
                    if (Auth::user()->level_hrd === 'Junior Pipeline' or auth::user()->level_hrd === 'Senior Pipeline' or auth::user()->level_hrd === 'Technical Director') {
            ?>
                     <table class="table table-striped table-hover" width="100%" id="tablesPipeline">
                    <thead>
                            <td>ID</td>
                            <td>NIK</td>
                            <td>Name</td>
                            <td>Leave Category</td>
                            <td>Leave Date</td>
                            <td>Total Day</td>
                            <td>Pipeline<br>Approval</td>
                            <td>Head of Department<br>Approval</td>
                            <td>HR Verification</td>
                            <td>HR Manager Approval</td>
                            <td>resend</td>
                            <td>statOff</td>
                            <td style="width: 78px;">Detail</td>                           
                            <td>Reminders</td>
                            <td>Delete</td>
                    </thead>
                </table>
                   
                     <?php   
                    }
                    else { ?>
                        <!-- Production -->
            <table class="table table-striped table-hover" width="100%" id="tablesProduction">
                <thead>
                       <td>ID</td>
                        <td>NIK</td>
                        <td>Name</td>
                        <td>Leave Category</td>
                        <td>Leave Date</td>
                        <td>Total Day</td>
                        <td>Koordinator<br>Aprroval</td> 
                        <td>SPV Approval</td>                      
                        <td>Project Manager<br>Aprroval</td> 
                        <td>Producer</td>                      
                        <td>HD<br> Approval</td> 
                        <td>HR<br>Verification</td> 
                        <td>HRD Approval</td>
                        <td>resend</td>
                        <td>statOff</td>
                        <td style="width: 78px;">Detail</td>
                        <td>Reminder</td>
                        <td>Delete</td>
                </thead>
            </table>
        <?php }} ?>
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

    $('#tablesOfficer').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 9, 10] }
        ],
    	"order": [
    		[ 0, "des" ]
    	],
         processing: true,
        responsive: true,        
        ajax: '{!! URL::route("leave/getindexTransaction") !!}'
    });

    $(document).on('click','#tablesOfficer tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

     $('#tablesPipeline').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 10, 11] }
        ],
        "order": [
            [ 0, "des" ]
        ],
         processing: true,
        responsive: true,        
        ajax: '{!! URL::route("leave/indexLeaveTransactionPipiline") !!}'
    });

    $(document).on('click','#tablesPipeline tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

    $('#tablesProduction').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 13, 14] }
        ],
        "order": [
            [ 0, "des" ]
        ],
         processing: true,
        responsive: true,        
        ajax: '{!! URL::route("leave/getIndexTransactionProduction") !!}'
    });

    $(document).on('click','#tablesProduction tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

    $('#tablesOperations').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 9, 10] }
        ],
        "order": [
            [ 0, "des" ]
        ],
         processing: true,
        responsive: true,        
        ajax: '{!! URL::route("leave/getIndexTransactionOperation") !!}'
    });

    $(document).on('click','#tablesOperations tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

    $('#tablesHRD').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 8, 9] }
        ],
        "order": [
            [ 0, "des" ]
        ],
         processing: true,
        responsive: true,        
        ajax: '{!! URL::route("leave/getIndexLeaveTransactionHRD") !!}'
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