@extends('layout')

@section('title')
    Rusun Report
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Rusun Report</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">            
            <div>
                <table class="table table-striped table-bordered table-hover text-nowrap" width="100%" id="tables">
                    <thead>
                        <tr>
                            <th>Address in Rusun</th>
                            <th>Rusun Status</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>NIK</th>
                            <th>End Contract</th>
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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [] }
        ],
        "order": [
            [ 0, "asc" ]
        ],
        "scrollX": true,
        "dom": 'Blfrtip',
        "buttons": ['excel'],
        ajax: '{!! URL::route("hr_mgmt-data/getIndexRusunReport") !!}'
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