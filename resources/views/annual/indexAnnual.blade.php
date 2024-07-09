@extends('layout')

@section('title')
    Annual
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
            <h1 class="page-header">Annual Post</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
			<div align="left">
				<a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="POST!!" data-toggle="tooltip" data-placement="top" href="{!! URL::route('annual_post/action') !!}"><span class="fa fa-paper-plane"></span></a>
			</div>
            
            <div>
			
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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 1] }
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

    $(document).ready(function()
{
    $("button").click(function()
    {
        //Say - $('p').get(0).id - this delete item id
        $("#delete_item_id").val( $('p').get(0).id );
        $('#delete_confirmation_modal').modal('show');
    });
});

@stop