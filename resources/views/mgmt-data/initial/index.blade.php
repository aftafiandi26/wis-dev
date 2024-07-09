@extends('layout')

@section('title')
    Initial Leave
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
        <!-- <div class="col-lg-12">
            <h1 class="page-header">Users</h1>
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
    </div> -->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Entitlement Leave</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
            <table class="table table-striped table-bordered table-hover" width="100%" id="tables2">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>ID</td>
                        <td>NIK</td>                        
                        <td>First Name</td>                       
                        <td>Last Name</td>                       
                        <td>Department</td>
                        <td>Entitlement</td>
                        <td>Leave Category</td>
                        <td>Create Date</td>
                        <td>Note</td>
                        <td style="width: 78px;">Action</td>
                    </tr>
                </thead>
            </table>
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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] },
            { className: "all", "searchable": false, "orderable": false, "visible": true, "targets": 5 }
        ],
    	"order": [
    		[ 0, "asc" ]
    	],
        responsive: true,
        ajax: '{!! URL::route("mgmt-data/initial/getindexInitial") !!}'
    });

     $('#tables2').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] },
            { className: "all", "searchable": false, "orderable": false, "visible": true, "targets": 9 }
        ],
        "order": [
            [ 0, "asc" ]
        ],
        responsive: true,
        ajax: '{!! URL::route("mgmt-data/initial/getindexInitial2") !!}'
    });

    
@stop