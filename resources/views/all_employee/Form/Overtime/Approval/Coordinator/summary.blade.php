@extends('layout')

@section('title')
    Summary Registration Form
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c69' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Summary Registration Form</h1>
    </div>
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-strip table-bordered" id="overtimesTables">
            <thead>
                <th>No</th>
                <th>Form</th>
                <th>NIK</th>
                <th>Employee</th>
                <th>Position</th>
                <th>Started</th>
                <th>Ended</th>
                <th>Coordinator</th>
                <th>General Manager</th>
                <th>IT Verify</th>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="modalProject" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
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
$('#overtimesTables').DataTable({
        processing: true,
        responsive: true,
        ajax: '{!! URL::route("form/summary/overtime/coordinator/data") !!}',
        columns: [
            { data: 'DT_Row_Index', orderable: false, searchable : false},
            { data: 'type'},
            { data: 'nik'},
            { data: 'fullname'},
            { data: 'position'},
            { data: 'startovertime'},
            { data: 'endovertime'},
            { data: 'app_coor'},
            { data: 'app_gm'},
            { data: 'verify_it'},
        ],

    });
$(document).on('click','#overtimesTabless tr td a[title="Detail"]',function(e) {
    e.preventDefault();
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});

@stop
