@extends('layout')

@section('title')
    Registration Form Working on Weekends
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'workingWeekends01' => 'active'
    ])
@stop
@push('style')
<style>
    table#tables a#detail {
        background-color: greenyellow;
        color: black;
        border-radius: 7px;
    }
    table#tables a#detail:hover {
        background-color: rgb(143, 215, 36);
        color: black;
        bord
    }
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12"><h1 class="page-header">Weekend Crew</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table-condensed table-bordered table-striped table-hover" id="tables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Coordinator</th>
                    <th>Position</th>
                    <th>Project</th>
                    <th>Total Crew</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal fade" id="modalApproved" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content">
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
$('table#tables').DataTable({
    processing: true, 
    responsive: true, 
    ajax: '{{ route('producer/weekend-crew/index/data') }}',
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false},   
            {"data": "coor_name"},
            {"data": "position"},
            {"data": "project"},
            {"data": "count"},
            {"data": "ap_producer"},
            {"data": "actions"},
        ]
});
$(document).on('click','#tables tr td a[id="detail"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});
@stop
