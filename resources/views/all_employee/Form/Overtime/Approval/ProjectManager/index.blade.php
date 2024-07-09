@extends('layout')

@section('title')
    Approval Form
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
        'c67' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Approval Form</h1>
    </div>
</div>

<div class="row">
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-strip table-bordered" id="approvalOvertime">
            <thead>
                <th>No</th>
                <th>Form</th>
                <th>NIK</th>
                <th>Employee</th>
                <th>Position</th>
                <th>Started</th>
                <th>Ended</th>
                <th>Stat. VPN</th>
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

<form action="" method="post" id="postApproval">
    {{ csrf_field() }}
    <input type="submit" value="1" style="display: none">
</form>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_3')
    @include('assets_script_2')
@stop

@section('script')
$('#approvalOvertime').DataTable({
    processing: true,
    responsive: true,
    ajax: '{!! URL::route("form/approval/projectmanager/index/data") !!}',
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},
        { data: 'type'},
        { data: 'nik'},
        { data: 'fullname'},
        { data: 'position'},
        { data: 'startovertime'},
        { data: 'endovertime'},
        { data: 'app_coor'},
        { data: 'action'},
    ],

});

$(document).on('click','#approvalOvertime tr td a[title="modalApproved"]',function(e) {
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
