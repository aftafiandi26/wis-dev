@extends('layout')

@section('title')
    (hr) User Project
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
            <h1 class="page-header"> User Project</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div>
                <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
                    <thead>
                        <tr style="white-space:nowrap">
                            <td>ID</td>
                            <td>NIK</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Project 1</td>
                            <td>Project 2</td>
                            <td>Project 3</td>                            
                            <td style="width: 78px;">Action</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div align="right">
                <a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{!! URL::route('hr_mgmt-data/userProject/create') !!}"><span class="fa fa-plus"></span></a>
            </div>
            <div>
            <table class="table table-striped table-bordered table-hover" width="100%" id="tables2">
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
            { className: "all", "searchable": false, "orderable": false, "visible": true, "targets": 7 }
        ],
    	"order": [
    		[ 0, "asc" ]
    	],
        responsive: true,
        ajax: '{!! URL::route("hr_mgmt-data/userProject/getindexUserProject") !!}'
    });
@stop