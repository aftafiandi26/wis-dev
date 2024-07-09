@extends('layout')

@section('title')
    Summary Working on Weekends
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
    a#buttonListCrew {
        border-radius: 10px;
        background-color: darkslateblue;
        color: white;
    }

    a#buttonListCrew:hover {
        border-radius: 10px;
        background-color: rgb(117, 101, 224);
        color: rgb(250, 22, 22);
    }
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12"><h1 class="page-header">Summary - Weekend Crew</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-striped table-bordered" id="tables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Form Date</th>
                    <th>Total Crew</th>
                    <th>Status</th>
                    <th>List Crew</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="modalCrew" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true"  style="width: 90%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-list">
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

    ajax: '{{ route('working-on-weekends/summary/index/data') }}',
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false}, 
            {"data" : "formDate"},
            {"data" : "totalCrew"},
            {"data" : "approved"},
            {"data" : "listCrew"},
        
        ]
});

$(document).on('click','#tables tr td a[id="buttonListCrew"]',function(e) { 
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content-list").html(e);
        }
    });
});
@stop
