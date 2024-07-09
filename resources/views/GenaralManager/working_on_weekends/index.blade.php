@extends('layout')

@section('title')
    Working on Weekends - Approved
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
    table a#detail {
        background-color: greenyellow;
        color: black;
        border-radius: 7px;
    }
    table a#detail:hover {
        background-color: rgb(143, 215, 36);
        color: black;
        border-radius: 7px;
    }   
    .panel-heading {
        text-align: center;
    }
    span#homan {        
        color: red;
    }
    .panel:hover {
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
    }   
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12"><h1 class="page-header">Weekend Crew</h1>
    </div>
</div>

<div class="row">
    <div class="panel-group">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Form Weekend Crew <span id="homan">(Allowanace)</span></div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped table-bordered" width="100%" id="allowance">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Coordinator</th>
                                <th>Position</th>
                                <th>Project</th>
                                <th>Count</th>                    
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Form Weekend Crew <span id="homan">(Exdo)</span></div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped table-bordered" width="100%" id="exdo">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Coordinator</th>
                                <th>Position</th>
                                <th>Project</th>
                                <th>Count</th>                    
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
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
$('table#allowance').DataTable({
    processing: true, 
    responsive: true, 

    ajax: '{{ route('gm/working-on-weekends/index/allowance/data') }}',
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false},   
            {"data": "fullname"},        
            {"data": "position"},        
            {"data": "project"},        
            {"data": "allowance"},        
            {"data": "approved"},
            {"data": "actions"},
        ]
});

$(document).on('click','#allowance tr td a[id="detail"]',function(e) {
    var id = $(this).attr('data-role');

    console.log(id);

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});

$('table#exdo').DataTable({
    processing: true, 
    responsive: true, 

    ajax: '{{ route('gm/working-on-weekends/index/exdo/data') }}',
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false},   
            {"data": "fullname"},        
            {"data": "position"},        
            {"data": "project"},        
            {"data": "exdo"},        
            {"data": "approved"},
            {"data": "actions"},
        ]
});

$(document).on('click','#exdo tr td a[id="detail"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});

@stop
