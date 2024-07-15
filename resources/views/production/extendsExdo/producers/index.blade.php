@extends('layout')

@section('title')
    Producer - Extended of Exdo
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@push('style')
<style>
    .text-center {
        text-align: center;
    }
</style>
@endpush

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop

@section('body')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Extended of Exdo</h1>
    </div>
</div>  
<div class="row">
    <div class="col-lg-6">
        <table class="table table-hover table-stripped table-condensed table-bordered" width="100%" id="tableExtends">
            <thead>
                <tr>
                    <th colspan="7" class="text-center">Approval Extended</th>
                </tr>
                <tr>
                    <th>No</th>                    
                    <th>Requestor</th>
                    <th>Employes</th>
                    <th>Exdo</th>
                    <th>Expired</th>
                    <th>Changed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>        
    </div>
    <div class="col-lg-6">
        <table class="table table-hover table-stripped table-condensed table-bordered" width="100%" id="tableSummary">
            <thead>
                <tr>
                    <th colspan="7" class="text-center">Summary Extended</th>
                </tr>
                <tr>
                    <th>No</th>                    
                    <th>Employes</th>
                    <th>Exdo</th>
                    <th>Expired</th>
                    <th>Changed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
        
    </div>
</div>

<div class="modal fade" id="showModalApproval" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content-approval">
            <!--  -->
        </div>
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_7')
@stop

@section('script')

$('#tableExtends').DataTable({
    processing: true,
    responsive: true,
    ajax: {
        "url": "{{ route('producer/exdo-exntend/data') }}",
        "type": "GET",
    },
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},   
        { data: 'coor'},
        { data: 'employee'},
        { data: 'amount'},
        { data: 'init_expired'},
        { data: 'expired'},
        { data: 'status'},
        { data: 'actions', orderable: false, searchable: false},
    ],
});

$(document).on('click','#tableExtends tr td a[id="approval"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-approval").html(e);
        }
    });
});
@stop