@extends('layout')

@section('title')
   Working on Weekends- Summary
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
        border-radius: 7px;
    }   
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12"><h1 class="page-header">Summary - Working on Weekends</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-striped table-bordered" width="100%" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Emloyes</th>
                    <th>Coordinator</th>
                    <th>Producer</th>
                    <th>Position</th>
                    <th>Project</th>
                    <th>Start</th>                    
                    <th>End</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
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
$('table#tables').DataTable({
    processing: true, 
    responsive: true, 

    ajax: '{{ route('gm/working-on-weekends/summary/data') }}',
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false},   
            {"data": "employes"},        
            {"data": "coordinator"},        
            {"data": "producer"},        
            {"data": "position"},        
            {"data": "project"},        
            {"data": "start"},        
            {"data": "end"},
            {"data": "time"},
            {"data": "approved"},
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
