@extends('layout')

@section('title')
    Previlege
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
            <h1 class="page-header">User Previlege</h1>
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
                        <td>Username</td>                       
                        <td>Full Name</td>                       
                        <td>Department</td>
                        <td>Level SPV</td>
                        <td>Level Coor</td>
                        <td>Level PM</td>
                        <td>Level Producer</td>
                        <td>Level HD</td>
                        <td>Level Hr</td>
                        <td>Level HRD</td>
                        <td>Level GM</td>
                        <td>Title</td>                       
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
@stop

@section('script')
	$('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] },
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 5, 6, 7, 8, 9, 10, 11, 12] }
        ],
    	"order": [
    		[ 2, "asc" ]
    	],
        
        responsive: true,        
        ajax: '{!! URL::route("mgmt-data/previlege/getindex") !!}'
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