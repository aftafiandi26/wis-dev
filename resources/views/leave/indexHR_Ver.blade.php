@extends('layout')

@section('title')
    (hr) Leave
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
            <h1 class="page-header">Leave Verification</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
			<div align="right">
				<!-- <a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{!! URL::route('mgmt-data/user/create') !!}"><span class="fa fa-plus"></span></a> -->
			</div>
            
            <div>
			<table class="table table-striped table-hover" width="100%" id="tables">
				<thead>
				    <tr>
                        <td>ID</td>
                        <td>HR Verify</td>
                        <td>HR Manager</td>                    
                        <td>NIK</td>
                        <td>Name</td>
                        <td>Leave Date</td>
                        <td>Leave Category</td>
                        <td>Title</td>
                        <td>Department</td>
                        <td>Total Day</td>
                        <td>Status</td>
                        <td style="width: 78px;">Verify</td>
				    </tr>
				</thead>
			</table>
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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 10] }
        ],
    	"order": [
    		[ 5, "asc" ]
    	],
        responsive: true,        
        ajax: '{!! URL::route("leave/getIndexLeaveHR_Ver") !!}'
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