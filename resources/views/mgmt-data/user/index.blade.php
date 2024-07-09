@extends('layout')

@section('title')
    User Data
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1' => 'active'
    ])
@stop

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data User</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
			<div align="right">
				<!-- <a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{!! URL::route('ResetAllPassword') !!}"><span class="fa fa-plus"></span></a> -->
			</div>
            
            <div>              
       
			<table class="table table-striped table-bordered table-hover" width="100%" id="tables">
				<thead>
				    <tr style="white-space:nowrap">
                        <td>ID</td>
                        <td>Username</td>
                        <td>NIK</td>                        
                        <td>First Name</td>                       
                        <td>Last Name</td>
                        <td>Department</td>
                        <td>Adm</td>
                        <td>HR</td>
                        <td>HD</td>
                        <td>GM</td>
                        <td>Active</td>
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
     @include('assets_script_7')
@stop

@section('script')
	$('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({    
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 6] }
        ],
    	"order": [
    		[ 3, "asc" ]
    	],
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": ['excel'],

        ajax: '{!! URL::route("mgmt-data/user/getindex") !!}'
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

     $(document).on('click','#tables tr td a[title="Reset Password"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
@stop
