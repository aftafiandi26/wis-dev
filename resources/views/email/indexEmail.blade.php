@extends('layout')

@section('title')
    Test Email
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
            <h1 class="page-header">Test Email</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
			<div align="left">
				<a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="Test" data-toggle="tooltip" data-placement="top" href="{!! URL::route('email/send') !!}"><span class="fa fa-paper-plane"></span></a>
			</div>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
            <div>
            <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>ID</td>
                        <td>NIK</td>                        
                        <td>First Name</td>                       
                        <td>Last Name</td>                       
                        <td>Department</td>
                        <td style="width: 78px;">Action</td>
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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
    	"order": [
    		[ 0, "asc" ]
    	],
        
        responsive: true,        
        ajax: '{!! URL::route("leave/getindexTransaction") !!}'
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