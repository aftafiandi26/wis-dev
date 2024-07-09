@extends('layout')

@section('title')
    (hr) Temporary Initial Leave
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c17' => 'active'
    ])
@stop

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
			<table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables">
				<thead>
				    <tr style="white-space:nowrap">
                        <td>No</td>
                        <td>NIK</td>          
                        <td>Name</td>
                        <td>Department</td>
                        <td>Join Date</td>    
                        <td>End Date</td> 
                        <td>Initial Annual</td>
                        <td>Annual Balance</td>
                        <td>Exdo Balance</td>
                        <td>Total Balance</td>
                        <td style="width: 78px;">Action</td>
				    </tr>
				</thead>
			</table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Carry Over</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
            <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables2">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>ID</td>
                        <td>NIK</td>        
                        <td>Name</td>      
                        <td>Leave Date</td>
                        <td>End Leave Date</td>
                        <td>Total Day</td> 
                        <td>Leave Category</td>
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
    @include('assets_script_7')
@stop

@section('script')
	$('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] },
            { className: "all", "searchable": false, "orderable": false, "visible": true, "targets": 5 }
        ],
    	"order": [
    		[ 2, "asc" ]
    	],
        "scrollX": true,
        "dom": 'Blfrtip',
        "buttons": ['excel'],
         processing: true,
        responsive: true,           
        ajax: '{!! URL::route("hr_mgmt-data/leave/getIndexTempInitialLeave") !!}'
    });

    $('#tables2').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] },
            { className: "all", "searchable": false, "orderable": false, "visible": true, "targets": 5 }
        ],
        "order": [
            [ 0, "asc" ]
        ],
        responsive: true,
        ajax: '{!! URL::route("hr_mgmt-data/leave/getIndexTempInitialAnnualLeave") !!}'
    });
@stop