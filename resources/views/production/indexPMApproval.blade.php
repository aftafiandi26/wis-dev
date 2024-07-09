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
            <h1 class="page-header">Leave Approval Project Manager</h1>
        </div>
    </div>
    <div class="row">       
        <div class="col-lg-12">           
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
                        <td>Superviosr<br>Approval</td>
                        <td>Project Manager<br>Approval</td>
                        <td>Head of Department</td>
                        <td>Status</td>
                        <td style="width: 78px;">Approval</td>
				    </tr>
				</thead>
			</table>
            </div> 
    </div>

    <?php if (auth::user()->producer === 1): ?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Leave Approval Producer</h1>
        </div>
    </div>
    <div class="row">       
        <div class="col-lg-12">           
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
                        <td>Project Manager<br>Approval</td>
                        <td>Producer</td>
                        <td>Head of Department</td>
                        <td>Status</td>
                        <td style="width: 78px;">Approval</td>
                    </tr>
                </thead>
            </table>
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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 10] }
        ],
    	"order": [
    		[ 0,"des" ]
    	],
        responsive: true,        
        ajax: '{!! URL::route("ProjectManager/getindexPMApproval") !!}'
    });
     $('#tables1').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 0,"des" ]
        ],
        responsive: true,        
        ajax: '{!! URL::route("Producer/getindexProducer_Approval") !!}'
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
@stop
