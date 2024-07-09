@extends('layout')

@section('title')
    Registration Form
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
        'c65' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Status</h1>
    </div>
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-strip table-bordered" id="overtimesTables">
            <thead>
                <th>No</th>
                <th>Started</th>
                <th>Ended</th>
                <th>Coordinator</th>
                <th>Head of Department</th>
                <th>IT Verify</th>
                <th>Action</th>
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-edit">
            <!--  -->
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="modal-content-delete">
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
        ajax: '{!! URL::route("form/progressing/data") !!}',
        columns: [
            { data: 'DT_Row_Index', orderable: false, searchable : false},
            { data: 'startovertime'},
            { data: 'endovertime'},
            { data: 'app_coor'},
            { data: 'app_gm'},
            { data: 'verify_it'},
            { data: 'action'},
        ],

    });
$(document).on('click','#overtimesTables tr td a[title="Detail"]',function(e) {
    e.preventDefault();
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});

$(document).on('click','#overtimesTables tr td a[title="edit"]',function(e) {
    e.preventDefault();
    var id = $(this).attr('data-role');
    console.log(id);

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-edit").html(e);
        }
    });
});

$(document).on('click','#overtimesTables tr td a[title="delete"]',function(e) {
    e.preventDefault();
    var id = $(this).attr('data-role');
    console.log(id);

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-delete").html(e);
        }
    });
});
@stop
