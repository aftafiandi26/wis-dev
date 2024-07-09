@extends('layout')

@section('title')
    Leave Report
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
        <div class="col-lg-8">
            <h1 class="page-header">Leave Report HRD</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table table-hover table-condensed" id="tables1">
                    <thead>
                        <tr>
                            <th>Leave Report</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Leave Entitled Report</td>
                            <td>
                                <a href="{!! URL::route('hr_mgmt-data/leaveEntitledReport') !!}" class="btn btn-primary btn-xs" role="button">Preview</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Leave Transaction Report</td>
                            <td>
                                <a href="{!! URL::route('hr_mgmt-data/leaveTransactionReport') !!}" class="btn btn-primary btn-xs" role="button">Preview</a>
                            </td>
                        </tr>
                    </tbody>
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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
    	"order": [
    		[ 0, "asc" ]
    	],        
        responsive: true,        
        ajax: '{!! URL::route("management-data/leaveEntitledReport") !!}'
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